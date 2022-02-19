//Javascript for Rate Site

//Display name from URL. Source https://www.sitepoint.com/get-url-parameters-with-javascript/ --------------------------------------------------------------------------------
//Für das Übergeben der URL in Javascript und das Anzeigen in HTML habe ich mit Kai Fehrcke und Katja Schneider zusammengearbeitet bzw. auch auf die gleiche Quelle zugegriffen
const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const urlName = urlParams.get('name');

var name = urlName.replace(/_/g," ");

document.getElementById("displayName").innerHTML = name;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//Variables for Rating--------------------------------------------------------------------------------------------------------------------------------------------------------

//Focus always on current Star
var bewertung = document.getElementById("focus").innerHTML;

if(bewertung==1){
	document.getElementById("onestar").focus();
}
if(bewertung==2){
	document.getElementById("twostar").focus();
}
if(bewertung==3){
	document.getElementById("threestar").focus();
}
if(bewertung==4){
	document.getElementById("fourstar").focus();
}
if(bewertung==5){
	document.getElementById("fivestar").focus();
}

//Get Star Elements and keep them focused
document.getElementById('onestar').onblur = function (event) { var blurEl = this; setTimeout(function() {blurEl.focus()},10) };
document.getElementById('twostar').onblur = function (event) { var blurEl = this; setTimeout(function() {blurEl.focus()},10) };
document.getElementById('threestar').onblur = function (event) { var blurEl = this; setTimeout(function() {blurEl.focus()},10) };
document.getElementById('fourstar').onblur = function (event) { var blurEl = this; setTimeout(function() {blurEl.focus()},10) };
document.getElementById('fivestar').onblur = function (event) { var blurEl = this; setTimeout(function() {blurEl.focus()},10) };

//Absolute rating
var ratingGesamt = document.getElementById("summe").innerHTML;
//Average rating
var schnittGesamt = 0;
//Average in percent 
var schnittPerc = 0;
//Absolute number of ratings
var anzBewertungen = document.getElementById("anzahl").innerHTML;

//Absolute number for each rating 1-5
var anzOne = document.getElementById("anz1").innerHTML;
var anzTwo = document.getElementById("anz2").innerHTML;
var anzThree = document.getElementById("anz3").innerHTML;
var anzFour = document.getElementById("anz4").innerHTML;
var anzFive = document.getElementById("anz5").innerHTML;

//Relative number for each rating 1-5
var relOne = 0;
var relTwo = 0;
var relThree = 0;
var relFour = 0;
var relFive = 0;

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------


//Methods for Rating----------------------------------------------------------------------------------------------------------------------------------------------------------

//call update function
update();

//Function for update of all graphical representation
function update(){	
	
	if(anzBewertungen==0){
	}
	else{
	schnittGesamt = ratingGesamt / anzBewertungen;
	//Set to 2 Decimal Places
	schnittGesamt = schnittGesamt.toFixed(2);
	}
	
	//Calculate relative number for each possible Rating and set to 2 Decimal Places
	if(anzBewertungen==0){
	}
	else{
	relOne = anzOne / anzBewertungen * 100;
	relOne = relOne.toFixed(2);
	relTwo = anzTwo / anzBewertungen * 100;
	relTwo = relTwo.toFixed(2);
	relThree = anzThree / anzBewertungen * 100;
	relThree = relThree.toFixed(2);
	relFour = anzFour / anzBewertungen * 100;
	relFour = relFour.toFixed(2);
	relFive = anzFive / anzBewertungen * 100;	
	relFive = relFive.toFixed(2);
	}
	
	//Calculate the percentual average for five stars 
	schnittPerc = schnittGesamt / 5 * 100;
	
	//Update each scorecard bars with relative number for each rating
	document.getElementById("bar-1").style.width = relOne+"%";
	document.getElementById("bar-2").style.width = relTwo+"%";
	document.getElementById("bar-3").style.width = relThree+"%";
	document.getElementById("bar-4").style.width = relFour+"%";
	document.getElementById("bar-5").style.width = relFive+"%";	
	
	//Update scorecard relative and absolute numbers for each rating
	document.getElementById("anzOne").innerHTML = relOne+"%. "+anzOne+"-mal";
	document.getElementById("anzTwo").innerHTML = relTwo+"%. "+anzTwo+"-mal";
	document.getElementById("anzThree").innerHTML = relThree+"%. "+anzThree+"-mal";
	document.getElementById("anzFour").innerHTML = relFour+"%. "+anzFour+"-mal";
	document.getElementById("anzFive").innerHTML = relFive+"%. "+anzFive+"-mal";
	
	//Update stars and text with average, absolute number of ratings and percentual average for five stars
	document.getElementById("schnitt").innerHTML = "Durschnittliche Bewertung ist "+schnittGesamt+" von 5 Sternen";
	document.getElementById("gesamt").innerHTML = "Bei "+anzBewertungen+" Bewertungen";
	document.getElementById("Stars").style.setProperty('--percent', schnittPerc+'%');

}
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------