﻿<?php
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
	<link rel="stylesheet" type="text/css" href="workstyle.css">
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
<?php
    include 'commonHeader.php';
?>

<div class="Content">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="GET">       
<div class="search"><h1 align="center">Arbeidsmarkedet</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
    <input class="searchbar" type="text" name="search" >
    <input class="searchbar" type="submit" value="Søk" >
</form>
</div>
</form> 
<div class="workdescription">
<?php 
                if(isset($_GET["search"])){
                    $name = $_GET["search"];
                    if($name = null){
                        $sql = "SELECT * FROM  organizations JOIN users ON organizations.Owner = users.FirstName + users.LastName";
                    }else{
                        $sql = "SELECT * FROM organizations JOIN users ON organizations.Owner = users.FirstName + users.LastName WHERE Name = '$name' OR Owner = '$name'";
                    }
                }else{
                    $sql = "SELECT * FROM organizations JOIN users ON organizations.Owner = users.UserID";
                }
                $results = $conn->query($sql);
                
                echo "<table>";
                echo "<tr>";
                echo "<th>Annonsør</th>";
                echo "<th>Oppgave</th>";
                echo "<th>Utgivelsesdato</th>";
                echo "<th>E-mail</th>";
				echo "<th>Tlf</th>";
				echo "<th>Kort Beskrivelse</th>";
				echo "<th>Mer Info</th>";
                echo "</tr>";
                
                while ($e = $results->fetch_assoc()) {
                    $input0 = $e["FirstName"]." ".$e["LastName"];
                    $input1 = $e["Name"];
                    $input2 = $e["DateCreated"];
                    $input3 = $e["Email"];
					$input4 = $e["Phone"];
					$input6 = $e["Needs"];
                    $input5 = $e["OrgID"];
                    echo "<tr>";
                    echo "<td>$input0</td>";
                    echo "<td>$input1</td>";
                    echo "<td>$input2</td>";
                    echo "<td>$input3</td>";
					echo "<td>$input4</td>";
					echo "<td>$input6</td>";
                    echo "<td><a href='resultat.php?foo=$input5'>Mer Info</a></td";
                    echo "</tr>";
                }  
				echo "</table>";
				echo "</div>";        
            ?>

</div>




</body>
</html>
