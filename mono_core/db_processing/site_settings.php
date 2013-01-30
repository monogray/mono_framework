<?php
class SiteSettings {
	// DB Settings
	public $bdServer = 'mysql302.1gb.ua';
	public $bdUser = 'gbua_nvt_db';
	public $bdPass = '5e038c07';
	
	public $_bd_table_prefix_names = 'vid';
	
	function SiteSettings() {
		$dbConnect = new DBConnect();
		$this->_bd_table_prefix_names = $dbConnect->_db_table_prefix_names;
	}
}
?>