<?php

//Session Start
session_start();
if(!isset($_SESSION['userId'])) {
        $userId = -1; }
	else {
        $userId = $_SESSION['userId'];
    }

//Return if not Registered User
if($userId <= 1){
	header("location:javascript://history.go(-1)");
	exit;
}	

//Connection Variables
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mybib'; 
    
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn -> connect_error) {
    die("DB-Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

//delete user
$sql1 = "DELETE FROM rUser WHERE userId = '$userId'";
	
//Execute Query Code
if (!$conn -> query($sql1)) {
	$show = $show . '<br/>' . $sql1 . ': ' . $conn -> error;
}
//echo show;

// close the connection
$conn -> close();

// Löschen Session Daten
    $_SESSION = array();
    // Löschen Session Cookie
    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
              $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();

//GOTO start
header('Location: ../start.php?msg=' . urlencode(base64_encode("Löschen erfolgreich!")));
exit;

?> 