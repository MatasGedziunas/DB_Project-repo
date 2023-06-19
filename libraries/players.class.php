<?php
/**
 * Automobilių markių redagavimo klasė
 *
 * @author ISK
 */

class players {
	
	private $zaideju_lentele = '';
	private $sveikatos_lentele = '';
	private $poziciju_lentele = '';
	private $komandu_lentele = '';
	
	
	public function __construct() {
		$this->zaideju_lentele = 'žaidėjai';
		$this->sveikatos_lentele = 'sveikatos_būsena';
		$this->poziciju_lentele = 'pozicija';
		$this->komandu_lentele = 'komandos';

	}
	
	/**
	 * Markės išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getPlayer($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "SELECT *
				FROM {$this->zaideju_lentele}
				WHERE `Žaidėjo_Kodas`='{$id}'";
		$data = mysql::select($query);
		
		//
		return $data[0];
	}
	
	/**
	 * Markių sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getPlayerList($limit = null, $offset = null) {
		if($limit) {
			$limit = mysql::escapeFieldForSQL($limit);
		}
		if($offset) {
			$offset = mysql::escapeFieldForSQL($offset);
		}

		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
			
			if(isset($offset)) {
				$limitOffsetString .= " OFFSET {$offset}";
			}	
		}
		
		$query = "SELECT *
				FROM {$this->zaideju_lentele}
				{$limitOffsetString}";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	/**
	 * Markių kiekio radimas
	 * @return type
	 */
	public function getPlayerListCount() {
		$query = "SELECT COUNT(`Žaidėjo_Kodas`) as `kiekis`
				FROM {$this->zaideju_lentele}";
		$data = mysql::select($query);
		
		// 
		return $data[0]['kiekis'];
	}
	public function getSveikatos_BusenosList() {
		$query = "SELECT *
				FROM `{$this->sveikatos_lentele}`";
		$data = mysql::select($query);
		//
		return $data;
	}
	public function getPozicijuList() {
		$query = "SELECT *
				FROM `{$this->poziciju_lentele}`";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	public function getKomanduList() {
		$query = "SELECT *
				FROM `{$this->komandu_lentele}`";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	public function getPlayersWithStatusList($state) {
		$state = mysql::escapeFieldForSQL($state);
		$query = "SELECT *
				FROM `{$this->zaideju_lentele}` WHERE `{$this->zaideju_lentele}`.`fk_Sveikatos_būsena` = {$state}";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	/**
	 * Markės įrašymas
	 * @param type $data
	 */
	public function insertPlayer($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);

		$query = "INSERT INTO {$this->zaideju_lentele}
						  (`Žaidėjo_Kodas`,
			   `Vardas`,
			   `Numeris`,
			   `Pavardė`,
			   `Ūgis`,
			   `Svoris`,
			   `fk_Sveikatos_būsena`,
			   `Gimimo_data`,
			   `Kaina`,
			   `fk_Komanda`,
			   `fk_Pozicija`) 
			VALUES      ('{$data['Žaidėjo_Kodas']}',
						   '{$data['Vardas']}',
						   '{$data['Numeris']}',
						   '{$data['Pavardė']}',
						   '{$data['Ūgis']}',
						   '{$data['Svoris']}',
						   '{$data['fk_Sveikatos_būsena']}',
						   '{$data['Gimimo_data']}',
						   '{$data['Kaina']}',
						   '{$data['fk_Komanda']}',
						   '{$data['fk_Pozicija']}')";
		mysql::query($query);
	}
	
	/**
	 * Markės atnaujinimas
	 * @param type $data
	 */
	public function updatePlayer($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);

		$query = "UPDATE `{$this->zaideju_lentele}`
				SET `Vardas`='{$data['Vardas']}',
				`Numeris`='{$data['Numeris']}',
				`Pavardė`='{$data['Pavardė']}',
				`Ūgis`='{$data['Ūgis']}',
				`Svoris`='{$data['Svoris']}',
				`fk_Sveikatos_būsena`='{$data['fk_Sveikatos_būsena']}',
				`Gimimo_data`='{$data['Gimimo_data']}',
				`Kaina`='{$data['Kaina']}',
				`fk_Komanda`='{$data['fk_Komanda']}',
				`fk_Pozicija`='{$data['fk_Pozicija']}'
				WHERE `Žaidėjo_Kodas`='{$data['Žaidėjo_Kodas']}'";
		mysql::query($query);
	}
	
	/**
	 * Markės šalinimas
	 * @param type $id
	 */
	public function deletePlayer($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "DELETE FROM {$this->zaideju_lentele}
				WHERE `Žaidėjo_Kodas`='{$id}'";
		mysql::query($query);
	}
}

	