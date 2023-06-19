<?php

// sukuriame užklausų klasės objektą
$coachesObj = new matches();

if(!empty($id)) {

	$coachesObj->deleteMatch($id);

	// nukreipiame į darbuotojų puslapį
	common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}

?>