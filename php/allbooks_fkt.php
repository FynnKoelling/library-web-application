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

//Get Search Parameter
if (isset($_REQUEST["suche"])) {
	$suche = '%' . $_REQUEST["suche"] . '%';
} else{
	$suche = '%';
}

//Select Where Titel like search param
$sql1 = "SELECT Titel, AutorIn, Erscheinungsjahr, bookId FROM books WHERE Titel LIKE '$suche'";
$res1 = $conn -> query($sql1);
if (!$res1) {
	die("Select fehlgeschlagen: " . $conn -> connect_error);
}

//Create Book Array from Fetch
$rows = array();
while ($row = $res1->fetch_assoc()) {
	$bookId = $row['bookId'];
			
	//Select Sum from rate
	$sql2 = "SELECT SUM(rate) as summe FROM rate WHERE bookId = '$bookId'";
	$res2 = $conn -> query($sql2);
	if (!$res2) {
		die("Select fehlgeschlagen: " . $conn -> connect_error);
	} else {		
		$Sum = $res2->fetch_assoc();
	}
			
	//Select Count from rate
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
			
	//Set Bearbeiten
	if($userId == 1){
		$row['Bearbeiten'] = "<a href=\"editbook.php?id=$bookId\">Buch bearbeiten</a>";
	}
			
	//Set Information Link
	$row['Mehr Informationen'] = $row['bookId'];
	unset($row['bookId']);
	$row['Mehr Informationen'] = '<a href="info.php?id=' . $row['Mehr Informationen'] . '">Informationen</a>';
	
    $rows[] = $row;
}

//return fetched Books
$ps = json_encode($rows, JSON_UNESCAPED_UNICODE);
echo ($ps);
$conn->close();
?> 