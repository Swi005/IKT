<?php
session_start();
if(!isset($_SESSION["loggedinn"])){
    $_SESSION["loggedinn"] = false;
}
$DBhostname = "localhost";
$DBpassword = "";
$DBusername = "root";
$DBname = "test";
$conn = new mysqli($DBhostname, $DBusername, $DBpassword, $DBname);
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" type="text/css" href="indexstyle.css">
	<link rel="stylesheet" type="text/css" href="orgcreatestyle.css">
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
<header>
	<div class="topcontainer">
		<image class="norgesbakgrunn" src="Bilder/Norgesbakgrunn.jpg" alt="Patriotisk bilde">
		<?php
		if($_SESSION["loggedinn"]){
			$tempVar = $_SESSION["userID"];
			$sql = "SELECT * FROM users WHERE UserID = '$tempVar'";
			$results = $conn->query($sql);
			while($a = $results->fetch_assoc()){
				$navn = $a["FirstName"]." ".$a["LastName"];
				$email = $a["Email"];
			}
            echo '<div class="profiler">';
			echo '<h3 class="loginput">Din Profil</h3>';
			echo '<p class="loginput">';echo $navn; echo '</p>';
			echo '<p class="loginput">';echo $email; echo '</p>';
			echo '<form action="hire.php"><input type="submit" value="Legg Ut Oppgaver"></form>';
			echo '<form action="'; echo htmlspecialchars($_SERVER["PHP_SELF"]); echo '" method="post"><input type="submit" value="Log Ut" name="logout"></form>';
			echo '<img id="avatarbilde" src="Bilder/empty_avatar.png" alt=avatar">';
			echo "</div>";
			if(isset($_POST["logout"])){
				session_destroy();
				header("Cache-Control: no-cache, must-revalidate");
			}
        }else{
			echo '<div class="profiler">';
			echo '<form action="';
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo '" method="post">';
			echo 'Skriv inn dine brukerdetaljer';
			echo '<input class="loginput" type="text" name="_email" placeholder="Brukernavn" required>';
			echo '<input class="loginput" type="password" name="_password" placeholder="Passord" required>';
			echo '<input class="loginput" type="submit">';
			echo '</form>';
			echo '</div>';
			if(isset($_POST["_email"])){
				$username = $_POST["_email"];
				$password = $_POST["_password"];
				$sql = "SELECT * FROM users WHERE Email='$username' AND Password='$password'";
				$results = $conn->query($sql);
                if(mysqli_num_rows($results) == 1){
                    while($a = $results->fetch_assoc()){
                        $foo2 = $a["UserID"];
                        $foo0 = $a["Email"];
                        $foo1 = $a["Password"];
                        if($username == $foo0 && $password == $foo1){
                            $_SESSION["loggedinn"] = true;
                            $_SESSION["userID"] = $foo2;
                            header("Cache-Control: no-cache, must-revalidate");
                        break;
                        }
                    }
                }else{
                    //error wrong password
                    echo "wrong password";
                }
			}
        }
	?>
	</div>
</header>
	<nav>
		<ul class="navbar">
			<li class="navoptions"><a class="navlink" href="mainpage.php">Hjem</a></li>
			<li class="navoptions"><a class="navlink" href="work.php">Arbiedsmarked</a></li>
			<li class="navoptions"><a class="navlink" href="about.php">Om oss</a></li>
			<li class="navoptions"><a class="navlink" href="Registration.php">Registrer deg</a></li>
		</ul>
	</nav>

<div class="Content">
	
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <p class="logintext">Overskrift</p><br>
        <input class="loginfield" type="text" name="_name" placeholder="Navnet ditt" required><br>
        <p class="logintext">Email:</p><br>
        <input class="loginfield" type="email" name="_email" placeholder="Din E-mail" required><br>
        <p class="logintext">Telefon</p><br>
        <input class="loginfield" type="tel" name="_phone" placeholder="Ditt Telefonnummer" required><br>
        <p class="logintext">Kort Beskrivelse av oppgaven</p><br>
        <textarea name="_desc"></textarea><br>
        <p class="logintext">Krav</p><br>
        <input class="loginfield" type="text" name="_needs" placeholder="Arbeidskrav" required><br>
        <p class="logintext">Når skal det være ferdig</p><br>
        <input class="loginfield" type="date" name="_date" required><br>
        <input class="loginfield" type="submit" value="Legg til!">
    </form>
    <?php
        if($_SESSION["loggedinn"] && isset($_POST["_name"])){
            $name = $_POST["_name"];
            $email = $_POST["_email"];
            $phone = $_POST["_phone"];
            $desc = $_POST["_desc"];
            $needs = $_POST["_needs"];
            $date = date("Y-m-d");
            $dateNeeded = $_POST["_date"];
            $dateNeeded = strrev($dateNeeded);
            $owner = $_SESSION["userID"];
            $sql = "INSERT INTO organizations (`Name`, `DateCreated`, `Email`, `Phone`, `Description`, `Owner`, `Needs`) VALUES ('$name','$date', '$email', '$phone', '$desc', '$owner', '$needs')";
            $conn->query($sql);
            /* Oh Great Old One. Why doesn't my logic work?
            if($conn->query($sql) == true){
                echo "$date";
            }*/
           
           
        }
    ?>
</div>
</body>
</html>