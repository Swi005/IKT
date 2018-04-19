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
	<link rel="stylesheet" type="text/css" href="workstyle.css">
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
            echo '<form action="hire.php"><input type="submit" value="Legg Ut Oppgaver"></form>';//action="[fil som skal åpnes]" 
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
                    if($name = ""){
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
                    $input1 = $e["Navn"];
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
