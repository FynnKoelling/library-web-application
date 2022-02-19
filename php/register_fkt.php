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

//get Post Variables
if (isset($_REQUEST["nachname"])) {
	$value2 = $_REQUEST["nachname"];
}
else{
	header('Es fehlen Parameter: Nachname muss angegeben werden!', true, 400);
}
if (isset($_REQUEST["vorname"])) {
	$value3 = $_REQUEST["vorname"];
}
else{
	header('Es fehlen Parameter: Vorname muss angegeben werden!', true, 400);
}
if (isset($_REQUEST["email"])) {
	$value4 = $_REQUEST["email"];
}
else{
	header('Es fehlen Parameter: Email muss angegeben werden!', true, 400);
}
if (isset($_REQUEST["passwort"])) {
	$value5 = $_REQUEST["passwort"];
}
else{
	header('Es fehlen Parameter: Passwort muss angegeben werden!', true, 400);
}
	
//call Insert User function
insertUser($conn, $value2, $value3, $value4, $value5);


//Insert User Function
function insertUser($conn, $value2, $value3, $value4, $value5){
	
	//Debug String Variable
	$show = '';
	
	//Insert Into [] Values []
    $sql2 = "INSERT INTO rUser VALUES (DEFAULT, '$value2', '$value3', '$value4', '$value5')";
	if (!$conn -> query($sql2)) {
		$show = $show . '<br/>' . $sql2 . ': ' . $conn -> error;
	} else {
		$show = $show . '<br/>' . $sql2 . ": erfolgreich!" . '<br/>';
	}
	//echo $show;
	
}

// close the connection
$conn -> close();

?> 