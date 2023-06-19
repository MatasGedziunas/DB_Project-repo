<?php
/**
 * Darbuotojų redagavimo klasė
 *
 * @author ISK
 */

class matches {
	
	private $treneriai_lentele = '';
	private $komandos_lentele = '';
    private $varzybos_lentele = '';
	public function __construct() {
		$this->treneriai_lentele = 'treneriai';
		$this->komandos_lentele = 'komandos';
        $this->varzybos_lentele = 'varžybos';
	}
	
	/**
	 * Darbuotojo išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getMatch($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "SELECT *
				FROM `{$this->varzybos_lentele}`
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
	public function getMatchesList($limit = null, $offset = null) {
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
				FROM `{$this->varzybos_lentele}`
				{$limitOffsetString}";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	
	/**
	 * Darbuotojų kiekio radimas
	 * @return type
	 */
	public function getMatchListCount() {
		$query = "SELECT COUNT(`id`) as `kiekis`
				FROM `{$this->varzybos_lentele}`";
		$data = mysql::select($query);
		
		//
		return $data[0]['kiekis'];
	}
	
	/**
	 * Darbuotojo šalinimas
	 * @param type $id
	 */
	public function deleteMatch($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "DELETE
				FROM `{$this->varzybos_lentele}`
				WHERE `id`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Darbuotojo atnaujinimas
	 * @param type $data
	 */
	public function updateMatch($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);
		$query = "UPDATE `{$this->varzybos_lentele}`
				SET `Data`='{$data['Data']}',
					`fk_Svečias`='{$data['fk_Svečias']}',
					`fk_Šeimininkas`='{$data['fk_Šeimininkas']}'
				WHERE `id`='{$data['id']}'";
		mysql::query($query);
	}
	public function getTeamsList()
	{
		$query = "SELECT *
				FROM `{$this->varzybos_lentele}`
				";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	/**
	 * Darbuotojo įrašymas
	 * @param type $data
	 */
	public function insertMatch($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);

		$query = "INSERT INTO `{$this->varzybos_lentele}`
						  (`id`,
                           `Data`,
						   `fk_Svečias`,
						   `fk_Šeimininkas`						   
                           ) 
				VALUES      ('{$data['id']}',
                            '{$data['Data']}',
						   '{$data['fk_Svečias']}',
						   '{$data['fk_Šeimininkas']}'
						   )";
		mysql::query($query);
	}

	
}