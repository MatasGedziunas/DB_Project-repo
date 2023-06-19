<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('link' => "index.php?module={$module}&action=list", 'title' => "Komandos"), array("title" => !empty($id) ? "Komandu redagavimas" : "Nauja komanda"));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>

<?php if($formErrors != null) { ?>
	<div class="alert alert-danger" role="alert">
		Neįvesti arba neteisingai įvesti šie laukai:
		<?php 
			echo $formErrors;
		?>
	</div>
<?php } ?>

<form action="" method="post" class="d-grid gap-3">
	<div class="form-group">
		<label for="Kodas">Kodas<?php echo in_array('Kodas', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Kodas" <?php if(isset($data['editing'])) { ?> readonly="readonly" <?php } ?> name="Kodas" class="form-control" value="<?php echo isset($data['Kodas']) ? $data['Kodas'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="Pavadinimas">Pavadinimas<?php echo in_array('Pavadinimas', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Pavadinimas" name="Pavadinimas" class="form-control" value="<?php echo isset($data['Pavadinimas']) ? $data['Pavadinimas'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="Miestas">Miestas<?php echo in_array('Miestas', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Miestas" name="Miestas" class="form-control" value="<?php echo isset($data['Miestas']) ? $data['Miestas'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="Šalis">Šalis<?php echo in_array('Šalis', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Šalis" name="Šalis" class="form-control" value="<?php echo isset($data['Šalis']) ? $data['Šalis'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="Įkurta_nuo">Įkurta_nuo<?php echo in_array('Įkurta_nuo', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="date" id="Įkurta_nuo" name="Įkurta_nuo" class="form-control" value="<?php echo isset($data['Įkurta_nuo']) ? $data['Įkurta_nuo'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="Biudžetas">Biudžetas<?php echo in_array('Biudžetas', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="Biudžetas" name="Biudžetas" class="form-control" value="<?php echo isset($data['Biudžetas']) ? $data['Biudžetas'] : ''; ?>">
	</div>

	<h4 class="mt-5">Komandos treneriai</h4>
	<div class="row w-200">
	<div class="formRowsContainer column">
	<div class="row headerRow<?php if(empty($data['treneriai']) || sizeof($data['treneriai']) == 1) echo ' d-none'; ?>">
				<div class="col-1">Kodas</div>
				<div class="col-2">Vardas</div>
				<div class="col-2">Pavardė</div>
				<div class="col-2">Pareigos</div>
	</div>

	<?php
				if(!empty($data['treneriai']) && sizeof($data['treneriai']) > 0) {
					$i = 0;
					foreach($data['treneriai'] as $key => $coach) {
						$disabledAttr = "";
						if($key === 0) {
							$disabledAttr = "disabled='disabled'";
						}

						$vardas = '';
						if(isset($coach['Vardas']) ) {
							$vardas = $coach['Vardas'];
						}

						$pavarde = '';
						if(isset($coach['Pavardė']) ) {
							$pavarde = $coach['Pavardė'];
						}

						$kodas = '';
						if(isset($coach['id']) ) {
							$kodas = $coach['id'];
						}
						
					?>
						<div class="formRow row col-17 <?php echo $key > 0 ? '' : 'd-none'; ?>">
						<div class="col-1"><input type="text" name="id[]" class="form-control" value="<?php echo $kodas; ?>" <?php echo $disabledAttr; ?> /></div>
						<div class="col-2"><input type="text" name="Vardas[]" class="form-control" value="<?php echo $vardas; ?>" <?php echo $disabledAttr; ?> /></div>
						<div class="col-2"><input type="text" name="Pavardė[]" class="form-control" value="<?php echo $pavarde; ?>" <?php echo $disabledAttr; ?> /></div>
						<div class="col-2">
						<select class="elementSelector form-select form-control" name="Pareigos[]" <?php echo $disabledAttr; ?>>
						<?php
							$C = new coaches();
							$roles = $C->getRolesList();
							foreach($roles as $key => $val) {
								$selected = "";
								if(isset($coach['fk_Pareigos']) && $coach['fk_Pareigos'] == $val['id_Trenerio_pareigos']) {
									$selected = " selected='selected'";
								}
								echo "<option{$selected} value='{$val['id_Trenerio_pareigos']}'>{$val['name']}</option>";
							}
						?>
						</select>
						</div>
						<div class="col-4"><a href="#" onclick="return false;" class="removeChild">šalinti</a></div>
						</div>
						
						<?php 
						$i++;
					}
				}
					?>
			</div>
			<div class="w-100">
			<a href="#" class="addChild">Pridėti</a>
			</div>
		</div>
	<?php if(isset($data['id'])) { ?>
		<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
	<?php } ?>

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>