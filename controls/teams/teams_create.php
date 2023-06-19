<?php

// sukuriame užklausų klasės objektą
$teamsObj = new teams();

$formErrors = null;
$data = array();
$data['treneriai'] = array();
// nustatome privalomus laukus
$required = array('Įkurta_nuo', 'Šalis', 'Miestas', 'Pavadinimas', 'Kodas');


// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'Pavadinimas' => 25,
	'Kodas' => 10
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'Kodas' => 'alfanum',
		'Pavadinimas' => 'anything',
		'Miestas' => 'alfanum',
		'Šalis' => 'alfanum',
		'Įkurta_nuo' => 'date'
	);

	// sukuriame validatoriaus objektą
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// įrašome naują įrašą
		$Teamcount = $teamsObj ->checkIfTeamIDExists($_POST['Kodas']);
		$coachIds = $_POST['id'];
		$flag = 0;
		foreach($coachIds as $key => $val)
		{
			if(isset($val))
			{
				$CoachCount = $teamsObj ->checkIfCoachIDExists($val);
				if($CoachCount > 0)
				{
					$formErrors = "Treneris su įvestu identifikatoriumi jau egzistuoja.";
					// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
					echo "<p> {$formErrors} </p>";
					$data = $_POST;
					$flag = 1;
				}
			}
		}
		if($Teamcount > 0) {
			// sudarome klaidų pranešimą
			$formErrors = "Komanda su įvestu identifikatoriumi jau egzistuoja.";
			// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
			echo "<p> {$formErrors} </p>";
			$data = $_POST;

		}
		elseif($flag == 0)
		{
			$teamsObj->insertTeam($_POST);
			foreach($_POST['id'] as $key => $coach)
			{
				$teamsObj->insertTeamCoach($_POST['id'][$key], $_POST['Vardas'][$key], $_POST['Pavardė'][$key], $_POST['Kodas'],$_POST['Pareigos'][$key]);
				echo "<p> valio </p>";
			}
			// nukreipiame į markių puslapį
			common::redirect("index.php?module={$module}&action=list");
		}
		
		die();
	} else {

		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;

		$data['treneriai'] = array();
		if(isset($_POST['id']))
		{
			$i = 0;
			foreach($_POST['id'] as $key => $val)
			{
				$data['treneriai'][$i]['id'] = $_POST['id'];
				$data['treneriai'][$i]['Vardas'] = $_POST['Vardas'];
				$data['treneriai'][$i]['Pavardė'] = $_POST['Pavardė'];
				$data['treneriai'][$i]['Pareigos'] = $_POST['Pareigos'];
				$i += 1;
			}
		}
	}
}
array_unshift($data['treneriai'], array());
// įtraukiame šabloną
include "templates/{$module}/{$module}_form.tpl.php";

?>