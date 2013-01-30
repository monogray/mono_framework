<?php
include_once 'db_processing/table_item.php';
include_once 'db_processing/site_settings.php';
class FileStorage extends TableItem {
	// BD Table Settings
	public $_siteSettings;
	public $_bd_table_prefix_names;
	public $_bd_table_names = '_file_storage';
	public $_fields_name = Array('id', 'file_link', 'date');
	
	function FileStorage() {
		$this->_siteSettings = new SiteSettings();
		$this->_bd_table_prefix_names = $this->_siteSettings->_bd_table_prefix_names;
		parent::TableItem($this->_bd_table_prefix_names, $this->_bd_table_names, $this->_fields_name);
	}
	
	function CreateNew() {
		$_len = count($this->_fields_name);
		$_rows = implode(", ", $this->_fields_name);
		
		include_once 'db_processing/forms_processing.php';
		$formsProcessing = new FormsProcessing();
		$_link = $formsProcessing->FilesProcessing('file_storage', 'file_link', '', 50);
		if($_link != ''){
			mysql_query('INSERT INTO '.$this->_bd_table_prefix_names.$this->_bd_table_names.'
				('.$_rows.') VALUES(
				0,
				"'.$_link.'",
				"'.date("Y-m-d H:i:s").'"
			)');
		}
	}
	
	function ReturnLastInsertId() {
		$bd_table_name = $this->_bd_table_prefix_names.$this->_bd_table_names;
		$result = mysql_query("SELECT LAST_INSERT_ID() FROM $bd_table_name");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function DeleteItem($_id, $_file_link) {
		mysql_query('DELETE FROM '.$this->_bd_table_prefix_names.$this->_bd_table_names.' WHERE id="'.$_id.'";');
		unlink($_file_link);
		$_SESSION['message'] .= '<div>Файл успешно удален</div>';
	}
}
?>