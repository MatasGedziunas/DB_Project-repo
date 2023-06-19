<ul id="reportInfo">
	<li><span><?php
			echo "{$outink} būsenos, iki {$_POST['Metai']} gimusių, {$pozicija} pozicijos žaidėjų sąrašas";
		?> </span></li>
</ul>
<?php		
	if(sizeof($data) > 0) { ?>
		<table class="table">
	<thead>
		<tr>
			<th>Žaidėjo kodas</th>
			<th>Žaidėjas</th>
			<th>Žaidėjo sužaistų varžybų skaičius</th>
			<th>Vidutiniškai pelnamų taškų skaičius</th>
			<th>Daugiausiai atkovotų kamuolių per vienas rungtynes</th>
			<th>Iš viso atlikti rezultatyvūs perdavimai</th>			
		</tr>
	</thead>
	<tbody>
	<?php
		for($i = 0; $i < sizeof($data); $i++)
		{
			if($i == 0 || $data[$i]['Komandos_kodas'] != $data[$i-1]['Komandos_kodas']) {
				echo
					"<tr class='table-primary'>"
						. "<td colspan='6'>{$data[$i]['Komandos_pavadinimas']}</td>"
					. "</tr>";
			}

			echo
							"<tr>"
								. "<td>{$data[$i]['Žaidėjo_kodas']}</td>"
								. "<td>{$data[$i]['Žaidėjas']}</td>"
								. "<td>{$data[$i]['Varžybų_skaičius']}</td>"
								. "<td>{$data[$i]['Vidutiniskai_taskai']}</td>"
								. "<td>{$data[$i]['Daugiausia_atkovotu_kamuoliu']}</td>"
								. "<td>{$data[$i]['Rezultatyvus_perdavimai']}</td>"							
							. "</tr>";
							if($i == (sizeof($data) - 1) || $data[$i]['Komandos_kodas'] != $data[$i+1]['Komandos_kodas']) {
								$teamBest = $teamsObj->getTeamBestNumbers($data[$i]['Komandos_kodas'], $_POST['Metai'], $_POST['Sveikatos_būsena'], $_POST['Pozicija']);								
								echo 
								"<tr>"
									. "<td colspan='2'></td>"
									. "<td>{$teamBest[0]['Varžybų_skaičius']} </td>"
									. "<td>{$teamBest[0]['Vidutiniskai_taskai']}</td>"
									. "<td>{$teamBest[0]['Daugiausia_atkovotu_kamuoliu']}</td>"
									. "<td>{$teamBest[0]['Rezultatyvus_perdavimai']}</td>"
									. "</tr>";		
							}	

		}
	?>
	<tr>
			<td colspan='6'>Bendri skačiai</td>
				</tr>				
				<tr>
					<td colspan="2"></td>
					<td><?php echo $combinedData[0]['Varžybų_skaičius']; ?></td>
					<td><?php echo $combinedData[0]['Vidutiniskai_taskai']; ?></td>
					<td><?php echo $combinedData[0]['Daugiausia_atkovotu_kamuoliu']; ?></td>
					<td><?php echo $combinedData[0]['Rezultatyvus_perdavimai']; ?></td>
				</tr>
	</tbody>
</table>
		<a href="index.php?module=report&action=PlayersStatus" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">nauja ataskaita</a>
<?php   
	} else {
?>
		<div class="warningBox">
			Nėra nurodytų žaidėjų
		</div>
<?php
	}
?>