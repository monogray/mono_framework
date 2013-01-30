<?php

include_once 'issue.php';
//include_once 'db_processing/site_settings.php';

class SubIssue extends Issue {
	// BD Table Settings
	public $__bd_table_names = '_sub_issue';
	
	function SubIssue() {
		$this->_bd_table_names = $this->__bd_table_names;
		$this->_file_storage_path = Array('img_content/sub_issue/', 'file_storage/sub_issue_files/', 'file_storage/sub_issue_scripts/');
		parent::Issue();
	}
}
?>