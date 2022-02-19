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
		<title>Alle Bücher</title>
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
				<h3>Kais & Linus Bibliothek</h3>
				<nav>
					<ul>        
						<li>
							<a href="#" id="current">Alle Bücher</a>
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
						<li class="<?php if ($userId == -1) {echo 'nothide';} else {echo 'hide';}; ?>">
							<a href="start.php">Zur Startseite</a>
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

			<form class="formAddBook" style="height: 50px; margin-bottom: 0px">
					<table>
						<tbody>
							<tr>
								<td>
									<label for="titel">Suchen: </label>
								</td>
								<td>
									<input type="text" name="suche" id="suche" placeholder="Buchtitel"/>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
				<button type="submit" id="button" name="submitButton" style="margin-bottom: 20px">Suchen</button>
				
				<table class="tablezs" id="table">
					<col width=200/> 
					<col width=200/> 
					<col width=200/>
					<col width=200/> 				
					<col width=200/>
					<thead id="thead">
					</thead>
					<tbody id="result">
					</tbody>
				</table>

				<div>
					<a href="addbook.php" class="<?php if ($userId == 1) {echo 'nothide';} else {echo 'hide';}; ?>">
						<img class="imgIcon" src="pic/add.png" width="5%" height="auto"  alt="add"/>
						<h2 class="link">Buch hinzufügen</h2>
					</a>
				</div> 

			</section>

		</div>
		<footer>
			<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
		</footer>
		
	<!-- AJAX SCRIPT -->	
    <script>
    window.addEventListener("load", init);
	showResult();

    function init() {
        document.getElementById("button").addEventListener("click", showResult);
    } 
        
    function showResult() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.addEventListener("load", ajaxGeladen);
        xmlhttp.addEventListener("error", ajaxFehler);
        xmlhttp.open("POST", "php/allbooks_fkt.php");
		
		//Get Search Variable
		var suche = document.getElementById("suche").value; 
		
		if(!suche){
			suche = '';
		}
		
		var daten = new FormData();
		daten.append("suche", suche);
		
        xmlhttp.send(daten);
    }
    
    function ajaxGeladen(event) {
        var myObj = JSON.parse(event.target.responseText);
        // Tabelle-Kopf
        var thead = document.getElementById("thead");
		thead.innerHTML = "";
        var trh = document.createElement("tr");
        thead.appendChild(trh);
        for (var key in myObj[0]) {
            var th = document.createElement("th");
            th.appendChild(document.createTextNode(key));
            trh.appendChild(th);
        }
        // Tabelle-Rumpf
        var tb = document.getElementById("result");
		tb.innerHTML = "";
        for (var i=0; i<myObj.length; i++) {
            var tr = document.createElement("tr");
            for (var key in myObj[i]) {
				//If key = link insert in innerHTML
				if(key.toString() == "Bearbeiten" || key.toString() == "Mehr Informationen"){
					var val = myObj[i][key].trim();
					var td = document.createElement("td");
					td.innerHTML = val;
				//Else insert as Text Node
				} else{
					var val = myObj[i][key].trim();
					var td = document.createElement("td");
					td.appendChild(document.createTextNode(val));
				}
				tr.appendChild(td);
            }
            tb.appendChild(tr);
        }
    }

    function ajaxFehler(event) {
        alert(event.target.statusText);
    }
    
    </script>    
	
	</body>

</html>