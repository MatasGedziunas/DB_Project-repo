<?php

// sukuriame užklausų klasės objektą
$teamsObj = new teams();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('Kodas');
$required = array('Pavadinimas');
$required = array('Miestas');
$required = array('Šalis');
$required = array('Įkurta_nuo');


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
		// atnaujiname duomenis
		$teamsObj->updateTeam($_POST);
		$allTeamCoaches = $teamsObj->getTeamCoaches($id);
		// jeigu paslaugos kainos nerandame iš formos gautame masyve, šaliname
		
		foreach($allTeamCoaches as $coaches) {
			$found = false;
			if(isset($_POST['id'])) {
				foreach($_POST['id'] as $key => $val) {
				// gauname paslaugos id, galioja nuo ir kaina reikšmes {$price['fk_paslauga']}#{$price['galioja_nuo']}
					if($coaches['id'] == $_POST['id'][$key] && $coaches['Vardas'] == $_POST['Vardas'][$key] && $coaches['Pavardė'] == $_POST['Pavardė'][$key] && $coaches['fk_Pareigos'] == $_POST['Pareigos'][$key] && $coaches['fk_Komanda'] == $_POST['Kodas'])
					{
						$found = true;
					}
				}
			}

			if(!$found) {
				// šalinama paslaugos kaina				
				$teamsObj->deleteTeamCoach($coaches['id'], $coaches['Vardas'], $coaches['Pavardė'], $coaches['fk_Komanda'], $coaches['fk_Pareigos']);
			}
		}
		$flag = 0;
		if(isset($_POST['id'])) {
			foreach($_POST['id'] as $key => $coach) {
				// jeigu užsakytos paslaugos nerandame duomenų bazėje, tačiau ji yra formoje, įrašome
				$found = false;
				
				foreach($allTeamCoaches as $coaches) {
					if($coaches['id'] == $_POST['id'][$key] && $coaches['Vardas'] == $_POST['Vardas'][$key] && $coaches['Pavardė'] == $_POST['Pavardė'][$key] && $coaches['fk_Pareigos'] == $_POST['Pareigos'][$key] && $coaches['fk_Komanda'] == $_POST['Kodas'])
					{
						$found = true;
					}
				}

				if(!$found) {
					// įrašoma paslaugos kaina
					$CoachCount = $teamsObj ->checkIfCoachIDExists($_POST['id'][$key]);
					if($CoachCount > 0)
					{
						$formErrors = "Treneris su įvestu identifikatoriumi jau egzistuoja.";
						// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
						echo "<p> {$formErrors} </p>";
						$data = $_POST;
						$flag = 1;
					}
					else{
						$teamsObj->insertTeamCoach($_POST['id'][$key], $_POST['Vardas'][$key], $_POST['Pavardė'][$key], $_POST['Kodas'],$_POST['Pareigos'][$key]);
					}
					
				}
			}
		}
		// nukreipiame į markių puslapį
		if($flag != 1)
		{
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
				$data['treneriai'][$i]['id'] = $_POST['id'][$key];
				$data['treneriai'][$i]['Vardas'] = $_POST['Vardas'][$key];
				$data['treneriai'][$i]['Pavardė'] = $_POST['Pavardė'][$key];
				$data['treneriai'][$i]['Pareigos'] = $_POST['Pareigos'][$key];
				$i += 1;
			}
		}
		array_unshift($data['treneriai'], array());
	}
} else {
	// išrenkame elemento duomenis ir jais užpildome formos laukus.
	$data = $teamsObj->getTeam($id);
	
	$data['treneriai'] = $teamsObj->getTeamCoaches($id);

	array_unshift($data['treneriai'], array());
}
$data['editing'] = 1;
// įtraukiame šabloną
include "templates/{$module}/{$module}_form.tpl.php";

?>