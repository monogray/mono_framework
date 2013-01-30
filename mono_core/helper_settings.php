<?php
include_once 'db_processing/table_item.php';
include_once 'db_processing/site_settings.php';
class HelperSettings extends TableItem {
	// BD Table Settings
	public $_siteSettings;
	public $_bd_table_prefix_names;
	public $_bd_table_names = '_helper_settings';
	public $_fields_name = Array('id', 'code', 'code_date');
	
	function HelperSettings() {
		$this->_siteSettings = new SiteSettings();
		$this->_bd_table_prefix_names = $this->_siteSettings->_bd_table_prefix_names;
		parent::TableItem($this->_bd_table_prefix_names, $this->_bd_table_names, $this->_fields_name);
	}
}
?>