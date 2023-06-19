<?php

// sukuriame užklausų klasės objektą
$playersObj = new players();

if(!empty($id)) {
	$playersObj->deletePlayer($id);
	// nukreipiame į markių puslapį
	common::redirect("index.php?module={$module}&action=list");
	die();
}

?>