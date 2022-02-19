<?php
//Session Start
session_start();
if(!isset($_SESSION['userId'])) {
    $userId = -1; 
} else {
    $userId = $_SESSION['userId'];
}

//If not Admin goBack
if($userId != 1){
	header("location:javascript://history.go(-1)");
	exit;
}

//Get BookId	
if (isset($_GET['id'])){
	$bookId = $_GET['id'];
} else{
	header('Es fehlen Parameter: BookId muss angegeben werden!', true, 400);
}

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

//Select Book with BookId
$sql1 = "SELECT * FROM books WHERE BookId = '$bookId'";
$res = $conn -> query($sql1);
if (!$res) {
	die("Select fehlgeschlagen: " . $conn -> connect_error);
} else {
	$row = $res->fetch_assoc();
}
	
// close the connection
$conn -> close();
?>
<!doctype html>
<html>

	<head>
		<meta charset="UTF-8"/>
		<title>Buch hinzufügen</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>

	<body>
	
	<!-- Pop up Message -->
	<?php
	if (isset($_GET['msg'])){
		if ($_GET['msg']) {
			$message = base64_decode(urldecode($_GET['msg']));
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
	?>
		<!--Class for Sticky Footer-->
		<div class="wrapper">

			<header>
				<img src="pic/logo.png" width="4%" height="auto"  alt="logo"/>
				<h3>Kais & Linus Bibliothek </h3>
				<nav>
					<ul>        
						<li>
							<a href="allbooks.php">Alle Bücher</a>
						</li>
						<li>
							<a href="allusers.php">Alle Nutzer</a>
						</li>
						<li>
							<a href="addbook.php">Buch hinzufügen</a>
						</li>
						<li>
							<a href="php/logout_fkt.php" onclick="return confirm('Ausloggen?');">Ausloggen</a>
						</li>
						<li>
							<a href="impressumlogged.php">Impressum</a>
						</li>
					</ul>
				</nav>	  
			</header> 

			<section>

				<div class="bigText1">
					<h2>Buch editieren</h2>
				</div>	  
				
				<!-- Show Cover -->
				<?php echo('<img src="data:image/png;base64,'.base64_encode($row['bild']).'"style="padding-bottom:0px; height: 50vh; width: auto;"/>'); ?>

				<form action="php/editbook_fkt.php?id=<?php echo $bookId; ?>" method="post" class="formAddBook" enctype="multipart/form-data" style="margin-bottom: 50px;">
					<table>
						<tbody>
							<tr>
								<td>
									<label for="titel">Titel</label>
								</td>
								<td>
									<input type="text" name="titel" id="titel" placeholder="Buchtitel" value="<?php echo $row['titel']; ?>"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="autorIn">AutorIn</label>
								</td>
								<td>
									<input type="text" name="autorIn" id="autorIn" placeholder="BuchautorIn" value="<?php echo $row['autorIn']; ?>"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="jahr">Jahr</label>
								</td>
								<td>
									<input type="text" name="jahr" id="jahr" placeholder="Erscheinungsjahr" value="<?php echo $row['erscheinungsjahr']; ?>"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="beschreibung">Beschreibung</label>
								</td>
								<td>									
									<textarea type="text" name="beschreibung" id="beschreibung" rows="9" cols="21" placeholder="Buchbeschreibung"><?php echo $row['beschreibung']; ?></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<label for="cover">Cover</label>
								</td>
								<td>
									<input class="inputFile" type="file" name="cover" id="cover"></input>
								</td>
							</tr>							
						</tbody>
					</table>
					<button type="submit" id="button" name="submitButton" value="Absenden">Editieren</button>
				</form>
				
				<p>Unter 'Cover' nichts auswählen bzw. das Feld frei lassen, um das aktuelle Bild beizubehalten.</p>
					
				<a href="php/deletebook_fkt.php?bookId=<?php echo $bookId; ?>">
				<button type="submit" id="button" name="submitButton" value="Absenden" onclick="return confirm('Buch löschen?');">Buch löschen</button>
				</a>
			
			<div width="100">
				<a href="allbooks.php">
					<img class="imgIcon" src="pic/turn-left.png" width="5%" height="auto"  alt="add"/>
					<h2 class="link">Zurück</h2>
				</a>
			</div>
				
			</section>

		</div>
			
		<footer>
			<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
		</footer>

	</body>

</html>