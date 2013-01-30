<?php
include_once 'db_processing/table_item.php';
include_once 'db_processing/site_settings.php';
class Localization extends TableItem {
	// BD Table Settings
	public $_siteSettings;
	public $_bd_table_prefix_names;
	public $_bd_table_names = '_localization';
	public $_fields_name = Array('id', 'lang', 'name', 'description');
	
	function Localization() {
		$this->_siteSettings = new SiteSettings();
		$this->_bd_table_prefix_names = $this->_siteSettings->_bd_table_prefix_names;
		parent::TableItem($this->_bd_table_prefix_names, $this->_bd_table_names, $this->_fields_name);
	}
}
?>