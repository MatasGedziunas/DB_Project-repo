<?php
/**
 * Automobilių markių redagavimo klasė
 *
 * @author ISK
 */

class teams {
	private $komandos_lentele = '';
	private $komandos_lygos_lentele = '';
	private $zaideju_lentele = '';
	private $varzybu_lentele = '';
	private $treneriu_lentele = '';
	private $statistikos_lentele = '';
	private $komandos_statistikos_lentele = '';
	public function __construct() {
		$this->komandos_lentele = 'komandos';
		$this->komandos_lygos_lentele = 'komandos_lygos';
		$this->zaideju_lentele = 'žaidėjai';
		$this->varzybu_lentele = 'varžybos';
		$this->treneriu_lentele = 'treneriai';
		$this->statistikos_lentele = 'statistikos';
		$this->komandos_statistikos_lentele = 'komandos_statistikos';
	}
	
	/**
	 * Markės išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getTeam($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "SELECT *
				FROM {$this->komandos_lentele}
				WHERE `Kodas`='{$id}'";
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
	public function getTeamList($limit = null, $offset = null) {
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
				FROM {$this->komandos_lentele}
				{$limitOffsetString}";
		$data = mysql::select($query);
		
		//
		return $data;
	}

	/**
	 * Markių kiekio radimas
	 * @return type
	 */
	public function getTeamListCount() {
		$query = "SELECT COUNT(`Kodas`) as `kiekis`
				FROM {$this->komandos_lentele}";
		$data = mysql::select($query);
		
		// 
		return $data[0]['kiekis'];
	}
	
	/**
	 * Markės įrašymas
	 * @param type $data
	 */
	public function insertTeam($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);
		
		$query = "INSERT INTO `{$this->komandos_lentele}`
						  (`Kodas`,
						   `Pavadinimas`,
						   `Miestas`,
						   `Šalis`,
						   `Įkurta_nuo`,
						   `Biudžetas`) 
				VALUES      ('{$data['Kodas']}',
						   '{$data['Pavadinimas']}',
						   '{$data['Miestas']}',
						   '{$data['Šalis']}',
						   '{$data['Įkurta_nuo']}',
						   '{$data['Biudžetas']}')";

