<?php
include_once 'db_processing/table_item.php';
include_once 'db_processing/site_settings.php';
class Issue extends TableItem {
	// BD Table Settings
	public $_siteSettings;
	public $_bd_table_prefix_names;
	public $_bd_table_names = '_issue';
	public $_db_table_full_name;
	public $_fields_name = Array('id', 'name', 'summary', 'description', 'description_2', 'menu', 'img_1', 'img_2', 'img_3', 'img_arr', 'file_arr', 'order_by', 'css_class', 'css_id', 'tags', 'php_file', 'css_file', 'is_visible', 'properties', 'date');
	
	public $_file_storage_path = Array('img_content/issue/', 'file_storage/files/', 'file_storage/scripts/');		
	
	function Issue() {
		$this->_siteSettings = new SiteSettings();
		$this->_bd_table_prefix_names = $this->_siteSettings->_bd_table_prefix_names;
		parent::TableItem($this->_bd_table_prefix_names, $this->_bd_table_names, $this->_fields_name);
		
		$this->_db_table_full_name = $this->_bd_table_prefix_names.$this->_bd_table_names;
	}
	
	/** Save all POST data from Form to Database */
	function SaveFormData() {
		if( isset($_POST['name']) && isset($_POST['description']) ){		// If no errors in form
			// Converting data into the correct format
			$id = $_GET['id'];
			$_description = htmlspecialchars($_POST['description']);
			$_description_2 = htmlspecialchars($_POST['description_2']);
			$_summary = htmlspecialchars($_POST['summary']);
			
			// ISSUE PROPERTIES
			include_once 'issue_properties.php';
			$issueProp = new IssueProperties();
			$issueProp->GetTableItems('all');
			for ($j = 0; $j < $issueProp->bd_table_len; $j++) {
				$_prop .= $issueProp->bd_table_content['field_name'][$j].'='.$_POST[$issueProp->bd_table_content['field_name'][$j]].';';
			}
			// END ISSUE PROPERTIES
			
			mysql_query('  
			UPDATE '.$this->_db_table_full_name.' SET
				name = "'.$_POST['name'].'",
				summary = "'.$_summary.'",
				description = "'.$_description.'",
				description_2 = "'.$_description_2.'",
				menu = "'.$_POST['menu'].'",
				properties = "'.$_prop.'"
				WHERE id = '.$id.' LIMIT 1;
			');
			
			// Files and images processing
			include_once 'db_processing/forms_processing.php';
			$formsProcessing = new FormsProcessing();
			
			$this->SaveFormData_ImageSaveHelper('img_1', $id, $formsProcessing);
			$this->SaveFormData_ImageSaveHelper('img_2', $id, $formsProcessing);
			$this->SaveFormData_ImageSaveHelper('img_3', $id, $formsProcessing);
			$this->SaveFormData_ImageSaveHelper('img_arr', $id, $formsProcessing);
			$this->SaveFormData_ImageSaveHelper('php_file', $id, $formsProcessing);
			$this->SaveFormData_ImageSaveHelper('file_arr', $id, $formsProcessing);
			
			$_SESSION['message'] .= '<div>Изменения успешно сохранены</div>';
		}else{
			$_SESSION['message'] .= '<div>Ошибка сохранения данных</div>';
		}
	}
	
	function SaveFormData_ImageSaveHelper($_img='img_1', $id, $formsProcessing) {
		if($_img == 'img_arr' || $_img == 'file_arr' || $_img == 'php_file'){
			$result = mysql_query("SELECT $_img FROM ".$this->_db_table_full_name." WHERE id='$id';");
			$row = mysql_fetch_array($result);
			
			if($_img == 'img_arr')
				$_path = $this->_file_storage_path[0].$id;
			else if($_img == 'file_arr')
				$_path = $this->_file_storage_path[1].$id;
			else if($_img == 'php_file')
				$_path = $this->_file_storage_path[2].$id;
			
			$_img_str = $formsProcessing->FilesProcessing($_path, $_img, '', 20);
			if($_img_str != ''){
				if($row[$_img] != '')
					$_img_str = $row[$_img].','.$_img_str;
					
				mysql_query('  
					UPDATE '.$this->_db_table_full_name.' SET
						'.$_img.' = "'.$_img_str.'"
						WHERE id = '.$id.' LIMIT 1;
					');
			}
		}
		else {		// if single image processing
			$result = mysql_query("SELECT $_img FROM ".$this->_db_table_full_name." WHERE id='$id';");
			$row = mysql_fetch_array($result);
			$_img_str = $formsProcessing->FilesProcessing($this->_file_storage_path[0].$id, $_img, $row[$_img], 20);
			if($_img_str != ''){
				mysql_query('  
					UPDATE '.$this->_db_table_full_name.' SET
						'.$_img.' = "'.$_img_str.'"
						WHERE id = '.$id.' LIMIT 1;
					');
			}
		}
	}
	
	function CreateNew() {
		$_len = count($this->_fields_name);
		$_rows = implode(", ", $this->_fields_name);
		
		mysql_query('INSERT INTO '.$this->_db_table_full_name.'
			(id, name, lang, date) VALUES(
			0,
			"Новая запись",
			'.$_SESSION['lang'].',
			"'.date("Y-m-d H:i:s").'"
		)');
		
		$_SESSION['message'] .= '<div>Раздел успешно создан</div>';
		
		/*if($_SESSION['lang'] == 1){
			$_last_id = $this->ReturnLastInsertId();
			mysql_query('INSERT INTO '.$this->_bd_table_prefix_names.'_issue_langs
				(id, relative_id, name, lang, date) VALUES(
				0,
				'.$_last_id.',
				"New Item",
				2,
				"'.date("Y-m-d H:i:s").'"
			)');
		}*/
	}
	
	function ReturnLastInsertId() {
		$db_table_name = $this->_db_table_full_name;
		$result = mysql_query("SELECT LAST_INSERT_ID() FROM $db_table_name");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function DeleteItem($_id) {
		// Delete Attaches
		$this->GetTableItems( 'query_one', Array('id'), Array($_id) );
		
		if($this->bd_table_content['img_1'][0] != '' )
			unlink($this->bd_table_content['img_1'][0]);
		if($this->bd_table_content['img_2'][0] != '' )
			unlink($this->bd_table_content['img_2'][0]);
		
		rmdir($this->_file_storage_path[0].$_id);
		
		// Delete BD Data
		mysql_query('DELETE FROM '.$this->_db_table_full_name.' WHERE id="'.$_id.'";');
		$_SESSION['message'] .= '<div>Запись успешно удалена</div>';
	}
	
	function DeleteImgItem($_id, $_img) {
		$this->GetTableItems( 'query_one', Array('id'), Array($_id) );
		
		if( $_img == 'img_arr' || $_img == 'php_file' || $_img == 'file_arr' ){
			if( $this->bd_table_content[$_img][0] != '' ){
				$_img_arr = explode(",", $this->bd_table_content[$_img][0]);	// Array to String
				$_len = count($_img_arr);
				
				$_file_name = $_img_arr[$_GET['img_id']];			// Get file's name
				
				unlink($_img_arr[$_GET['img_id']]);
				unset($_img_arr[$_GET['img_id']]);					// Delet Array Element
				$_img_str = implode(",", $_img_arr);				// String to Array
				
				mysql_query('  
				UPDATE '.$this->_db_table_full_name.' SET
					'.$_img.' = "'.$_img_str.'"
					WHERE id = '.$_id.' LIMIT 1;
				');
			}
		}
		else {	// if single image processing
			$_file_name = $this->bd_table_content[$_img][0];		// Get file's name
			
			if($this->bd_table_content[$_img][0] != '' ){
				unlink($this->bd_table_content[$_img][0]);
				mysql_query('  
				UPDATE '.$this->_db_table_full_name.' SET
					'.$_img.' = ""
					WHERE id = '.$_id.' LIMIT 1;
				');
			}
		}
		
		$_SESSION['message'] .= '<div>Файл "'.$_file_name.'" Успешно удален</div>';
	}
	
	function ChangeImagesOrder($_id, $_img, $_order='top') {
		$this->GetTableItems( 'query_one', Array('id'), Array($_id) );
		$_file_name = $this->bd_table_content[$_img][0];
		
		if( $this->bd_table_content[$_img][0] != '' ){
			$_img_arr = explode(",", $this->bd_table_content[$_img][0]);
			$_len = count($_img_arr);
			
			$_img_id = (int)$_GET['img_id'];
			if($_order == 'top'){
				if($_img_id >= 1){
					$_tmp_val = $_img_arr[$_img_id-1];
					$_img_arr[$_img_id-1] = $_img_arr[$_img_id];
					$_img_arr[$_img_id] = $_tmp_val;
				}
			}else{
				if($_img_id < $_len-1){
					$_tmp_val = $_img_arr[$_img_id];
					$_img_arr[$_img_id] = $_img_arr[$_img_id+1];
					$_img_arr[$_img_id+1] = $_tmp_val;
				}
			}
			
			$_img_str = implode(",", $_img_arr);
			
			mysql_query('  
			UPDATE '.$this->_db_table_full_name.' SET
				'.$_img.' = "'.$_img_str.'"
				WHERE id = '.$_id.' LIMIT 1;
			');
		}
	}
}
?>