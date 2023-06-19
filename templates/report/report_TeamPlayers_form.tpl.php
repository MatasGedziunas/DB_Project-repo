<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('link' => "index.php?module=report&action=list", 'title' => "Ataskaitos"), array("title" => "Komandos žaidėjų ataskaita"));
	
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
	<label for="fk_Komanda">Komanda<?php echo in_array('fk_Komanda', $required) ? '<span> *</span>' : ''; ?></label>
		<select id="fk_Komanda" name="fk_Komanda" class="form-select form-control">
			<?php
				// išrenkame visas kategorijas sugeneruoti pasirinkimų lauką
				
				$komandos = $teamsObj->getTeamList();
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

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Sudaryti ataskaitą">

</form>