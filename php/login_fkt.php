<?php
	
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

//Debug String Variable
$show = '';

//Check if Register Button is pressed
if(isset($_REQUEST['submitButton'])){
	
	//get Form Variables
	$value1 = $_POST["email"];
	$value2 = $_POST["passwort"];
	
	//call Check User function
	$result = checkUser($conn, $value1, $value2);
}

//Check User Function
function checkUser($conn, $value1, $value2){
	
	//Debug String Variable
	$show = '';
	
    $sql1 = "SELECT userId FROM rUser WHERE email = '$value1' AND passwort = '$value2'";
	
	//Execute Query Code
	if (!$conn -> query($sql1)) {
		$show = $show . '<br/>' . $sql1 . ': ' . $conn -> error;
	} else {
		$result = $conn -> query($sql1);
		return $result;
	}
	//echo $show;

}

// close the connection
$conn -> close();

//if result than set userId and login
if ($result->num_rows > 0) {
	session_start(); 
	$row = $result->fetch_assoc();
	$_SESSION['userId'] = $row["userId"];
	header('Location: ../allbooks.php');
	exit;
} 
//else load site new
else {
	header("Location: ../login.php?msg=". urlencode(base64_encode("Falsche Email oder falsches Kennwort")));
	exit;
}

?> 