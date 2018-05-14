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
<html>
<head>
    
	<link rel="stylesheet" type="text/css" href="indexstyle.css">
	<link rel="stylesheet" type="text/css" href="registerstyle.css">
</head>
<body>
<?php
    include 'commonHeader.php';
?>  

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
        $password = hash("sha256", $password);
        $sql = "SELECT * FROM users WHERE Email = '$email'";
            if($conn->query($sql) != false){
                $sql = "INSERT INTO `users` (Email, Password, FirstName, LastName, Zip_Code, Address, City) VALUES ('$email', '$password','$firstName', '$lastName', '$zip', '$address', '$city')";
                if($conn->query($sql)){
                $_SESSION["loggedinn"] = true;
                $sql = "SELECT UserID FROM Users WHERE Email = $email";
                $results = $sql->query($sql);
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