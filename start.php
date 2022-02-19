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

//Tablename
$tname = 'books';

//Table Column Names
$name1 = 'bookId';
$name2 = 'titel';
$name3 = 'autorIn';
$name4 = 'erscheinungsjahr';
$name5 = 'beschreibung';
$name6 = 'bild';

//Table Column Types
$type1 = 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY';
$type2 = 'VARCHAR(60) NOT NULL';
$type3 = 'VARCHAR(60) NOT NULL';
$type4 = 'YEAR NOT NULL';
$type5 = 'TEXT NOT NULL';
$type6 = 'LONGBLOB NOT NULL';

//Create Table books
$sql1 = "CREATE TABLE IF NOT EXISTS $tname ($name1 $type1, $name2 $type2, $name3 $type3, $name4 $type4, $name5 $type5, $name6 $type6)";
if (!$conn -> query($sql1)) {
    die('Tabelle-Erzeugen fehlgeschlagen: ' . $conn -> error);
}

//Tablename
$tname = 'rUser';

//Table Column Names
$name1 = 'userId';
$name2 = 'name';
$name3 = 'vorname';
$name4 = 'email';
$name5 = 'passwort';

//Table Column Types
$type1 = 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY';
$type2 = 'VARCHAR(30) NOT NULL';
$type3 = 'VARCHAR(30) NOT NULL';
$type4 = 'VARCHAR(60) NOT NULL';
$type5 = 'VARCHAR(20) NOT NULL';

//Create Table rUser
$sql1 = "CREATE TABLE IF NOT EXISTS $tname ($name1 $type1, $name2 $type2, $name3 $type3, $name4 $type4, $name5 $type5)";
if (!$conn -> query($sql1)) {
    die('Tabelle-Erzeugen fehlgeschlagen: ' . $conn -> error);
}

//Tablename
$tname = 'rate';

//Table Column Names
$name1 = 'userId';
$name2 = 'bookId';
$name3 = 'rate';

//Table Column Types
$type1 = 'INT(6) UNSIGNED NOT NULL';
$type2 = 'INT(6) UNSIGNED NOT NULL';
$type3 = 'INT(5) NOT NULL';

//Create Table rate
$sql1 = "CREATE TABLE IF NOT EXISTS $tname ($name1 $type1, $name2 $type2, $name3 $type3, FOREIGN KEY (bookId) REFERENCES books(bookId) ON UPDATE CASCADE ON DELETE CASCADE, 
FOREIGN KEY (userId) REFERENCES Ruser(userId) ON UPDATE CASCADE ON DELETE CASCADE)";
if (!$conn -> query($sql1)) {
    die('Tabelle-Erzeugen fehlgeschlagen: ' . $conn -> error);
}

//Tablename
$tname = 'wishlist';

//Table Column Names
$name1 = 'bookId';
$name2 = 'userId';

//Table Column Types
$type1 = 'INT(6) UNSIGNED NOT NULL';
$type2 = 'INT(6) UNSIGNED NOT NULL';

//Create Table wishlist
$sql1 = "CREATE TABLE IF NOT EXISTS $tname ($name1 $type1, $name2 $type2, FOREIGN KEY (bookId) REFERENCES books(bookId) ON UPDATE CASCADE ON DELETE CASCADE, 
FOREIGN KEY (userId) REFERENCES Ruser(userId) ON UPDATE CASCADE ON DELETE CASCADE)";
if (!$conn -> query($sql1)) {
    die('Tabelle-Erzeugen fehlgeschlagen: ' . $conn -> error);
}

//Insert Admin, do nothing if already inserted
$sql2 = "INSERT INTO rUser VALUES (1, 'Admin', 'Admin', 'admin@bib.de', '12345') ON DUPLICATE KEY UPDATE userId=userId";
//Execute Query Code
if (!$conn -> query($sql2)) {
	$show = $show . '<br/>' . $sql2 . ': ' . $conn -> error;
} else {
	$show = $show . '<br/>' . $sql2 . ": erfolgreich!" . '<br/>';
}
//echo $show;

// close the connection
$conn -> close();
?>
	
<!doctype html>

<html>

	<head>
		<meta charset="UTF-8"/>
		<title>Startseite</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>

	<body>
	
	<!-- Pop-up Message -->
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
							<a href="#" id="current">Startseite</a>
						</li>
						<li>
							<a href="register.php">Registrieren</a>
						</li>
						<li>
							<a href="login.php">Anmelden</a>
						</li>
						<li>
							<a href="impressum.php">Impressum</a>
						</li>
					</ul>
				</nav>	
			</header> 

			<section>

				<div class="bigText1">
					<h2>Bitte melde dich an, registriere dich oder wähle unseren Gastzugang um fortzufahren</h2>
				</div>	

				<div>
					<a href="register.php">
						<img class="imgIcon" src="pic/menu-2.png" width="5%" height="auto"  alt="register"/>
						<h2 class="link">Registrieren</h2>
					</a>
				</div> 						

				<div>
					<a href="login.php">
						<img class="imgIcon" src="pic/user.png" width="5%" height="auto"  alt="user"/>
						<h2 class="link">Anmelden</h2>
					</a>
				</div> 

				<div>
					<a href="allbooks.php">
						<img class="imgIcon" src="pic/home.png" width="5%" height="auto"  alt="user"/>
						<h2 class="link">Gastzugang</h2>
					</a>
				</div> 

			</section>

		</div>

		<footer>
			<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
		</footer>

	</body>

</html>