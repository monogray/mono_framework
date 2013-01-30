<?php
include_once 'db_processing/table_item.php';
include_once 'db_processing/site_settings.php';
class MainMenu extends TableItem {
	// BD Table Settings
	public $_siteSettings;
	public $_bd_table_prefix_names;
	public $_bd_table_names = '_main_menu';
	public $_fields_name = Array(			'id',	'name',			'chapter',		'is_sub_menu',				'lang',		'order_by',							'description',		'img_1',					'img_2',					'meta_keywords',	'meta_description',		'html_title',	'is_visible');
	public $_fields_type = Array(			'int',	'text',			'text',			'int',						'int',		'int',								'text',				'text',						'text',						'int',				'text',					'text',			'text');
	public $_fields_form_type = Array(		'na',	'text_field',	'text_field',	'text_field',				'auto',		'text_field',						'text_area',		'img',						'img',						'text_field',		'text_field',			'text_field',	'select');
	public $_fields_form_name_ru = Array(	'№',	'Название',		'Раздел',		'Является ли подменю',		'Язык',		'Последовательность отображения',	'Описание',			'Фоновое изображение 1',	'Фоновое изображение 2',	'Meta keywords',	'Meta description',		'HTML Title',	'Отображается ли на сайте');
	
	function MainMenu() {
		$this->_siteSettings = new SiteSettings();
		$this->_bd_table_prefix_names = $this->_siteSettings->_bd_table_prefix_names;
		parent::TableItem($this->_bd_table_prefix_names, $this->_bd_table_names, $this->_fields_name);
	}
	
	function SaveFormData() {
		$id = $_GET['id'];
		$_description = htmlspecialchars($_POST['description']);
		
		// Files
		include_once 'db_processing/forms_processing.php';
		$formsProcessing = new FormsProcessing();
		
		$result = mysql_query("SELECT img_1 FROM ".$this->_bd_table_prefix_names.$this->_bd_table_names." WHERE id='$id';");
		$row = mysql_fetch_array($result);
		
		$_img_1 = $formsProcessing->FilesProcessing('img_content/main_menu/'.$id, 'img_1', $row['img_1'], 20);
		if($_img_1 != ''){
			mysql_query('  
				UPDATE '.$this->_bd_table_prefix_names.$this->_bd_table_names.' SET
					img_1 = "'.$_img_1.'"
					WHERE id = '.$id.' LIMIT 1;
				');
		}
		
		$_img_2 = $formsProcessing->FilesProcessing('img_content/main_menu/'.$id, 'img_2', $row['img_2'], 20);
		if($_img_2 != ''){
			mysql_query('  
				UPDATE '.$this->_bd_table_prefix_names.$this->_bd_table_names.' SET
					img_2 = "'.$_img_2.'"
					WHERE id = '.$id.' LIMIT 1;
				');
		}
		
		mysql_query('  
		UPDATE '.$this->_bd_table_prefix_names.$this->_bd_table_names.' SET
			name = "'.$_POST['name'].'",
			description = "'.$_description.'",
			chapter = "'.$_POST['chapter'].'",
			is_sub_menu = "'.$_POST['is_sub_menu'].'",
			meta_keywords = "'.$_POST['meta_keywords'].'",
			meta_description = "'.$_POST['meta_description'].'",
			html_title = "'.$_POST['html_title'].'",
			is_visible = "'.$_POST['is_visible'].'",
			order_by = "'.$_POST['order_by'].'"
			WHERE id = '.$id.' LIMIT 1;
		');
		
		$_SESSION['message'] .= '<div>Изменения успешно сохранены</div>';
	}
	
	function DeleteImage($_id, $_img) {
		$this->GetTableItems( 'query_one', Array('id'), Array($_id) );

		if($this->bd_table_content[$_img][0] != '' ){
			unlink($this->bd_table_content[$_img][0]);
			mysql_query('  
			UPDATE '.$this->_bd_table_prefix_names.$this->_bd_table_names.' SET
				'.$_img.' = ""
				WHERE id = '.$_id.' LIMIT 1;
			');
		}
	}
	
	function CreateNew() {
		$_len = count($this->_fields_name);
		$_rows = implode(", ", $this->_fields_name);
		
		mysql_query('INSERT INTO '.$this->_bd_table_prefix_names.$this->_bd_table_names.'
				(id, name, lang, description, is_visible) VALUES(
				0,
				"Новый раздел",
				'.$_SESSION['lang'].',
				"Новое описание",
				1
			)');
		
		$_SESSION['message'] .= '<div>Раздел успешно создан</div>';
	}
	
	function ReturnLastInsertId() {
		$bd_table_name = $this->_bd_table_prefix_names.$this->_bd_table_names;
		$result = mysql_query("SELECT LAST_INSERT_ID() FROM $bd_table_name");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
	
	function DeleteItem($_id) {
		mysql_query('DELETE FROM '.$this->_bd_table_prefix_names.$this->_bd_table_names.' WHERE id="'.$_id.'";');
		$_SESSION['message'] .= '<div>Раздел успешно удален</div>';
	}
}
?>