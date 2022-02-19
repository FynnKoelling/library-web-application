<?php
//Session Start
session_start();
if(!isset($_SESSION['userId'])) {
    $userId = -1; }
else {
	$userId = $_SESSION['userId'];
}

//Get BookId
if (isset($_GET['id'])){
	$bookId = $_GET['id'];
} else {
	header('Es fehlen Parameter: BookId muss angegeben werden!', true, 400);
}
?>

<!doctype html>

<html>

	<head>
		<meta charset="UTF-8"/>
		<title>Buchinformationen</title>
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

				<div class="bigText1">
					<h2 id="Titel"></h2>
				</div>	

				<div id="Bild"></div>	

				<table class="tablezs">
					<col width=200/> 
					<col width=200/> 
					<col width=200/>
					<thead id="thead">
					</thead>
					<tbody id="result">
					</tbody>
				</table>

				<h3>Beschreibung</h3>

				<p id="Beschreibung"></p>

				<div class="floatLeft">
					<a href="allbooks.php" style="margin:10px 100px 10px 0px;">
						<img class="imgIcon" src="pic/turn-left.png" width="15%" height="auto"  alt="add"/>
						<h2 class="link">Zurück</h2>
					</a>
				</div> 
				
				<div class="floatLeft" <?php if ($userId <= 1) {echo 'style="display:none;"';}; ?> >
					<a  href="php/addwish_fkt" id="anchorWish" style="margin:10px 100px 10px 0px;">
						<img class="imgIcon" src="pic/menu-2.png" width="15%" height="auto"  alt="add"/>
						<h2 class="link">Auf Wunschliste</h2>
					</a>
				</div>
				
				<div class="floatLeft" <?php if ($userId <= 1) {echo 'style="display:none;"';}; ?>>
					<a href="rate.php" id="anchorRate" style="margin:10px 100px 10px 0px;">
						<img class="imgIcon" src="pic/favourite.png" width="15%" height="auto"  alt="add"/>
						<h2 class="link">Bewerten</h2>
					</a>
				</div> 

			</section>

		</div>

		<footer>
			<p>Copyright 2020 by Fynn Linus Kölling & Kai Fehrcke</p>
		</footer>
		
	<!-- AJAX SCRIPT -->	
    <script>
	//Get BookId
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	const bookId = urlParams.get('id');
	showResult();
        
    function showResult() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.addEventListener("load", ajaxGeladen);
        xmlhttp.addEventListener("error", ajaxFehler);
        xmlhttp.open("GET", "php/info_fkt.php?id=" + bookId);
        xmlhttp.send();
    }
    
    function ajaxGeladen(event) {
        var myObj = JSON.parse(event.target.responseText);
        // Tabelle-Kopf
        var thead = document.getElementById("thead");
        var trh = document.createElement("tr");
        thead.appendChild(trh);
        for (var key in myObj[0]) {
			//Don't Create Titel, Beschreibung and Bild
			if(key.toString() != "Titel" && key.toString() != "Beschreibung" && key.toString() != "Bild"){
				var th = document.createElement("th");
				th.appendChild(document.createTextNode(key));
				trh.appendChild(th);
			}
        }
        // Tabelle-Rumpf
        var tb = document.getElementById("result");
        for (var i=0; i<myObj.length; i++) {
            var tr = document.createElement("tr");
            for (var key in myObj[i]) {
				//If Titel, Beschreibung or Bild put in innerHTML on Site, not in Table
				if(key.toString() == "Titel"){
					var val = myObj[i][key].trim();
					document.getElementById("Titel").innerHTML = val;
				} else if(key.toString() == "Beschreibung"){
					var val = myObj[i][key].trim();
					document.getElementById("Beschreibung").innerHTML = val;
				} else if(key.toString() == "Bild"){
					var val = myObj[i][key].trim();
					document.getElementById("Bild").innerHTML = val;
				} else{
					var val = myObj[i][key].trim();
					var td = document.createElement("td");
					td.appendChild(document.createTextNode(val));
					tr.appendChild(td);
				}
            }
            tb.appendChild(tr);
        }
		
		//Create Links for Rate and Add Wish
		var Titel = document.getElementById("Titel").innerHTML;
		var userId = "<?php echo $userId ?>";
		document.getElementById("anchorRate").href = `rate.php?name=${Titel}&id=${bookId}&bewertung=1`;
		document.getElementById("anchorWish").href = `php/addwish_fkt.php?bookid=${bookId}&userid=${userId}`;
    }

    function ajaxFehler(event) {
        alert(event.target.statusText);
    }
    
    </script>    

	</body>

</html>