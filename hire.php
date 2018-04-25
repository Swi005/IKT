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
	<link rel="stylesheet" type="text/css" href="orgcreatestyle.css">
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
<?php
    include 'commonHeader.php';
?>

<div class="Content">
	
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <p class="logintext">Overskrift</p><br>
        <input class="loginfield" type="text" name="_name" placeholder="Navnet ditt" required><br>
        <p class="logintext">Email:</p><br>
        <input class="loginfield" type="email" name="_email" placeholder="Din E-mail" required><br>
        <p class="logintext">Telefon</p><br>
        <input class="loginfield" type="tel" name="_phone" placeholder="Ditt Telefonnummer" required><br>
        <p class="logintext">Kort Beskrivelse av oppgaven</p><br>
        <textarea name="_desc"></textarea><br>
        <p class="logintext">Krav</p><br>
        <input class="loginfield" type="text" name="_needs" placeholder="Arbeidskrav" required><br>
        <p class="logintext">Når skal det være ferdig</p><br>
        <input class="loginfield" type="date" name="_date" required><br>
        <input class="loginfield" type="submit" value="Legg til!">
    </form>
    <?php
        if($_SESSION["loggedinn"] && isset($_POST["_name"])){
            $name = $_POST["_name"];
            $email = $_POST["_email"];
            $phone = $_POST["_phone"];
            $desc = $_POST["_desc"];
            $needs = $_POST["_needs"];
            $date = date("Y-m-d");
            $dateNeeded = $_POST["_date"];
            $dateNeeded = strrev($dateNeeded);
            $owner = $_SESSION["userID"];
            $sql = "INSERT INTO organizations (`Name`, `DateCreated`, `Email`, `Phone`, `Description`, `Owner`, `Needs`) VALUES ('$name','$date', '$email', '$phone', '$desc', '$owner', '$needs')";
            $conn->query($sql);
            /* Oh Great Old One. Why doesn't my logic work?
            if($conn->query($sql) == true){
                echo "$date";
            }*/
           
           
        }
    ?>
</div>
</body>
</html>