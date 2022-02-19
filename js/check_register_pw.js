//Javascript for Register Site - Password Check

//Variables for Password Check------------------------------------------------------------------------------------------------------------------------------------------------
//Input Password
var input = document.getElementById("passwort");
var input_wdh = document.getElementById("passwort_wdh");

//Length, Number and Same Constraint in Checks Message
var length = document.getElementById("length");
var number = document.getElementById("number");
var same = document.getElementById("same");

//Register Button
var button = document.getElementById("button");

//Numbers 0-9
var numbers = /[0-9]/g;

//Booleans for proof of input
var numValid = false;
var lengValid = false;
var sameValid = false;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//Methods for Password Check--------------------------------------------------------------------------------------------------------------------------------------------------

//Input passwordfield
input.onkeyup = function() {
	
	//check length >= 5
	if(input.value.length >= 5) {
    length.classList.remove("invalid");
    length.classList.add("valid");
	lengValid = true;
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
	lengValid = false;
  }
  
	//check for number
	if(input.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
	numValid = true;
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
	numValid = false;
  }  
	
	//check if inputs are the same
	checkMatch();
	
}

//check if inputs are the same
function checkMatch(){
	
	//check if inputs are the same
	if(input.value == input_wdh.value){
	same.classList.remove("invalid");
    same.classList.add("valid");
	sameValid = true;
  } else {
    same.classList.remove("valid");
    same.classList.add("invalid");
	sameValid = false;
  }
  
  //check if all are fullfilled
  checkAll();
  
}

//Enable Button if all are fullfilled
function checkAll(){
	//check if all are fullfilled
	if(numValid && lengValid && sameValid){
		button.disabled = false;
	}
	else{
		button.disabled = true;
	}
}
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------