<?php

// sukuriame užklausų klasės objektą
$playersObj = new players();
$teamsObj = new teams();

$formErrors = null;
$fields = array();
$formSubmitted = false;
$required = array('Sveikatos_būsena', 'Pozicija', 'Metai');
$data = array();
if(empty($_POST['submit'])) {
	
	// rodome ataskaitos parametrų įvedimo formą
	include "templates/{$module}/{$module}_PlayersStatus_form.tpl.php";
} else {
	$formSubmitted = true;
	
	// nustatome laukų validatorių tipus
	$validations = array (
			'Sveikatos_būsena' => 'positivenumber',
			'Pozicija' => 'positivenumber',
			'Metai' => 'date'
			);
	
	// sukuriame validatoriaus objektą
	$validator = new validator($validations, $required);
	

	if($validator->validate($_POST)) {
		// išrenkame ataskaitos duomenis
		$data = $teamsObj->getReportPlayers($_POST['Metai'], $_POST['Sveikatos_būsena'], $_POST['Pozicija']);
		$statesList = $playersObj ->getSveikatos_BusenosList();
		$statesNames = array();
		foreach($statesList as $key => $val)
		{
			$statesNames[$val['id_Sveikatos_būsena']] = $val['name'];
		}
		$outink = $statesNames[$_POST['Sveikatos_būsena']];
		$pozicijos = $playersObj->getPozicijuList();
		$positionNames = array();
		foreach($pozicijos as $key => $val)
		{
			$positionNames[$val['id_Pozicija']] = $val['name'];
		}
		$pozicija = $positionNames[$_POST['Pozicija']];
		$combinedData = $teamsObj->getAllNumbers($_POST['Metai'], $_POST['Sveikatos_būsena'], $_POST['Pozicija']);
		// rodome ataskaitą
		include "templates/{$module}/{$module}_PlayersStatus_show.tpl.php";
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$fields = $_POST;
		
		// rodome ataskaitos parametrų įvedimo formą su klaidomis ir sustabdome scenarijaus vykdym1
		include "templates/{$module}/{$module}_PlayersStatus_form.tpl.php";
	}
}

