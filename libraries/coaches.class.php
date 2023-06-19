<?php
/**
 * Darbuotojų redagavimo klasė
 *
 * @author ISK
 */

class coaches {
	
	private $treneriai_lentele = '';
	private $komandos_lentele = '';
	private $pareigos_lentele = '';
	public function __construct() {
		$this->treneriai_lentele = 'treneriai';
		$this->komandos_lentele = 'komandos';
		$this->pareigos_lentele = 'trenerio_pareigos';
	}
	
	/**
	 * Darbuotojo išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getCoach($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "SELECT *
				FROM `{$this->treneriai_lentele}`
				WHERE `id`='{$id}'";
		$data = mysql::select($query);
		
		//
		return $data[0];
	}
	
	/**
	 * Darbuotojų sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getCoachesList($limit = null, $offset = null) {
		if($limit) {
			$limit = mysql::escapeFieldForSQL($limit);
		}
		if($offset) {
			$offset = mysql::escapeFieldForSQL($offset);
		}

		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		$query = "SELECT *
				FROM `{$this->treneriai_lentele}`
				{$limitOffsetString}";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	
	/**
	 * Darbuotojų kiekio radimas
	 * @return type
	 */
	public function getCoachListCount() {
		$query = "SELECT COUNT(`id`) as `kiekis`
				FROM `{$this->treneriai_lentele}`";
		$data = mysql::select($query);
		
		//
		return $data[0]['kiekis'];
	}
	
	/**
	 * Darbuotojo šalinimas
	 * @param type $id
	 */
	public function deleteCoach($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "DELETE
				FROM `{$this->treneriai_lentele}`
				WHERE `id`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Darbuotojo atnaujinimas
	 * @param type $data
	 */
	public function updateCoach($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);
		$query = "UPDATE `{$this->treneriai_lentele}`
				SET `Vardas`='{$data['Vardas']}',
				    `Pavardė`='{$data['Pavardė']}',
					`fk_Komanda`='{$data['fk_Komanda']}',
					`fk_Pareigos`='{$data['fk_Pareigos']}'
				WHERE `id`='{$data['id']}'";
		mysql::query($query);
	}
	public function getTeamsList()
	{
		$query = "SELECT *
				FROM `{$this->komandos_lentele}`
				";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	public function getRolesList()
	{
		$query = "SELECT *
				FROM `{$this->pareigos_lentele}`
				";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	/**
	 * Darbuotojo įrašymas
	 * @param type $data
	 */
	public function insertCoach($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);

		$query = "INSERT INTO `{$this->treneriai_lentele}`
						  (`id`,
						   `Vardas`,
						   `Pavardė`,
						   `fk_Komanda`,
						   `fk_Pareigos`) 
				VALUES      ('{$data['id']}',
						   '{$data['Vardas']}',
						   '{$data['Pavardė']}',
						   '{$data['fk_Komanda']}',
						   '{$data['fk_Pareigos']}')";
		mysql::query($query);
	}

	
}