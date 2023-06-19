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
		<label for="Data">Varžybų data<?php echo in_array('Data', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="date" id="Data" name="Data" class="form-control" value="<?php echo isset($data['Data']) ? $data['Data'] : ''; ?>">
	</div>

	<div class="form-group">
		<label for="fk_Šeimininkas">Šeimininkas<?php echo in_array('fk_Šeimininkas', $required) ? '<span> *</span>' : ''; ?></label>
		<select id="fk_Šeimininkas" name="fk_Šeimininkas" class="form-select form-control">
			<option value="-1">---------------</option>
			<?php
				// išrenkame visas kategorijas sugeneruoti pasirinkimų lauką
				$coachesObj = new coaches();
				$komandos = $coachesObj->getTeamsList();
				foreach($komandos as $key => $val) {
					$selected = "";
					if(isset($data['fk_Šeimininkas']) && $data['fk_Šeimininkas'] == $val['Kodas']) {
						$selected = " selected='selected'";
					}
					echo "<option{$selected} value='{$val['Kodas']}'>{$val['Pavadinimas']}</option>";
				}
			?>
		</select>
	</div>

	<div class="form-group">
    <label for="fk_Svečias">Svečias<?php echo in_array('fk_Svečias', $required) ? '<span> *</span>' : ''; ?></label>
    <select id="fk_Svečias" name="fk_Svečias" class="form-select form-control">
        <option value="-1">---------------</option>
        <?php
            // išrenkame visas kategorijas sugeneruoti pasirinkimų lauką
            $coachesObj = new coaches();
            $komandos = $coachesObj->getTeamsList();
            foreach($komandos as $key => $val) {
                $selected = "";
                if(isset($data['fk_Svečias']) && $data['fk_Svečias'] == $val['Kodas']) {
                    $selected = " selected='selected'";
                }
                echo "<option{$selected} value='{$val['Kodas']}'>{$val['Pavadinimas']}</option>";
            }
        ?>
    </select>
</div>


	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>