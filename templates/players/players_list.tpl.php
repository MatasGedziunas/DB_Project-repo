	<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('title' => 'Žaidėjai'));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>

<div class="d-flex flex-row-reverse gap-3">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas žaidėjas</a>
</div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Žaidėjas nebuvo pašalintas
	</div>
<?php } ?>

<table class="table">
	<tr>
		<th>Kodas</th>
		<th>Vardas</th>
		<th>Pavardė</th>
		<th>Numeris</th>
		<th>Ūgis</th>
		<th>Svoris</th>
		<th>Sveikatos būsena</th>
		<th></th>
	</tr>
	<?php
		// suformuojame lentelę
		$playersObj = new players();
		$busenosList = $playersObj->getSveikatos_BusenosList();
		$busenos = array();
		foreach($busenosList as $key => $val)
		{
			array_push($busenos, $val['name']);
		}
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['Žaidėjo_Kodas']}</td>"
					. "<td>{$val['Vardas']}</td>"
					. "<td>{$val['Pavardė']}</td>"
					. "<td>{$val['Numeris']}</td>"
					. "<td>{$val['Ūgis']}</td>"
					. "<td>{$val['Svoris']}</td>"
					. "<td>{$busenos[$val['fk_Sveikatos_būsena']-1]}</td>"
					. "<td class='d-flex flex-row-reverse gap-2'>"
						. "<a href='index.php?module={$module}&action=edit&id={$val['Žaidėjo_Kodas']}'>redaguoti</a>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['Žaidėjo_Kodas']}\"); return false;'>šalinti</a>&nbsp;"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/common/paging.tpl.php';
?>