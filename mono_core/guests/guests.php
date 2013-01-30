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
class Guests extends TableItem {
	// BD Table Settings
	public $_siteSettings;
	public $_bd_table_prefix_names;
	public $_bd_table_names = '_guests';
	
	public $_fields_name = Array(			'id',	'name',			'surname',		'patronymic',			'groups',						'date');
	public $_fields_type = Array(			'int',	'text',			'text',			'text',					'int',							'date');
	public $_fields_form_type = Array(		'na',	'text_field',	'text_field',	'text_field',			'select_field',					'na');
	public $_fields_form_name_ru = Array(	'№',	'Имя',			'Фамилия',		'Отчество',				'Група',						'Дата');
	
	function Guests() {
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
	
	function SaveFormData() {
		$id = $_GET['id'];
		//$_description = htmlspecialchars($_POST['description']);
		
		// Files
		$dbConnect = new DBConnect();
		include_once $dbConnect->mono_core_path_for_adminka.'db_processing/forms_processing.php';
		$formsProcessing = new FormsProcessing();
		
		//$result = mysql_query("SELECT img_1 FROM ".$this->_bd_table_prefix_names.$this->_bd_table_names." WHERE id='$id';");
		//$row = mysql_fetch_array($result);
		
		/*$_img_1 = $formsProcessing->FilesProcessing('img_content/guests/'.$id, 'img_1', $row['img_1'], 20);
		if($_img_1 != ''){
			mysql_query('  
				UPDATE '.$this->_bd_table_prefix_names.$this->_bd_table_names.' SET
					img_1 = "'.$_img_1.'"
					WHERE id = '.$id.' LIMIT 1;
				');
		}*/
		
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