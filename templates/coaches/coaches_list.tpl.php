<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('title' => 'Treneriai'));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>

<div class="d-flex flex-row-reverse gap-3">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas treneris</a>
</div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Treneris nebuvo pašalintas.
	</div>
<?php } ?>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Vardas</th>
		<th>Pavardė</th>
		<th>Komanda</th>
		<th>Pareigos</th>
		<th></th>
	</tr>
	<?php
		$coach = new coaches();
		$teamlist = $coach->getTeamsList();
		$teamNames = array();
		
		foreach($teamlist as $key => $val)
		{
			$teamNames[$val['Kodas']] = $val['Pavadinimas'];
		}
		$roleList = $coach->getRolesList();
		$roles = array();
		foreach($roleList as $key => $val)
		{
			array_push($roles, $val['name']);
		}
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['id']}</td>"
					. "<td>{$val['Vardas']}</td>"
					. "<td>{$val['Pavardė']}</td>"
					. "<td>{$teamNames[$val['fk_Komanda']]}</td>"
					. "<td>{$roles[$val['fk_Pareigos']-1]}</td>"
					. "<td class='d-flex flex-row-reverse gap-2'>"
						. "<a href='index.php?module={$module}&action=edit&id={$val['id']}'>redaguoti</a>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['id']}\"); return false;'>šalinti</a>&nbsp;"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/common/paging.tpl.php';
?>