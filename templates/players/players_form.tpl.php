<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('link' => "index.php?module={$module}&action=list", 'title' => "Žaidėjai"), array("title" => !empty($id) ? "Žaidėju redagavimas" : "Naujas žaidėjas"));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>

<?php if($formErrors != null) { ?>
	<div class="alert alert-danger" role="alert">
		Neįvesti arba neteisingai įvesti šie laukai:
		<?php 
			echo $data['Žaidėjo_Kodas'];
			echo $formErrors;
		?>
	</div>
<?php } ?>

<form action="" method="post" class="d-grid gap-3">
	<div class="form-group">
		<label for="Žaidėjo_Kodas">Žaidėjo_Kodas<?php echo in_array('Žaidėjo_Kodas', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Žaidėjo_Kodas" name="Žaidėjo_Kodas" <?php if(isset($data['editing'])) { ?> readonly="readonly" <?php } ?> class="form-control" value="<?php echo isset($data['Žaidėjo_Kodas']) ? $data['Žaidėjo_Kodas'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="Vardas">Vardas<?php echo in_array('Vardas', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Vardas" name="Vardas" class="form-control" value="<?php echo isset($data['Vardas']) ? $data['Vardas'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="Pavardė">Pavardė<?php echo in_array('Pavardė', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Pavardė" name="Pavardė" class="form-control" value="<?php echo isset($data['Pavardė']) ? $data['Pavardė'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="Numeris">Numeris<?php echo in_array('Numeris', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Numeris" name="Numeris" class="form-control" value="<?php echo isset($data['Numeris']) ? $data['Numeris'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="Ūgis">Ūgis<?php echo in_array('Ūgis', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Ūgis" name="Ūgis" class="form-control" value="<?php echo isset($data['Ūgis']) ? $data['Ūgis'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="Svoris">Svoris<?php echo in_array('Svoris', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Svoris" name="Svoris" class="form-control" value="<?php echo isset($data['Svoris']) ? $data['Svoris'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="fk_Pozicija">Pozicija<?php echo in_array('fk_Pozicija', $required) ? '<span> *</span>' : ''; ?></label>
		<select id="fk_Pozicija" name="fk_Pozicija" class="form-select form-control">
			<option value="-1">---------------</option>
			<?php
				// išrenkame visas pozicijas sugeneruoti pasirinkimų lauką
				$pozicijos = $playersObj->getPozicijuList();
				foreach($pozicijos as $key => $val) {
					$selected = "";
					if(isset($data['fk_Pozicija']) && $data['fk_Pozicija'] == $val['id_Pozicija']) {
						$selected = " selected='selected'";
					}
					echo "<option{$selected} value='{$val['id_Pozicija']}'>{$val['name']}</option>";
				}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="fk_Sveikatos_būsena">Sveikatos Būsena<?php echo in_array('fk_Sveikatos_būsena', $required) ? '<span> *</span>' : ''; ?></label>
		<select id="fk_Sveikatos_būsena" name="fk_Sveikatos_būsena" class="form-select form-control">
			<option value="-1">---------------</option>
			<?php
				// išrenkame visas kategorijas sugeneruoti pasirinkimų lauką
				$busenos = $playersObj->getSveikatos_BusenosList();
				foreach($busenos as $key => $val) {
					$selected = "";
					if(isset($data['fk_Sveikatos_būsena']) && $data['fk_Sveikatos_būsena'] == $val['id_Sveikatos_būsena']) {
						$selected = " selected='selected'";
					}
					echo "<option{$selected} value='{$val['id_Sveikatos_būsena']}'>{$val['name']}</option>";
				}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="Gimimo_data">Gimimo_data<?php echo in_array('Gimimo_data', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="date" id="Gimimo_data" name="Gimimo_data" class="form-control" value="<?php echo isset($data['Gimimo_data']) ? $data['Gimimo_data'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="fk_Komanda">Komanda<?php echo in_array('fk_Komanda', $required) ? '<span> *</span>' : ''; ?></label>
		<select id="fk_Komanda" name="fk_Komanda" class="form-select form-control">
			<option value="-1">---------------</option>
			<?php
				// išrenkame visas kategorijas sugeneruoti pasirinkimų lauką
				$komandos = $playersObj->getKomanduList();
				foreach($komandos as $key => $val) {
					$selected = "";
					if(isset($data['fk_Komanda']) && $data['fk_Komanda'] == $val['Kodas']) {
						$selected = " selected='selected'";
					}
					echo "<option{$selected} value='{$val['Kodas']}'>{$val['Pavadinimas']}</option>";
				}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="Kaina">Kaina<?php echo in_array('Kaina', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Kaina" name="Kaina" class="form-control" value="<?php echo isset($data['Kaina']) ? $data['Kaina'] : ''; ?>">
	</div>

	<?php if(isset($data['id'])) { ?>
		<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
	<?php } ?>

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>