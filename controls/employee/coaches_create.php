<?php
	
// sukuriame užklausų klasės objektą
$coachesObj = new coaches();

$formErrors = null;
$data = array();

// nustatome privalomus formos laukus
$required = array('id', 'Vardas', "Pavardė", 'fk_Komanda');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
);

// vartotojas paspaudė išsaugojimo mygtuką
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'id' => 'positivenumber',
		'Vardas' => 'alfanum',
		"Pavardė" => 'alfanum',
		'fk_Komanda' => 'positivenumber');

	// sukuriame laukų validatoriaus objektą
	$validator = new validator($validations, $required, $maxLengths);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// įrašome naują klientą
		$coachesObj->insertCoach($_POST);

		// nukreipiame vartotoją į klientų puslapį
		common::redirect("index.php?module={$module}&action=list");
		die();
	}
	else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();

		// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
		$data = $_POST;
	}
}

// įtraukiame šabloną
include "templates/{$module}/{$module}_form.tpl.php";

?>