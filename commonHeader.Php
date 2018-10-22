<header>
	<div class="topcontainer">
		<image class="norgesbakgrunn" src="Bilder/Norgesbakgrunn.jpg" alt="Patriotisk bilde">
		<?php
        
if($_SESSION["loggedinn"]){
 /* Checks if the user is logged inn. Future work should be focused on removing
 the need for a server query. This block runs if the user is logged inn. 
 If true it should display the users profile, if false it should display an option to loginn.
 */
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
    echo '<input class="loginput" type="email" name="email1" placeholder="Brukernavn" required>';
    echo '<input class="loginput" type="password" name="password1" placeholder="Passord" required>';
    echo '<input class="loginput" type="submit">';
    echo '</form>';
    echo '</div>';
    if(isset($_POST["email1"])){
        $username1 = $_POST["email1"];
        $password1 = $_POST["password1"];
        $password1 = hash("sha256", $password1);
        $sql = "SELECT * FROM users WHERE Email='$username1' AND Password='$password1'";
        $results = $conn->query($sql);
        if(mysqli_num_rows($results) == 1){
            while($a = $results->fetch_assoc()){
                $foo2 = $a["UserID"];
                $foo0 = $a["Email"];
                $foo1 = $a["Password"];
                if($username1 == $foo0 && $password1 == $foo1){
                    $_SESSION["loggedinn"] = true;
                    $_SESSION["userID"] = $foo2;
                    header("Cache-Control: no-cache, must-revalidate"); //To force the browser to update. 
                break;
                }
            }
        }else{
            //error wrong password
            echo "wrong password";
            echo $password1;
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