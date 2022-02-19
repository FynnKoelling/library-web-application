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
if(isset($_GET["bookId"])){
	$bookId = $_GET["bookId"];
} else {
	header('Es fehlen Parameter: BookId muss angegeben werden!', true, 400);
}  

//Delete Book
$sql1 = "DELETE FROM books WHERE BookId = '$bookId'";
if (!$conn -> query($sql1)) {
	$show = $show . '<br/>' . $sql1 . ': ' . $conn -> error;
} else {
	$show = $show . '<br/>' . $sql1 . ": erfolgreich!" . '<br/>';
}
//echo $show;

// close the connection
$conn -> close();

//return
header("Location: ../allbooks.php?msg=". urlencode(base64_encode("Buch gelöscht")));
exit;

?> 