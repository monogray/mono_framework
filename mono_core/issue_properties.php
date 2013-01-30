<?php
include_once 'db_processing/table_item.php';
include_once 'db_processing/site_settings.php';
class IssueProperties extends TableItem {
	// BD Table Settings
	public $_siteSettings;
	public $_bd_table_prefix_names;
	public $_bd_table_names = '_issue_properties';
	
	public $_fields_name = Array(			'id',	'name',			'type',			'field_name',			'value',						'description');
	public $_fields_type = Array(			'int',	'text',			'text',			'text',					'text',							'text');
	public $_fields_form_type = Array(		'na',	'text_field',	'text_field',	'text_field',			'text_field',					'text_area');
	public $_fields_form_name_ru = Array(	'№',	'Название',		'Тип',			'Название поля',		'Значения (через запятую)',		'Описание');
	
	function IssueProperties() {
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
}
?>