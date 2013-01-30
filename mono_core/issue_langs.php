<?php
include_once 'db_processing/table_item.php';
include_once 'db_processing/site_settings.php';
class IssueLangs extends Issue {

	//public $_fields_name = Array('id', 'relative_id', 'name', 'summary', 'description', 'description_2', 'menu', 'img_1', 'img_2', 'img_3', 'img_arr', 'file_arr', 'order_by', 'css_class', 'css_id', 'tags', 'php_file', 'css_file', 'is_visible', 'properties', 'date');
	//public $_file_storage_path = Array('img_content/issue/', 'file_storage/files/', 'file_storage/scripts/');		
	
	function IssueLangs() {
		$this->_fields_name = Array('id', 'relative_id', 'name', 'summary', 'description', 'description_2', 'menu', 'img_1', 'img_2', 'img_3', 'img_arr', 'file_arr', 'order_by', 'css_class', 'css_id', 'tags', 'php_file', 'css_file', 'is_visible', 'properties', 'date');
		$this->_bd_table_names = '_issue_lang';
		parent::Issue();
	}
}