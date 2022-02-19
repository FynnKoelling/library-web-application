<?php
//Session Start
session_start();
if(!isset($_SESSION['userId'])) {
        $userId = -1; }
else {
	$userId = $_SESSION['userId'];
}

//Connection Variables
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mybib';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Get BookId
if (isset($_REQUEST["id"])) {
	$bookId = $_REQUEST["id"];
} else {
	header('Es fehlen Parameter: BuchId muss angegeben werden!', true, 400);
}

//Select Book with BookId
$sql = "SELECT Titel, AutorIn, Erscheinungsjahr, bookId, Beschreibung, Bild FROM books WHERE bookId = '$bookId'";
$result = $conn->query($sql);
if (!$result) {
	die("Select fehlgeschlagen: " . $conn -> connect_error);
}

//Fetch Book Informations
$rows = array();
while ($row = $result->fetch_assoc()) {
	$bookId = $row['bookId'];
			
	//Query Code Select from rate
	$sql2 = "SELECT SUM(rate) as summe FROM rate WHERE bookId = '$bookId'";
	$res2 = $conn -> query($sql2);
	if (!$res2) {
		die("Select fehlgeschlagen: " . $conn -> connect_error);
	} else {		
		$Sum = $res2->fetch_assoc();
	}
			
	//Query Code Select from rate
	$sql3 = "SELECT COUNT(*) as anzahl FROM rate WHERE bookId = '$bookId'";
	$res3 = $conn -> query($sql3);
	if (!$res3) {
		die("Select fehlgeschlagen: " . $conn -> connect_error);
	} else {
		$Anz = $res3->fetch_assoc();
	}
			
	//Set Rating
	if($Anz['anzahl'] == 0){
		$Rating = 0;
	} else{
		$Rating = $Sum['summe'] / $Anz['anzahl'];
	}
	$Rating = round($Rating, 2);			
	$row['Bewertung'] = "$Rating";
	
	//Get / Set Cover Picture
	$bild = base64_encode($row['Bild']);
	$row['Bild'] = "<img src=\"data:image/png;base64,$bild\"style=\"padding-bottom:50px; height: 50vh; width: auto;\"/>";
	
	unset($row['bookId']);
		
    $rows[] = $row;
}

//Return JSON
$ps = json_encode($rows, JSON_UNESCAPED_UNICODE);
echo ($ps);
$conn->close();
?> 