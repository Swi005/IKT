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
<?php
		if($_SESSION["loggedinn"]){
			$tempVar = $_SESSION["userID"];
			$sql = "SELECT FirstName, LastName, Email FROM  Users WHERE UserID = '$tempVar'";
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
			?>
			<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>
			<?php
			echo '" method="POST">';
			echo 'Skriv inn dine brukerdetaljer';
			echo '<input class="loginput" type="text" name="_email" placeholder="Brukernavn" required>';
			echo '<input class="loginput" type="password" name="_password" placeholder="Passord" required>';
			echo '<input class="loginput" type="submit" name="" id="">';
			echo '</form>';
			echo '</div>';
        }
	?>
	</div>
</header>
<?php
        if(isset($_POST["email"])){
            $username = $_POST["_email"];
            $password = $_POST["_password"];
            $password = hash("sha256", $password);
            $sql = "SELECT * FROM `users`";
            $results = $conn->query($sql);
            if(isset($username)){
                while($a = $results->fetch_assoc()){
                    if($username == $a["Email"] && $password == $a["Password"]){
                        $_SESSION["loggedinn"] = true;
                        $_SESSION["userID"] = $a["userID"];
                        echo "success";
                        break;
                    }else{
                        //feil brukernavn
                        echo '<p>There was a problem</p>';
                        break;
                    }
                }
            }
        }
    ?>
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
            <input class="loginfield" type="text" name="_firstname" placeholder="Skriv ditt fornavn" required>
            <input class="loginfield" type="text" name="_lastname" placeholder="Skriv ditt etternavn">
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
        $password = hash("sha256", $password);

        $sql = "SELECT * FROM users WHERE Email = '$email'";
            if($conn->query($sql) !== true){
                $sql = "INSERT INTO `users` (`Email`, `Password`, `FirstName`, `LastName`, `Zip_Code`, `Address`, `City`) VALUES ('$email', '$password','$firstName', '$lastName', '$zip', '$address', '$city')";
                if($conn->query($sql)){
                echo "Success";
                $_SESSION["loggedinn"] = true;
                $_SESSION["userID"] = $a["userID"];
                }
                else{
                    //there was a problem
                    echo "Something went wrong";
                }
            }else{
                //User allready exists
                echo "There was an error ". $conn->error;
            }
        }
    ?>



</body>
</html>