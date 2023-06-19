<?php

// sukuriame užklausų klasės objektą
$playersObj = new players();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('Žaidėjo_Kodas', 'Vardas', 'Pavardė', 'Numeris', 'Ūgis', 'Svoris', 'fk_Pozicija', 'fk_Sveikatos_būsena', 'Gimimo_data', 'fk_Komanda');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'Žaidėjo_Kodas' => 7,
	'Vardas' => 15,
	'Pavardė' => 20,
	'Numeris' => 2,
	'Ūgis' => 3,
	'Svoris' => 3,
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'Žaidėjo_Kodas' => 'alfanum',
		'Vardas' => 'alfanum',
		'Pavardė' => 'alfanum',
		'Numeris' => 'positivenumber',
		'Ūgis' => 'positivenumber',
		'Svoris' => 'positivenumber',	
		'fk_Pozicija' => 'positivenumber',
		'fk_Sveikatos_būsena' => 'positivenumber',
		'fk_Komanda' => 'alfanum',
		'Gimimo_data' => 'date'
	);

	// sukuriame validatoriaus objektą
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// įrašome naują įrašą
		$playersObj->insertPlayer($_POST);

		// nukreipiame į markių puslapį
		common::redirect("index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
	}
}

// įtraukiame šabloną
include "templates/{$module}/{$module}_form.tpl.php";

?>