		mysql::query($query);
	}
	public function checkIfTeamIDExists($nr) {
		$nr = mysql::escapeFieldForSQL($nr);
		$query = "SELECT COUNT(`{$this->komandos_lentele}`.`Kodas`) AS `kiekis`
				FROM `{$this->komandos_lentele}`
				WHERE `{$this->komandos_lentele}`.`Kodas`='{$nr}'";
		$data = mysql::select($query);

		//
		return $data[0]['kiekis'];
	}
	public function getTeamCoaches($TeamId)
	{
		$TeamId = mysql::escapeFieldForSQL($TeamId);
		$query = "SELECT `{$this->treneriu_lentele}`.`Vardas`,
				`{$this->treneriu_lentele}`.`Pavardė`,
				`{$this->treneriu_lentele}`.`id`,
				`{$this->treneriu_lentele}`.`fk_Komanda`,
				`{$this->treneriu_lentele}`.`fk_Pareigos`
				FROM `{$this->treneriu_lentele}`
					INNER JOIN `{$this->komandos_lentele}`
						ON {$this->treneriu_lentele}.`fk_Komanda` = {$this->komandos_lentele}.`Kodas`
				WHERE `fk_Komanda` = '{$TeamId}'";
		$data = mysql::select($query);
		return $data;
	}
	public function getTeamPlayers($TeamId)
	{
		$TeamId = mysql::escapeFieldForSQL($TeamId);
		$query = "SELECT `{$this->zaideju_lentele}`.`Žaidėjo_Kodas`,
		`{$this->zaideju_lentele}`.`Vardas`,
		`{$this->zaideju_lentele}`.`Pavardė`,
		`{$this->zaideju_lentele}`.`Numeris`,
		`{$this->zaideju_lentele}`.`Ūgis`,
		`{$this->zaideju_lentele}`.`Svoris`,
		`{$this->zaideju_lentele}`.`fk_Sveikatos_būsena`,
		`{$this->zaideju_lentele}`.`fk_Komanda`
		FROM `{$this->komandos_lentele}` INNER JOIN `{$this->zaideju_lentele}`
		ON `{$this->komandos_lentele}`.`Kodas` = `{$this->zaideju_lentele}`.`fk_Komanda`
		WHERE `fk_Komanda` = '{$TeamId}'";
		$data = mysql::select($query);
		return $data;
	}
	/**
	 * Markės atnaujinimas
	 * @param type $data
	 */
	public function updateTeam($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);

		$query = "UPDATE {$this->komandos_lentele}
				SET `Pavadinimas`='{$data['Pavadinimas']}',
				`Miestas`='{$data['Miestas']}',
				`Šalis`='{$data['Šalis']}',
				`Įkurta_nuo`='{$data['Įkurta_nuo']}',
				`Biudžetas`='{$data['Biudžetas']}'
				WHERE `Kodas`='{$data['Kodas']}'";
		mysql::query($query);
	}
	/**
	 * Markės šalinimas
	 * @param type $id
	 */
	public function deleteTeam($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "DELETE FROM {$this->komandos_lentele}
				WHERE `Kodas`='{$id}'";
		mysql::query($query);
	}
	public function checkIfCoachIDExists($nr) {
		$nr = mysql::escapeFieldForSQL($nr);
		$query = "SELECT COUNT(`{$this->treneriu_lentele}`.`id`) AS `kiekis`
				FROM `{$this->treneriu_lentele}`
				WHERE `{$this->treneriu_lentele}`.`id`='{$nr}'";
		$data = mysql::select($query);
		//
		return $data[0]['kiekis'];
	}
	public function insertTeamCoach($id, $name, $surname, $team, $role)
	{
		$id = mysql::escapeFieldForSQL($id);
		$name = mysql::escapeFieldForSQL($name);
		$surname = mysql::escapeFieldForSQL($surname);
		$team = mysql::escapeFieldForSQL($team);
		$role = mysql::escapeFieldForSQL($role);
		$query = "INSERT INTO `{$this->treneriu_lentele}`
              (`id`,
               `Vardas`,
               `Pavardė`,
               `fk_Komanda`,	
               `fk_Pareigos`) 
              VALUES ('{$id}',
                      '{$name}',
                      '{$surname}',
                      '{$team}',
                      '{$role}')";
		mysql::query($query);
	}
	public function updateCoach($data) {
		$data = mysql::escapeFieldsArrayForSQL($data);
		$query = "UPDATE `{$this->treneriu_lentele}`
				SET `Vardas`='{$data['Vardas']}',
				    `Pavardė`='{$data['Pavardė']}',
					`fk_Komanda`='{$data['fk_Komanda']}',
					`fk_Pareigos`='{$data['fk_Pareigos']}'
				WHERE `id`='{$data['id']}'";
		mysql::query($query);
	}
	public function deleteTeamCoaches($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "DELETE FROM {$this->treneriu_lentele}
				WHERE `id`='{$id}'";
		mysql::query($query);
	}

	public function deleteTeamCoach($id, $vardas, $pavarde, $kodas, $pareigos) {
		$id = mysql::escapeFieldForSQL($id);
		$vardas = mysql::escapeFieldForSQL($vardas);
		$pavarde = mysql::escapeFieldForSQL($pavarde);
		$kodas = mysql::escapeFieldForSQL($kodas);
		$pareigos = mysql::escapeFieldForSQL($pareigos);
	
		$query = "DELETE FROM {$this->treneriu_lentele}
				WHERE `id`='{$id}'
				AND `Vardas`='{$vardas}'
				AND `Pavardė`='{$pavarde}'
				AND `fk_Komanda`='{$kodas}'
				AND `fk_Pareigos`='{$pareigos}'";
		mysql::query($query);
	}
	/**
	 * Markės modelių kiekio radimas
	 * @param type $id
	 * @return type
	 */
	public function getTeamCountOfLeague($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "SELECT COUNT({$this->komandos_lygos_lentele}.`fk_Komanda`) AS `kiekis`
				FROM {$this->komandos_lentele}
					INNER JOIN {$this->komandos_lygos_lentele}
						ON {$this->komandos_lentele}.`Kodas`={$this->komandos_lygos_lentele}.`fk_Komanda`
				WHERE {$this->komandos_lentele}.`Kodas`='{$id}'";
		$data = mysql::select($query);
		//
		return $data[0]['kiekis'];
	}
	public function getTeamCountOfPlayer($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "SELECT COUNT({$this->zaideju_lentele}.`fk_Komanda`) AS `kiekis`
				FROM {$this->komandos_lentele}
					INNER JOIN {$this->zaideju_lentele}
						ON {$this->komandos_lentele}.`Kodas`={$this->zaideju_lentele}.`fk_Komanda`
				WHERE {$this->komandos_lentele}.`Kodas`='{$id}'";
		$data = mysql::select($query);
		//
		return $data[0]['kiekis'];
	}
	public function getTeamCountofCoaches($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "SELECT COUNT({$this->treneriu_lentele}.`fk_Komanda`) AS `kiekis`
				FROM {$this->komandos_lentele}
					INNER JOIN {$this->treneriu_lentele}
						ON {$this->komandos_lentele}.`Kodas`={$this->treneriu_lentele}.`fk_Komanda`
				WHERE {$this->komandos_lentele}.`Kodas`='{$id}'";
		$data = mysql::select($query);
		//
		return $data[0]['kiekis'];
	}
	public function getTeamCountofMatches($id) {
		$id = mysql::escapeFieldForSQL($id);

		$query = "SELECT COUNT({$this->komandos_lentele}.`Kodas`) AS `kiekis`
				FROM {$this->komandos_lentele}
					INNER JOIN {$this->varzybu_lentele}
						ON {$this->komandos_lentele}.`Kodas`={$this->varzybu_lentele}.`fk_Svečias` OR {$this->komandos_lentele}.`Kodas`={$this->varzybu_lentele}.`fk_Šeimininkas`
				WHERE {$this->komandos_lentele}.`Kodas`='{$id}'";
		$data = mysql::select($query);
		//
		return $data[0]['kiekis'];
	}

	public function getReportPlayers($playerYearsFrom, $injury, $position)
	{
		$playerYearsFrom = mysql::escapeFieldForSQL($playerYearsFrom);
		$injury = mysql::escapeFieldForSQL($injury);
		$position = mysql::escapeFieldForSQL($position);

		$query = "SELECT {$this->komandos_lentele}.`Kodas` as 'Komandos_kodas', {$this->komandos_lentele}.`Pavadinimas` as 'Komandos_pavadinimas', {$this->zaideju_lentele}.`Žaidėjo_kodas` as 'Žaidėjo_kodas', CONCAT({$this->zaideju_lentele}.`vardas`, ' ', {$this->zaideju_lentele}.`pavardė`) as 'Žaidėjas', COUNT({$this->varzybu_lentele}.`id`) as 'Varžybų_skaičius', AVG({$this->statistikos_lentele}.`taškai`) as 'Vidutiniskai_taskai', MAX({$this->statistikos_lentele}.`atkovoti_kamuoliai`) as 'Daugiausia_atkovotu_kamuoliu', SUM({$this->statistikos_lentele}.`perdavimai`) as 'Rezultatyvus_perdavimai' 
		FROM {$this->komandos_lentele}
		INNER JOIN {$this->zaideju_lentele} ON {$this->komandos_lentele}.`Kodas` = {$this->zaideju_lentele}.`fk_komanda` 
		LEFT JOIN {$this->statistikos_lentele} ON {$this->zaideju_lentele}.`Žaidėjo_kodas` = {$this->statistikos_lentele}.`fk_Žaidėjas`
		LEFT JOIN {$this->varzybu_lentele} ON {$this->statistikos_lentele}.`fk_Varžybos` = {$this->varzybu_lentele}.`id`	
		WHERE {$this->zaideju_lentele}.`fk_Pozicija` = {$position} AND {$this->zaideju_lentele}.`fk_Sveikatos_būsena` = {$injury} AND ({$this->zaideju_lentele}.`Gimimo_data`) < '{$playerYearsFrom}'
		GROUP BY {$this->zaideju_lentele}.`Žaidėjo_kodas`
		ORDER BY {$this->komandos_lentele}.`Kodas` DESC";
		$data = mysql::select($query);
		return $data;
	}

	public function getTeamBestNumbers($team_id, $playerYearsFrom, $injury, $position)
	{
		$playerYearsFrom = mysql::escapeFieldForSQL($playerYearsFrom);	
		$injury = mysql::escapeFieldForSQL($injury);
		$position = mysql::escapeFieldForSQL($position);
		$team_id = mysql::escapeFieldForSQL($team_id);

		$query = "SELECT COUNT({$this->varzybu_lentele}.`id`) as 'Varžybų_skaičius', AVG({$this->statistikos_lentele}.`taškai`) as 'Vidutiniskai_taskai', MAX({$this->statistikos_lentele}.`atkovoti_kamuoliai`) as 'Daugiausia_atkovotu_kamuoliu', SUM({$this->statistikos_lentele}.`perdavimai`) as 'Rezultatyvus_perdavimai' 
		FROM {$this->komandos_lentele}
		LEFT JOIN {$this->zaideju_lentele} ON {$this->zaideju_lentele}.`fk_Komanda` = {$this->komandos_lentele}.`Kodas`
		INNER JOIN {$this->statistikos_lentele} ON {$this->zaideju_lentele}.`Žaidėjo_kodas` = {$this->statistikos_lentele}.`fk_Žaidėjas`
		INNER JOIN {$this->varzybu_lentele} ON {$this->statistikos_lentele}.`fk_Varžybos` = {$this->varzybu_lentele}.`id`
		WHERE  {$this->zaideju_lentele}.`fk_Pozicija` = {$position} AND {$this->zaideju_lentele}.`fk_Sveikatos_būsena` = {$injury} AND ({$this->zaideju_lentele}.`Gimimo_data`) < '{$playerYearsFrom}' AND {$this->zaideju_lentele}.`fk_Komanda` = {$team_id}
		";
		$data = mysql::select($query);
		return $data;
	}
	public function getAllNumbers($playerYearsFrom, $injury, $position)
	{
		$query = "SELECT COUNT({$this->varzybu_lentele}.`id`) as 'Varžybų_skaičius', AVG({$this->statistikos_lentele}.`taškai`) as 'Vidutiniskai_taskai', MAX({$this->statistikos_lentele}.`atkovoti_kamuoliai`) as 'Daugiausia_atkovotu_kamuoliu', SUM({$this->statistikos_lentele}.`perdavimai`) as 'Rezultatyvus_perdavimai' FROM {$this->komandos_lentele}
		LEFT JOIN {$this->zaideju_lentele} ON {$this->zaideju_lentele}.`fk_komanda` = {$this->komandos_lentele}.`Kodas`
		INNER JOIN {$this->statistikos_lentele} ON {$this->zaideju_lentele}.`Žaidėjo_kodas` = {$this->statistikos_lentele}.`fk_Žaidėjas`
		INNER JOIN {$this->varzybu_lentele} ON {$this->statistikos_lentele}.`fk_Varžybos` = {$this->varzybu_lentele}.`id`
		WHERE {$this->zaideju_lentele}.`fk_Pozicija` = {$position} AND {$this->zaideju_lentele}.`fk_Sveikatos_būsena` = {$injury} AND ({$this->zaideju_lentele}.`Gimimo_data`) < '{$playerYearsFrom}'";
		$data = mysql::select($query);
		return $data;
	}
}