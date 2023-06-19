<?php

// sukuriame užklausų klasės objektą
$coachesObj = new coaches();

if(!empty($id)) {

	$coachesObj->deleteCoach($id);

	// nukreipiame į darbuotojų puslapį
	common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}

?>