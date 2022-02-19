<!doctype html>

<html>

	<head>
		<meta charset="UTF-8"/>
		<title>Login</title>
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
							<a href="start.php">Startseite</a>
						</li>
						<li>
							<a href="register.php">Registrieren</a>
						</li>
						<li>
							<a href="#" id="current">Anmelden</a>
						</li>
						<li>
							<a href="impressum.php">Impressum</a>
						</li>
					</ul>
				</nav>
			</header> 

			<section>

				<div class="bigText1">
					<h2>Anmelden</h2>
				</div>	  

				<form action="php/login_fkt.php" method="post" class="formLogin">
					<table>
						<tbody>
							<tr>
								<td>
									<label for="email">Email</label>
								</td>
								<td>
									<input type="email" name="email" id="email" placeholder="Deine Email"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="passwort">Passwort</label>
								</td>
								<td>
									<input type="password" name="passwort" id="passwort" placeholder="Dein Passwort"/>
								</td>
							</tr>
						</tbody>
					</table>
					<button type="submit" id="button" name="submitButton" value="Absenden">Anmelden</button>
				</form>

				<h2>Noch nicht registriert?</h2>

				<div>
					<a href="register.php">
						<img class="imgIcon" src="pic/menu-2.png" width="5%" height="auto"  alt="register" style="padding-top:0px;"/>
						<h2 class="link">Registrieren</h2>
					</a>
				</div> 	

			</section>

		</div>

		<footer>
			<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
		</footer>

	</body>

</html>