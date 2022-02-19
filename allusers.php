<?php
//Start Session
session_start();
if(!isset($_SESSION['userId'])) {
    $userId = -1; 
} else {
    $userId = $_SESSION['userId'];
}

//Return if not Admin
if($userId != 1){
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

//Show all Users function
function showUsers($conn){
	
	//Query Code Select from rUser
	$sql1 = "SELECT userId, Name, Vorname, Email FROM rUser";
	
	//Execute Query Code
	$res = $conn -> query($sql1);
	
	//Create Table Array
	if (!$res) {
		die("Select fehlgeschlagen: " . $conn -> connect_error);
	} else {
		$arr = array();
		while ( $row = $res->fetch_assoc())  {
			$userId = $row['userId'];
			$sql2 = "SELECT * FROM wishlist WHERE UserId='$userId'";
			$wish = $conn -> query($sql2);
			if ($wish->num_rows > 0) {
				$row['Wunschliste'] = '<a href="wishlist.php?id=' . $userId . '">Wunschliste</a>';
			}
			else{
				$row['Wunschliste'] = '-';
			}
			unset($row['userId']);
			$arr[]=$row;
		}
		return($arr);
	}
}

//Call Show Users
$users = showUsers($conn);

// close the connection
$conn -> close();
?>
	
<!doctype html>
<html>

	<head>
		<meta charset="UTF-8"/>
		<title>Alle Nutzer</title>
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
						<li>
							<a href="#" id="current">Alle Nutzer</a>
						</li>
						<li>
							<a href="addbook.php">Buch hinzufügen</a>
						</li>
						<li class="<?php if ($userId > 0) {echo 'nothide';} else {echo 'hide';}; ?>">
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
					<h2>Registrierte Nutzer</h2>
				</div>	
		
		<!-- All Users Table -->
		<?php if (count($users) > 0): ?>
		<table class="tablezs">
			<col width=200/>
			<col width=200/> 				
			<col width=200/>
			<thead>
				<tr>
					<th><?php echo implode('</th><th>', array_keys(current($users))); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($users as $row): array_map('htmlentities', $row); ?>
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