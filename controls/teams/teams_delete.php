<?php

// sukuriame užklausų klasės objektą
$teamsObj = new teams();

if(!empty($id)) {
	// patikriname, ar šalinama markė nepriskirta modeliui
	$count = $teamsObj->getTeamCountOfLeague($id);
	$count += $teamsObj->getTeamCountOfPlayer($id);
	$count += $teamsObj->getTeamCountOfCoaches($id);
	$count += $teamsObj->getTeamCountofMatches($id);

	$removeErrorParameter = '';
	if($count == 0) {
		// šaliname markę
		$teamsObj->deleteTeam($id);
	} else {
		// nepašalinome, nes markė priskirta modeliui, rodome klaidos pranešimą
		$removeErrorParameter = '&remove_error=1';
	}

	// nukreipiame į markių puslapį
	common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}

?>