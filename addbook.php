<?php
//Session Start
session_start();
if(!isset($_SESSION['userId'])) {
        $userId = -1; }
else {
	$userId = $_SESSION['userId'];
}

//Return if not admin
if($userId != 1){
	header("location:javascript://history.go(-1)");
	exit;
}
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
							<a href="#" id="current">Buch hinzufügen</a>
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
					<h2>Buch hinzufügen</h2>
				</div>	  

				<form action="php/addbook_fkt.php" method="post" class="formAddBook" enctype="multipart/form-data">
					<table>
						<tbody>
							<tr>
								<td>
									<label for="titel">Titel </label>
								</td>
								<td>
									<input type="text" name="titel" id="titel" placeholder="Buchtitel"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="autorIn">AutorIn </label>
								</td>
								<td>
									<input type="text" name="autorIn" id="autorIn" placeholder="BuchautorIn"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="jahr">Jahr</label>
								</td>
								<td>
									<input type="text" name="jahr" id="jahr" placeholder="Erscheinungsjahr"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="beschreibung">Beschreibung</label>
								</td>
								<td>									
									<textarea type="text" name="beschreibung" id="beschreibung" rows="9" cols="21" placeholder="Buchbeschreibung"></textarea>
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
					<button type="submit" id="button" name="submitButton" value="Absenden">Hinzufügen</button>
				</form>

			</section>

		</div>
			
		<footer>
			<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
		</footer>

	</body>

</html>