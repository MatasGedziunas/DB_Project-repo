<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('link' => "index.php?module=report&action=list", 'title' => "Ataskaitos"), array("title" => "Žaidėjų būsenų ataskaita"));
	
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
	<label for="Sveikatos_būsena">Sveikatos būsena<?php echo in_array('Sveikatos_būsena', $required) ? '<span> *</span>' : ''; ?></label>
		<select id="Sveikatos_būsena" name="Sveikatos_būsena" class="form-select form-control">
			<?php
				// išrenkame visas kategorijas sugeneruoti pasirinkimų lauką
				
				$busenos = $playersObj->getSveikatos_BusenosList();
				foreach($busenos as $key => $val) {
					$selected = "";
					if(isset($data['Sveikatos_būsena']) && $data['Sveikatos_būsena'] == $val['id_Sveikatos_būsena']) {
						$selected = " selected='selected'";
					}
					echo "<option{$selected} value='{$val['id_Sveikatos_būsena']}'>{$val['name']}</option>";
				}
			?>
		</select>
	</div>	
	<label for="Pozicija">Pozicija<?php echo in_array('Pozicija', $required) ? '<span> *</span>' : ''; ?></label>
	<select id="Pozicija" name="Pozicija" class="form-select form-control">
    <?php
        // išrenkame visas kategorijas sugeneruoti pasirinkimų lauką
        
        $pozicijos = $playersObj->getPozicijuList();
        foreach($pozicijos as $key => $val) {
            $selected = "";
            if(isset($data['Pozicija']) && $data['Pozicija'] == $val['id_Pozicija']) {
                $selected = " selected='selected'";
            }
            echo "<option{$selected} value='{$val['id_Pozicija']}'>{$val['name']}</option>";
        }
    ?>
	</select>
	<div class="form-group">
    <label for="Metai">Metai<?php echo in_array('Metai', $required) ? '<span> *</span>' : ''; ?></label>
    	<input type="date" id="Metai" name="Metai" class="form-control" value="<?php echo isset($data['Metai']) ? $data['Metai'] : ''; ?>">
	</div>

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Sudaryti ataskaitą">

</form>