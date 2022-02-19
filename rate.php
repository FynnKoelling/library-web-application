<?php
//Session
session_start();
if(!isset($_SESSION['userId'])) {
	$userId = -1; 
}
else {
	$userId = $_SESSION['userId'];
}

//If user = admin or guest return
if($userId <= 1){
	header("location:javascript://history.go(-1)");
	exit;
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

//Debug String Variable
$show = '';

//Get / Set Bewertung
if(isset($_GET['bewertung'])) {
	$bewertung = $_GET['bewertung'];
} else {
	$bewertung=1;
}

//Get BookId
if(isset($_GET["id"])){
	$bookId = $_GET["id"];
} else {
	header('Es fehlen Parameter: BookId muss angegeben werden!', true, 400);
}  

//Get Name
if(isset($_GET["name"])){
	$name = $_GET["name"];
} else {
	header('Es fehlen Parameter: Name muss angegeben werden!', true, 400);
}   

//SELECT Rate Variables for JS 
$sql2 = "SELECT SUM(rate) as summe FROM rate WHERE bookId = $bookId";
if (!$conn -> query($sql2)) {
	$show = $show . '<br/>' . $sql2 . ': ' . $conn -> error;
} else {
	$Sum = ($conn -> query($sql2))->fetch_assoc();
	$show = $show . '<br/>' . $sql2 . ": erfolgreich!" . '<br/>';
}
//echo $show;

$sql3 = "SELECT COUNT(*) as anzahl from rate WHERE bookId = $bookId";
if (!$conn -> query($sql3)) {
	$show = $show . '<br/>' . $sql3 . ': ' . $conn -> error;
} else {
	$Anz = ($conn -> query($sql3))->fetch_assoc();
	$show = $show . '<br/>' . $sql3 . ": erfolgreich!" . '<br/>';
}
//echo $show;

$sql4 = "SELECT COUNT(*) as anz1 from rate WHERE rate = 1 AND bookId = $bookId";
if (!$conn -> query($sql4)) {
	$show = $show . '<br/>' . $sql4 . ': ' . $conn -> error;
} else {
	$anz1 = ($conn -> query($sql4))->fetch_assoc();
	$show = $show . '<br/>' . $sql4 . ": erfolgreich!" . '<br/>';
}
//echo $show;

$sql5 = "SELECT COUNT(*) as anz2 from rate WHERE rate = 2 AND bookId = $bookId";
if (!$conn -> query($sql5)) {
	$show = $show . '<br/>' . $sql5 . ': ' . $conn -> error;
} else {
	$anz2 = ($conn -> query($sql5))->fetch_assoc();
	$show = $show . '<br/>' . $sql5 . ": erfolgreich!" . '<br/>';
}
//echo $show;

$sql6 = "SELECT COUNT(*) as anz3 from rate WHERE rate = 3 AND bookId = $bookId";
if (!$conn -> query($sql6)) {
	$show = $show . '<br/>' . $sql6 . ': ' . $conn -> error;
} else {
	$anz3 = ($conn -> query($sql6))->fetch_assoc();
	$show = $show . '<br/>' . $sql6 . ": erfolgreich!" . '<br/>';
}
//echo $show;


$sql7 = "SELECT COUNT(*) as anz4 from rate WHERE rate = 4 AND bookId = $bookId";
if (!$conn -> query($sql7)) {
	$show = $show . '<br/>' . $sql7 . ': ' . $conn -> error;
} else {
	$anz4 = ($conn -> query($sql7))->fetch_assoc();
	$show = $show . '<br/>' . $sql7 . ": erfolgreich!" . '<br/>';
}
//echo $show;


$sql8 = "SELECT COUNT(*) as anz5 from rate WHERE rate = 5 AND bookId = $bookId";
if (!$conn -> query($sql8)) {
	$show = $show . '<br/>' . $sql8 . ': ' . $conn -> error;
} else {
	$anz5 = ($conn -> query($sql8))->fetch_assoc();
	$show = $show . '<br/>' . $sql8 . ": erfolgreich!" . '<br/>';
}
//echo $show;


//Hide Button if already rated
$sql9 = "SELECT * FROM rate WHERE bookId = $bookId AND userId = $userId";
	if (!$conn -> query($sql9)) {
		$show = $show . '<br/>' . $sql9 . ': ' . $conn -> error;
	} else {
		$show = $show . '<br/>' . $sql9 . ": erfolgreich!" . '<br/>';
		$result = $conn -> query($sql9);
		if ($result->num_rows > 0) {
			$Already = 1;
		}
		else{
			$Already = 0;
		}
	}
	//echo $show;
	
// close the connection
$conn -> close();
?>

<!doctype html>

<html>

	<head>
		<meta charset="UTF-8"/>
		<title>Buch bewerten</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>

	<body>
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
						<li  class="<?php if ($userId > 1) {echo 'nothide';} else {echo 'hide';}; ?>">
							<a href="wishlist.php?id=<?php echo $userId ?>">Wunschliste</a>
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
					<h2>Buch bewerten</h2>
				</div>	

				<h3 id="displayName"></h3>

				<div class="rating">
					<a href="rate.php?name=<?php echo $name; ?>&id=<?php echo $bookId; ?>&bewertung=5" title="Gib 5 Sterne" id="fivestar">★</a>
					<a href="rate.php?name=<?php echo $name; ?>&id=<?php echo $bookId; ?>&bewertung=4" title="Gib 4 Sterne" id="fourstar">★</a>
					<a href="rate.php?name=<?php echo $name; ?>&id=<?php echo $bookId; ?>&bewertung=3" title="Gib 3 Sterne" id="threestar">★</a>
					<a href="rate.php?name=<?php echo $name; ?>&id=<?php echo $bookId; ?>&bewertung=2" title="Gib 2 Sterne" id="twostar">★</a>
					<a href="rate.php?name=<?php echo $name; ?>&id=<?php echo $bookId; ?>&bewertung=1" title="Gib 1 Sterne" id="onestar">★</a>
				</div>

				<a href="php/rate_fkt.php?userId=<?php echo $userId; ?>&bookId=<?php echo $bookId; ?>&bewertung=<?php echo $bewertung; ?>">
				<button type="submit" id="button" name="submitButton" value="Submit" style="margin-bottom: 15px;" class="<?php if ($Already == 0) {echo 'nothide';} else {echo 'hide';}; ?>">Bewertung abgeben</button>
				</a>

				<hr style="border:3px solid #f1f1f1; margin-top:80px;"></hr>

					<div class="row">
						<div class="side">
							<div>5 Sterne</div>
						</div>
						<div class="middle">
							<div class="bar-container">
								<div class="bar-5" id="bar-5"></div>
							</div>
						</div>
						<div class="side right">
							<div id="anzFive"></div>
						</div>
						<div class="side">
							<div>4 Sterne</div>
						</div>
						<div class="middle">
							<div class="bar-container">
								<div class="bar-4" id="bar-4"></div>
							</div>
						</div>
						<div class="side right">
							<div id="anzFour"></div>
						</div>
						<div class="side">
							<div>3 Sterne</div>
						</div>
						<div class="middle">
							<div class="bar-container">
								<div class="bar-3" id="bar-3"></div>
							</div>
						</div>
						<div class="side right">
							<div id="anzThree"></div>
						</div>
						<div class="side">
							<div>2 Sterne</div>
						</div>
						<div class="middle">
							<div class="bar-container">
								<div class="bar-2" id="bar-2"></div>
							</div>
						</div>
						<div class="side right">
							<div id="anzTwo"></div>
						</div>
						<div class="side">
							<div>1 Stern</div>
						</div>
						<div class="middle">
							<div class="bar-container">
								<div class="bar-1" id="bar-1"></div>
							</div>
						</div>
						<div class="side right">
							<div id="anzOne"></div>
						</div>
					</div>
					
					<hr style="border:3px solid #f1f1f1; margin-bottom:80px;"></hr>
					
					<div class="Stars" id="Stars"></div>
					<h3 id="schnitt"></h3>
					<h3 id="gesamt"></h3>
					
			</section>

		</div>
		
		<!-- DIVS for JS -->
		 <div id="focus" class="hide"><?php echo $bewertung; ?></div>
		 <div id="summe" class="hide"><?php echo $Sum['summe']; ?></div>
		 <div id="anzahl" class="hide"><?php echo $Anz['anzahl']; ?></div>
		 <div id="anz1" class="hide"><?php echo $anz1['anz1']; ?></div>
		 <div id="anz2" class="hide"><?php echo $anz2['anz2']; ?></div>
		 <div id="anz3" class="hide"><?php echo $anz3['anz3']; ?></div>
		 <div id="anz4" class="hide"><?php echo $anz4['anz4']; ?></div>
		 <div id="anz5" class="hide"><?php echo $anz5['anz5']; ?></div>

		<footer>
			<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
		</footer>

	</body>

  <script src="js/rate.js"></script>

</html>