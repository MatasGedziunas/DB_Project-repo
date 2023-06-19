<?php

// sukuriame užklausų klasės objektą
$teamsObj = new teams();

$formErrors = null;
$fields = array();
$formSubmitted = false;
$required = array('fk_Komanda');
$data = array();
if(empty($_POST['submit'])) {
	
	// rodome ataskaitos parametrų įvedimo formą
	include "templates/{$module}/{$module}_TeamPlayers_form.tpl.php";
} else {
	$formSubmitted = true;
	
	// nustatome laukų validatorių tipus
	$validations = array (
			'fk_Komanda' => 'positivenumber',
			);
	
	// sukuriame validatoriaus objektą
	$validator = new validator($validations, $required);
	

	if($validator->validate($_POST)) {
		// išrenkame ataskaitos duomenis
		$data = $teamsObj->getTeamPlayers($_POST['fk_Komanda']);
		$teamNameList = $teamsObj ->getTeamList();
		$teamNamess = array();
		foreach($teamNameList as $key => $val)
		{
			$teamNamess[$val['Kodas']] = $val['Pavadinimas'];
		}
		$outink = $teamNamess[$_POST['fk_Komanda']];
		// rodome ataskaitą
		include "templates/{$module}/{$module}_TeamPlayers_show.tpl.php";
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$fields = $_POST;
		
		// rodome ataskaitos parametrų įvedimo formą su klaidomis ir sustabdome scenarijaus vykdym1
		include "templates/{$module}/{$module}_TeamPlayers_form.tpl.php";
	}
}

