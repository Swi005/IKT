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
$bar = $_GET["foo"];
$sql = "SELECT * FROM organization JOIN users ON organizations.Owner = users.FirstName + users.LastName WHERE OrgID = '$bar'";
$results = $conn->query($sql);
while ($j = $results->fetch_assoc()) {
    $name = $j["Name"];
    $date = $j["DateCreated"];
    $phone = $j["Phone"];
    $description = $j["Description"];
    $Owner = $j["FirstName"]." ".$j["LastName"];
    $Needs = $j["Needs"];
    $email = $j["Email"];
    $date = strrev($date);
}
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
<?php
    include 'commonHeader.php';
?>
<div class="Content">
		<h1 align="Center">Arbeidsforklaring</h1>
    
<fieldset>
    <legend><?php echo $name ?></legend>
    <br>
    <p class="workdesc"><?php echo $description ?></p>
    

    <div class="profileid">
        <p><?php echo $Owner ?></p>
        <p>Utlyst <?php echo $date ?>>/p>¨

        <p>Tlf:<?php echo $phone ?></p>
        <p>E-mail: <?php echo $email?></p>
    </div>
</fieldset>
		

	
</div>




</body>
</html>