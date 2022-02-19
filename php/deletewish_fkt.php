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

//Debug Variable
$show = '';

//Get BookId
if(isset($_GET["bookid"])){
	$bookid = $_GET["bookid"];
} else {
	header('Es fehlen Parameter: BookId muss angegeben werden!', true, 400);
}  

//Get UserId
if(isset($_GET["userid"])){
	$userid = $_GET["userid"]; 
} else {
	header('Es fehlen Parameter: UserId muss angegeben werden!', true, 400);
}      

//Delete Wish
$sql2 = "DELETE FROM wishlist WHERE UserId = '$userid' AND BookId = '$bookid'";
	if (!$conn -> query($sql2)) {
		$show = $show . '<br/>' . $sql2 . ': ' . $conn -> error;
	} else {
		$show = $show . '<br/>' . $sql2 . ": erfolgreich!" . '<br/>';
	}
	echo $show;

// close the connection
$conn -> close();

//Return
header("Location: ../wishlist.php?id=$userid&msg=" . urlencode(base64_encode("Buch von Wunschliste entfernt")));
exit;

?> 