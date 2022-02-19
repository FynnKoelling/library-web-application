<!doctype html>

<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Registrieren</title>
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
							<a href="start.php" >Startseite</a>
						</li>
						<li>
							<a href="#" id="current">Registrieren</a>
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
					<h2>Registrieren</h2>
				</div>							
				
				<div class="wrapperRegister">
				
				<div class="floatLeft">&nbsp;</div>
				
				<div class="floatLeft">
				<form class="formRegister">
					<table>
						<tbody>
							<tr>
								<td>
									<label for="vorname">Vorname </label>
								</td>
								<td>
									<input type="text" name="vorname" id="vorname" placeholder="Dein Vorname"/>
								</td>
							</tr>
							<tr>
								<td>
									<label for="nachname">Nachname </label>
								</td>
								<td>
									<input type="text" name="nachname" id="nachname" placeholder="Dein Nachname"/>
								</td>
							</tr>
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
							<tr>
								<td>
									<label for="passwort_wdh"></label>
								</td>
								<td>
									<input type="password" name="passwort_wdh" id="passwort_wdh" placeholder="Passwort wiederholen" onkeyup="checkMatch();"/>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
				<button type="submit" id="button" disabled>Registrieren</button>
				</div>
				
				<div class="floatLeft">
					<h3>Passwort muss folgendes enthalten:</h3>
					<p id="number" class="invalid">Eine <b>Ziffer</b></p>
					<p id="length" class="invalid">Minimum <b>5 Zeichen</b></p>
					<p id="same" class="invalid">Passwörter <b>gleich</b></p>
				</div>	
				
				</div>
				
				<p>
				<div id="absatz"></div>
				</p>

				<h2>Bereits registriert?</h2>

				<div>
					<a href="login.php">
						<img class="imgIcon" src="pic/user.png" width="5%" height="auto"  alt="user" style="padding-top:0px;"/>
						<h2 class="link">Anmelden</h2>
					</a>
				</div> 
				
			</section>

		</div>

		<footer>
			<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
		</footer>

	</body>
	
	<script src="js/check_register_pw.js"></script>
	
	<!-- AJAX SCRIPT -->
	<script>
    window.addEventListener("load", init);
    
    function init() {
        document.getElementById("button").addEventListener("click", ajax);
    }
    
	function ajax() {
		//Get Post Elements
		var vorname = document.getElementById("vorname").value; 
		var nachname = document.getElementById("nachname").value; 
		var email = document.getElementById("email").value; 
		var passwort = document.getElementById("passwort").value; 
		
		//If all Set: Execute
		if (vorname && nachname && email && passwort) {		
			var ajaxRequest = new XMLHttpRequest();
			ajaxRequest.addEventListener("load", ajaxGeladen);
			ajaxRequest.addEventListener("error", ajaxFehler);
			ajaxRequest.open("POST", "php/register_fkt.php");
		
			//Create Data to Send
			var daten = new FormData();
			daten.append("vorname", vorname);
			daten.append("nachname", nachname);
			daten.append("email", email);
			daten.append("passwort", passwort);
			ajaxRequest.send(daten);	
		}
		//Else Display Message
		else{
			document.getElementById("absatz").innerHTML = "Bitte alle Angaben setzen";
		}
	}
	function ajaxGeladen(event) {
		document.getElementById("absatz").innerHTML = "Registrieren erfolgreich";
    }
	function ajaxFehler(event) {
		alert(event.target.statusText);
	}
	</script>
	
</html>