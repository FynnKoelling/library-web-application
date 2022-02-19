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
if(isset($_GET["id"])){
	$bookId = $_GET["id"];
} else {
	header('Es fehlen Parameter: BookId muss angegeben werden!', true, 400);
}

//Check if Edit Button is pressed
if(isset($_REQUEST['submitButton'])){
	
	//get Form Variables
	$value2 = $_POST["titel"];
	$value3 = $_POST["autorIn"];
	$value4 = $_POST["jahr"];
	$value5 = $_POST["beschreibung"];
	
	//Check if all Variables are Set except Cover
	if($value2 && $value3 && $value4 && $value5){	
		//call Edit Book function
		editBook($conn, $value2, $value3, $value4, $value5, $bookId);
	//Else return
	} else {
		// close the connection
		$conn -> close();
		
		//return
		header("Location: ../editbook.php?id=".$bookId."&msg=" . urlencode(base64_encode("Bitte alle Angaben setzen!")));
		exit;
	}
	
}

//Edit Book Function
function editBook($conn, $value2, $value3, $value4, $value5, $bookId){
	
	//Debug String Variable
	$show = '';
	
	//If no Cover set keep current Cover; Update all other Variables
	if($_FILES["cover"]["size"] == 0){
		$sql2 = "UPDATE books SET Titel='$value2', AutorIn='$value3', Erscheinungsjahr='$value4', Beschreibung='$value5' WHERE BookId = '$bookId'";
	}
	else{
		$imgData = addslashes(file_get_contents($_FILES["cover"]["tmp_name"])); 
		$sql2 = "UPDATE books SET Titel='$value2', AutorIn='$value3', Erscheinungsjahr='$value4', Beschreibung='$value5', Bild='{$imgData}' WHERE BookId = '$bookId'";
	}
    
	//Execute Query
	if (!$conn -> query($sql2)) {
		$show = $show . '<br/>' . $sql2 . ': ' . $conn -> error;
	} else {
		$show = $show . '<br/>' . $sql2 . ": erfolgreich!" . '<br/>';
	}
	//echo $show;

}

// close the connection
$conn -> close();

//return
header("Location: ../editbook.php?id=".$bookId."&msg=" . urlencode(base64_encode("Editieren erfolgreich!")));
exit;

?> 