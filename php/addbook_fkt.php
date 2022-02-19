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
	$value2 = $_POST["titel"];
	$value3 = $_POST["autorIn"];
	$value4 = $_POST["jahr"];
	$value5 = $_POST["beschreibung"];
	$value6 = $_FILES["cover"]["tmp_name"];
	
	//Check if all Values are Set
	if($value2 && $value3 && $value4 && $value5 && $value6){	
		//call Insert Book function
		insertBook($conn, $value2, $value3, $value4, $value5);
	//Else return
	} else {
		// close the connection
		$conn -> close();
		
		//return
		header('Location: ../addbook.php?msg=' . urlencode(base64_encode("Bitte alle Angaben setzen")));
		exit;
	}
}

//Inser Book Function
function insertBook($conn, $value2, $value3, $value4, $value5){
	
	//Debug String Variable
	$show = '';
	
	//Get File Location Cover Image
	$imgData = addslashes(file_get_contents($_FILES["cover"]["tmp_name"]));      
	
	//Insert Into books
    $sql2 = "INSERT INTO books VALUES (DEFAULT, '$value2', '$value3', '$value4', '$value5', '{$imgData}')";
	if (!$conn -> query($sql2)) {
		$show = $show . '<br/>' . $sql2 . ': ' . $conn -> error;
	} else {
		$show = $show . '<br/>' . $sql2 . ": erfolgreich!" . '<br/>';
	}
	//echo $show;

}

// close the connection
$conn -> close();

//Return
header('Location: ../addbook.php?msg=' . urlencode(base64_encode("Hinzufügen erfolgreich!")));
exit;

?> 