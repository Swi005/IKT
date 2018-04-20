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
	<link rel="stylesheet" type="text/css" href="registerstyle.css">
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
<header>
	<div class="topcontainer">
		<image class="norgesbakgrunn" src="Bilder/Norgesbakgrunn.jpg" alt="Patriotisk bilde">
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
			echo '<img id="avatarbilde" src="Bilder/empty_avatar.png" alt=avatar">';
			echo "</div>";
			
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
				$sql = "SELECT * FROM users WHERE Email = '$username' and Password = '$password'";
                $results = $conn->query($sql);
                if($results->num_rows = 1){
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
<fieldset>
    <legend><h1>Registrer deg</h1></legend>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="registerforms">
            <input class="loginfield" type="email" name="_email" placeholder="Skriv din E-mail" required>
            <input class="loginfield" type="password" name="_password" placeholder="Skriv ditt passord" required>
            <input class="loginfield" type="text" name="_firstName" placeholder="Skriv ditt fornavn" required>
            <input class="loginfield" type="text" name="_lastName" placeholder="Skriv ditt etternavn">
            <input class="loginfield" type="text" name="_zip" placeholder="Skriv ditt postnummer" required>
            <input class="loginfield" type="text" name="_city" placeholder="Skriv ditt poststed" required>
            <input class="loginfield" type="text" name="_address" placeholder="Skriv din adresse" required>
            <input class="loginfield" type="submit" value="Registrer deg">
        </div>
    </form>

    </fieldset>
        
        
</div>
<?php
    if(isset($_POST["_email"])){
        $email = $_POST["_email"];
        $password = $_POST["_password"];
        $firstName = $_POST["_firstName"];
        $lastName = $_POST["_lastName"];
        $zip = $_POST["_zip"];
        $city = $_POST["_city"];
        $address = $_POST["_address"];

        $sql = "SELECT * FROM users WHERE Email = '$email'";
            if($conn->query($sql) != true){
                $sql = "INSERT INTO `users` (Email, Password, FirstName, LastName, Zip_Code, Address, City) VALUES ('$email', '$password','$firstName', '$lastName', '$zip', '$address', '$city')";
                if($conn->query($sql)){
                $_SESSION["loggedinn"] = true;
                $sql = "SELECT UserID FROM Users WHERE Email = $email";
                $results= $sql->query($sql);
                    while ($i = $results->fetch_assoc()) {
                        $_SESSION["userID"] = $a["userID"];
                        break;
                    }
                }
                else{
                    //there was a problem
                    echo "Something went wrong";
                }
            }else{
                //User allready exists
                echo "That email is allready in use";
            }
        }
    ?>



</body>
</html>