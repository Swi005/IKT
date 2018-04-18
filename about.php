<?php
session_start();
if(!isset($_SESSION["loggedinn"])){
    $_SESSION["loggedinn"] = false;
}
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" type="text/css" href="indexstyle.css">
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
	<h1 align="center">Velkommen til Norges Frivilligsentraler.</h1>
	
	<p align="center">Norges Frivilligsentraler er en landsdekkende interesseorganisasjon for alle frivilligsentraler.</p>

<fieldset>
	<legend><h3>Formål</h3></legend>
	<ul>
		<li>Å bidra til utvikling av frivilligsentralene som viktige velferds- og samfunnsaktører.</li>
		<li>Å arbeide for gode rammevilkår for frivilligsentralene.</li>
		<li>Å sikre muligheter for kompetanseutvikling for alle som er involvert i frivilligsentralene.</li>
		<li>Å arbeide for synliggjøring av frivilligsentralene.</li>
		<li>Å utvikle samarbeid med aktuelle offentlige instanser, og med frivillige organisasjoner og sammenslutninger.</li>
		<li>Være et felles talerør for medlemssentralene.</li>
	</ul>
</fieldset>	
</div>



</body>
</html>