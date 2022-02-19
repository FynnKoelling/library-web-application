<?php
//Session Start
session_start();
if(!isset($_SESSION['userId'])) {
     $userId = -1; }
else {
    $userId = $_SESSION['userId'];
}

//Return if not Registered User or Admin
if($userId < 1){
	header("location:javascript://history.go(-1)");
	exit;
}

//Get UserId
if (isset($_GET['id'])){
	$user = $_GET['id'];
} else {
	header('Es fehlen Parameter: UserId muss angegeben werden!', true, 400);
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

//Query Code Select Books and UserId from books and Wishlist
$sql1 = "SELECT wishlist.BookId, books.Titel, books.AutorIn, books.Erscheinungsjahr FROM wishlist INNER JOIN books ON wishlist.BookId = books.BookId WHERE wishlist.UserId = '$user'";
	//Execute Query Code
	$res = $conn -> query($sql1);
	if (!$res) {
	die("Select fehlgeschlagen: " . $conn -> connect_error);
	} 
	else {
		$arr = array();
		//create Table Array
		while($row = $res->fetch_assoc()) {
			
			$bookId = $row['BookId'];
			
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
			
			//set Link to more infos
			$row['Mehr Informationen'] = '<a href="info.php?id=' . $bookId .'">Informationen</a>';
			
			//Create Link entfernen when not admin
			if($userId == $user){
				$row['Entfernen'] = '<a href="php/deletewish_fkt.php?bookid=' . $bookId . '&userid=' . $userId . '">Von Liste entfernen</a>';
			}
			
			unset($row['BookId']);
			
			$arr[]=$row;
		}
		$list = $arr;
	}

// close the connection
$conn -> close();
?>
	
<!doctype html>

<html>

	<head>
		<meta charset="UTF-8"/>
		<title>Buchinformationen</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>

	<body>
	
	<!-- Pop up message -->
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
				<h3>Kais & Linus Bibliothek</h3>
				<nav>
					<ul>        
						<li>
							<a href="allbooks.php">Alle Bücher</a>
						</li>
						<li  class="<?php if ($userId > 1) {echo 'nothide';} else {echo 'hide';}; ?>">
							<a href="#" id="current">Wunschliste</a>
						</li>
						<li  class="<?php if ($userId == 1) {echo 'nothide';} else {echo 'hide';}; ?>">
							<a href="allusers.php">Alle Nutzer</a>
						</li>
						<li  class="<?php if ($userId == 1) {echo 'nothide';} else {echo 'hide';}; ?>">
							<a href="addbook.php">Buch hinzufügen</a>
						</li>
						<li  class="<?php if ($userId > 0) {echo 'nothide';} else {echo 'hide';}; ?>">
							<a href="php/logout_fkt.php" onclick="return confirm('Ausloggen?');">Ausloggen</a>
						</li>
						<li  class="<?php if ($userId > 1) {echo 'nothide';} else {echo 'hide';}; ?>">
							<a href="php/deleteAccount_fkt.php" onclick="return confirm('Soll dein Konto gelöscht werden?');">Konto löschen</a>
						</li>
						<li>
							<a href="impressumlogged.php">Impressum</a>
						</li>
					</ul>
				</nav>	 
			</header> 

			<section>

				<div class="bigText1">
					<h2>Wunschliste</h2>
				</div>	
				
				<!-- Wishlist Table -->
				<?php if (count($list) > 0): ?>
				<table class="tablezs">
					<col width=200/> 
					<col width=200/> 
					<col width=200/>
					<col width=200/>
					<col width=200/>
					<col width=200/>
					<thead>
						<tr>
							<th><?php echo implode('</th><th>', array_keys(current($list))); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($list as $row): array_map('htmlentities', $row); ?>
						<tr>
							<td><?php echo implode('</td><td>', $row); ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>

			</section>

		</div>

		<footer>
			<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
		</footer>

	</body>

</html>