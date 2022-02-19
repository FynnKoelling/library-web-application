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

//Get BookId
if(isset($_GET["bookId"])){
	$value2 = $_GET["bookId"];
} else {
	header('Es fehlen Parameter: BookId muss angegeben werden!', true, 400);
}  

//Get UserId
if(isset($_GET["userId"])){
	$value1 = $_GET["userId"]; 
} else {
	header('Es fehlen Parameter: UserId muss angegeben werden!', true, 400);
}   

//Get Bewertung
if(isset($_GET["bewertung"])){
	$value3 = $_GET["bewertung"]; 
} else {
	header('Es fehlen Parameter: Bewertung muss angegeben werden!', true, 400);
}   	
	
//call Insert Rate function
insertRate($conn, $value1, $value2, $value3);

//Inser User Rate
function insertRate($conn, $value1, $value2, $value3){
	
	//Debug String Variable
	$show = '';
	
	//Insert Into rate
    $sql1 = "INSERT INTO rate VALUES ('$value1', '$value2', '$value3')";
	if (!$conn -> query($sql1)) {
		$show = $show . '<br/>' . $sql1 . ': ' . $conn -> error;
	} else {
		$show = $show . '<br/>' . $sql1 . ": erfolgreich!" . '<br/>';
	}
	//echo $show;
	
}

//Get Book Titel
$sql2 = "SELECT Titel FROM books WHERE BookId = '$value2'";
	if (!$conn -> query($sql2)) {
		$show = $show . '<br/>' . $sql2 . ': ' . $conn -> error;
	} else {
		$res = $conn -> query($sql2);
		$titel = $res->fetch_assoc();
		$titel = $titel['Titel'];
		$show = $show . '<br/>' . $sql2 . ": erfolgreich!" . '<br/>';
	}
	//echo $show;

//return
header("location: ../rate.php?name=$titel&id=$value2&bewertung=1");
exit;

?> 