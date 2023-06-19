<ul id="reportInfo">
	<li><span><?php
			echo "{$outink} komandos žaidėjų sąrašas";
		?> </span></li>
</ul>
<?php		
	if(sizeof($data) > 0) { ?>
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
				. "</tr>";
		}
	?>
</table>
		<a href="index.php?module=report&action=TeamPlayers" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">nauja ataskaita</a>
<?php   
	} else {
?>
		<div class="warningBox">
			Nurodyta komanda neturi žaidėjų;
		</div>
<?php
	}
?>