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
	<link rel="stylesheet" type="text/css" href="resultstyle.css">
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

<div class="Content">
		<h1 align="Center">Arbeidsforklaring</h1>
    
<fieldset>
    <legend>Vedhogging</legend>
    <br>
    <p class="workdesc">Arbeidsoppgaven går ut på: Gammel dame på 80, trenger hjelp til å hogge ved. <br>
    Har øks i vedskjulet, men den er ganske gammel.</p>
    

    <div class="profileid">
        <p>Bente Halvorsen</p>
        <p>Utlyst 2018.04.17</p>¨

        <p>Tlf:94457345</p>
        <p>E-mail: bentehalvorsen@gmail.com</p>
    </div>
</fieldset>
		

	
</div>




</body>
</html>