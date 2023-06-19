<?php

// sukuriame užklausų klasės objektą
$coachesObj = new matches();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $coachesObj->getMatchListCount();

// sukuriame puslapiavimo klasės objektą
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio darbuotojus
$data = $coachesObj->getMatchesList($paging->size, $paging->first);

// įtraukiame šabloną
include "templates/{$module}/{$module}_list.tpl.php";

?>