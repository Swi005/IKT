﻿<?php
session_start();
if(!isset($_SESSION["loggedinn"])){
    $_SESSION["loggedinn"] = false;
}

?>
<!-- Take my love, Take my Land, Take me where i can not stand! -->
<!-- country violin riff-->
<!-- i dont care i'm still free, you can't take the sky from me-->
<!-- country violin riff-->
<!-- Take me out to the black, tell them i ain't coming back!-->
<!-- country violin riff-->
<!-- burn the land and boil the sea, you can't take the sky from me-->
<!-- country violin solo-->
<!-- has no place i can't be, since i found Serenity-->
<!-- You can't take the sky from me-->
<!-- final violin riff-->
<?php
    $DBhostName = "localhost";
    $DBuserName = "root";
    $DBpassword = "";
    $DBserverName = "test";
    $conn = new mysqli($DBhostName, $DBuserName, $DBpassword, $DBserverName);  
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
	<h1 align="center">Velkommen</h1>
	
	<p align="center">
		"Frivilligsentralene er lokale møteplasser for enkeltmennesker, <br>
		lag/foreninger og det offentlige som genererer frivillig innsats for <br>
		og med det brede lag av befolkningen rundt om i hele landet."<br>
	</p>
<fieldset>
	<legend><h2 align="center">Vårt nyeste nyhetsberv</h2></legend>

	<h3 align="center"></h3>
	<p aling="center"></p>

	<h3 align="center">1. Spørreundersøkelsen 2018</h3>
	<p aling="center">Vi har nå åpnet spørreundersøkelsen 2018 for frivilligsentralene. Vi håper alle vil svare, fordi dette gir oss et svært viktig grunnlag for å jobbe med gode rammevilkår for sentralene. Svarene vil gi oss oversikt over utviklingen fra 2017 til 2018 - år 2 med ny økonomisk tilskuddsordning.
			Logg inn på IT-løsningen og klikk spørreskjema på startsiden, eller velg "Spørreskjema" i menyen.</p>

	<h3 align="center">2. Landsmøtet - saksdokumenter</h3>
	<p aling="center">Onsdag 21. mars ble saksdokumentene sendt ut til alle deltakere. I tillegg til de ordinære sakene har styret også foreslått at landsmøtet vedtar en politisk resolusjon. Fristen for siste påmelding til landsmøtet er satt på søndag 1. april, så det er fortsatt mulig å melde seg på. Vel møtt til 206 personer fra 158 frivilligsentraler!</p>

	<h3 align="center">3. Frivilligsentral-systemet / ny IT-løsning</h3>
	<p aling="center">42% av landets sentraler har logget inn på IT-løsningen og finner nyheter, informasjon og oversikt over sentralene, og legger inn egne ansatte og styremedlemmer. Nå åpnes også systemet for spørreskjema. Neste steg er nye nettsider som redigeres fra IT-løsningen. Vi regner med at de nye nettsidene vil være oppe i slutten av mars med data fra de gamle nettsidene. Sentralen vil da kunne se og redigere sine nye sider før de velger å bytte. Logg inn på IT-løsningen her: frivilligsentral.no/login. Hvis du mangler påloggingsinformasjon, sender du e-post til it@norgesfrivilligsentraler.no.</p>

	<h3 align="center">4. IMDi</h3>
	<p aling="center">Som dere kanskje har lest i nyheter på Frivilligsentral-systemet signerte vi en intensjonsavtale med IMDi fredag 2. mars, som en av 9 organisasjoner. 
			Hurra - den 15. mars fikk vi beskjed fra IMDi at vår søknad til et treårig prosjekt “Økt integrering via Norges Frivilligsentraler” er godkjent, og at vi får kr. 500 000 i 2018.</p>

	<h3 align="center">5. Helsedirektoratet</h3>
	<p aling="center">Vi har også søkt prosjektmidler fra Helsedirektoratet. Utfallet av denne søknaden vet vi mer om tidlig i april.</p>

</fieldset>
</div>



</body>
</html>