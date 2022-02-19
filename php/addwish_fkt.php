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

//Check if already Wished
$sql3 = "SELECT * FROM wishlist WHERE BookId = $bookid AND UserId = $userid";
	if (!$conn -> query($sql3)) {
		$show = $show . '<br/>' . $sql3 . ': ' . $conn -> error;
	} 
	else {
		$show = $show . '<br/>' . $sql3 . ": erfolgreich!" . '<br/>';
		$result = $conn -> query($sql3);
		//Return if already Wished
		if ($result->num_rows > 0) {
			header("Location: ../info.php?id=$bookid&msg=" . urlencode(base64_encode("Bereits auf Wunschliste!")));
			exit;
		}
	}
	//echo $show;

//Insert Wish into Wishlist
$sql2 = "INSERT INTO wishlist VALUES ('$bookid', '$userid')";
	if (!$conn -> query($sql2)) {
		$show = $show . '<br/>' . $sql2 . ': ' . $conn -> error;
	} else {
		$show = $show . '<br/>' . $sql2 . ": erfolgreich!" . '<br/>';
	}
	//echo $show;

// close the connection
$conn -> close();

//Return
header("Location: ../info.php?id=$bookid&msg=" . urlencode(base64_encode("Zur Wunschliste hinzugefügt")));
exit;

?> 