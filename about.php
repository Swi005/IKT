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
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
<?php
    include 'commonHeader.php';
?>
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