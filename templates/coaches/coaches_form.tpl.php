<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Pradžia</a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?module=<?php echo $module; ?>&action=list">Treneriai</a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php if(!empty($id)) echo "Trenerio redagavimas"; else echo "Naujas treneris"; ?></li>
	</ol>
</nav>

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
		<label for="id">ID<?php echo in_array('id', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="id" name="id" <?php if(isset($data['editing'])) { ?> readonly="readonly" <?php } ?> class="form-control" value="<?php echo isset($data['id']) ? $data['id'] : ''; ?>">
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
		<label for="fk_Komanda">Komanda<?php echo in_array('fk_Komanda', $required) ? '<span> *</span>' : ''; ?></label>
		<select id="fk_Komanda" name="fk_Komanda" class="form-select form-control">
			<option value="-1">---------------</option>
			<?php
				// išrenkame visas kategorijas sugeneruoti pasirinkimų lauką
				$coachesObj = new coaches();
				$komandos = $coachesObj->getTeamsList();
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
		<label for="fk_Pareigos">Pareigos<?php echo in_array('fk_Pareigos', $required) ? '<span> *</span>' : ''; ?></label>
		<select id="fk_Pareigos" name="fk_Pareigos" class="form-select form-control">
			<option value="-1">---------------</option>
			<?php
				// išrenkame visas kategorijas sugeneruoti pasirinkimų lauką
				$pareigos = $coachesObj->getRolesList();
				foreach($pareigos as $key => $val) {
					$selected = "";
					if(isset($data['fk_Pareigos']) && $data['fk_Pareigos'] == $val['id_Trenerio_pareigos']) {
						$selected = " selected='selected'";
					}
					echo "<option{$selected} value='{$val['id_Trenerio_pareigos']}'>{$val['name']}</option>";
				}
			?>
		</select>
	</div>



	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>