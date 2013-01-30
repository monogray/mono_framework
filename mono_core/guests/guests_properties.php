<?php
//include_once 'connect.php';
$dbConnect = new DBConnect();
if($_SESSION['acces_from'] == 'site'){
	include_once $dbConnect->mono_core_path_for_site.'db_processing/table_item.php';
	include_once $dbConnect->mono_core_path_for_site.'db_processing/site_settings.php';
}else{
	include_once $dbConnect->mono_core_path_for_adminka.'db_processing/table_item.php';
	include_once $dbConnect->mono_core_path_for_adminka.'db_processing/site_settings.php';
}
class GuestsProperties extends TableItem {
	// BD Table Settings
	public $_siteSettings;
	public $_bd_table_prefix_names;
	public $_bd_table_names = '_guests_properties';
	
	public $_fields_name = Array(			'id',	'guests_id',	'main_registration',	'main_conference',		'date');
	public $_fields_type = Array(			'int',	'int',			'int',					'int',					'date');
	public $_fields_form_type = Array(		'na',	'text_field',	'text_field',			'text_field',			'text_field');
	public $_fields_form_name_ru = Array(	'№',	'Пользователь',	'Главная регистрация',	'Главная конференция',	'Дата');
	
	function GuestsProperties() {
		$this->_siteSettings = new SiteSettings();
		$this->_bd_table_prefix_names = $this->_siteSettings->_bd_table_prefix_names;
		parent::TableItem($this->_bd_table_prefix_names, $this->_bd_table_names, $this->_fields_name);
	}
	
	function CreateNew() {
		mysql_query('INSERT INTO '.$this->db_table_names_full.'
				(id, name) VALUES(
				0,
				"Новая запись"
			)');
		
		$_SESSION['message'] .= '<div>Запись успешно создана</div>';
	}
	
	function CreateIfNotExist($_guests_id) {
		$this->GetTableItems('query_one', Array('guests_id'), Array($_guests_id));
		
		if($this->bd_table_len == 0){
			mysql_query('INSERT INTO '.$this->db_table_names_full.'
				(id, guests_id, main_registration, main_conference) VALUES(
				0,
				'.$_guests_id.',
				0,
				0
			)');
		}
	}
	
	function SetMainRegistration($_guests_id, $_val) {
		if($_val == true){
			mysql_query('
			UPDATE '.$this->_bd_table_prefix_names.$this->_bd_table_names.' SET
				main_registration = "1"
				WHERE guests_id = '.$_guests_id.' LIMIT 1;
			');
		}
	}
	
	function SaveFormData() {
		$id = $_GET['id'];
		//$_description = htmlspecialchars($_POST['description']);
		
		mysql_query('
		UPDATE '.$this->_bd_table_prefix_names.$this->_bd_table_names.' SET
			name = "'.$_POST['name'].'",
			surname = "'.$_POST['surname'].'",
			patronymic = "'.$_POST['patronymic'].'",
			groups = "'.$_POST['groups'].'"
			WHERE id = '.$id.' LIMIT 1;
		');
		
		$_SESSION['message'] .= '<div>Изменения успешно сохранены</div>';
	}
	
	function DeleteItem($_id) {
		mysql_query('DELETE FROM '.$this->_bd_table_prefix_names.$this->_bd_table_names.' WHERE id="'.$_id.'";');
		$_SESSION['message'] .= '<div>Раздел успешно удален</div>';
	}
	
	function ReturnLastInsertId() {
		$bd_table_name = $this->_bd_table_prefix_names.$this->_bd_table_names;
		$result = mysql_query("SELECT LAST_INSERT_ID() FROM $bd_table_name");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
}
?>