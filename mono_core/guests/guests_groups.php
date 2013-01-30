<?php
include_once 'connect.php';
$dbConnect = new DBConnect();
include_once $dbConnect->mono_core_path_for_adminka.'db_processing/table_item.php';
include_once $dbConnect->mono_core_path_for_adminka.'db_processing/site_settings.php';
class GuestsGroups extends TableItem {
	// BD Table Settings
	public $_siteSettings;
	public $_bd_table_prefix_names;
	public $_bd_table_names = '_guests_groups';
	
	public $_fields_name = Array(			'id',	'name',			'description',	'main_conference',		'date');
	public $_fields_type = Array(			'int',	'text',			'text',			'text',					'date');
	public $_fields_form_type = Array(		'na',	'text_field',	'text_field',	'text_field',			'na');
	public $_fields_form_name_ru = Array(	'№',	'Название',		'Опписание',	'111Отчество',			'Дата');
	
	function GuestsGroups() {
		$this->_siteSettings = new SiteSettings();
		$this->_bd_table_prefix_names = $this->_siteSettings->_bd_table_prefix_names;
		parent::TableItem($this->_bd_table_prefix_names, $this->_bd_table_names, $this->_fields_name);
	}
	
	function CreateNew() {
		mysql_query('INSERT INTO '.$this->db_table_names_full.'
				(id, name) VALUES(
				0,
				"Новая группа"
			)');
		$_SESSION['message'] .= '<div>Запись успешно создана</div>';
	}
	
	function SaveFormData() {
		$id = $_GET['id'];
		$_description = htmlspecialchars($_POST['description']);
		
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
			description = "'.$_description.'"
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