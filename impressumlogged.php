<?php
//Session Start
session_start();
if(!isset($_SESSION['userId'])) {
        $userId = -1; }
    else {
        $userId = $_SESSION['userId'];
    }
?>
<!doctype html>
<html>

	<head>
		<meta charset="UTF-8"/>
		<title>Impressum</title>
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
						<li class="<?php if ($userId > 0) {echo 'nothide';} else {echo 'hide';}; ?>">
							<a href="php/logout_fkt.php" onclick="return confirm('Ausloggen?');">Ausloggen</a>
						</li>
						<li class="<?php if ($userId == -1) {echo 'nothide';} else {echo 'hide';}; ?>">
							<a href="start.php">Zur Startseite</a>
						</li>
						<li  class="<?php if ($userId > 1) {echo 'nothide';} else {echo 'hide';}; ?>">
							<a href="php/deleteAccount_fkt.php" onclick="return confirm('Soll dein Konto gelöscht werden?');">Konto löschen</a>
						</li>
						<li>
							<a href="#" id="current">Impressum</a>
						</li>
					</ul>
				</nav>	  
			</header> 

			<section>

				<div class="bigText1">
					<h2>Impressum</h2>
				</div>	

				<div>
					<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
					<p>Web Navigation Color Icon Pack made by Freepik from "<a href="https://www.flaticon.com/packs/web-navigation-color">
				   https://www.flaticon.com/packs/web-navigation-color</a>"</p>
					<p>Book Icon Pack made by Freepik from "<a href="https://www.flaticon.com/packs/book-3">
				   https://www.flaticon.com/packs/book-3"</a>
					</p>
				</div> 						

			</section>

		</div>

		<footer>
			<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
		</footer>

	</body>

</html>