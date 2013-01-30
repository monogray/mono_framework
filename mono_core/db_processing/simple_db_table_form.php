<?php
class Simple_DB_TableForm {
	public $class;
	public $mono_core_path;
	
	function Simple_DB_TableForm() {
	}
	
	function init($_class, $_mono_core_path='') {
		$this->class = $_class;
		$this->mono_core_path = $_mono_core_path;
	}
	
	function MainDraw() {
		if( !isset($_GET['db_chapter']) ){
			$this->TableListDraw();
		}else if( $_GET['db_chapter'] == 'create_new' ){
			$this->TableCreateNewDraw();
		}else if( $_GET['db_chapter'] == 'edit_form' ){
			$this->TableEditFormDraw();
		}else if( $_GET['db_chapter'] == 'save_form' ){
			$this->TableUpdateDraw();
		}
	}
	
	function TableListDraw() {
		$this->class->GetTableItems( 'all' );
		
		echo'<div><a href="index.php">&larr; Главная</a></div>';
		echo'<h2>Список записей</h2>';
		
		if(isset($_GET['guests_chapter'])){
			$_chapter_name = 'guests_chapter';
			$_GET['chapter'] = $_GET['guests_chapter'];
		}else{
			$_chapter_name = 'chapter';
		}
		
		echo'<div class="create_new_bt"><a href="index.php?'.$_chapter_name.'='.$_GET['chapter'].'&db_chapter=create_new">Создать новую запись</a></div>';
		
		$this->DrawDivAreaBig();
		for ($j = 0; $j < $this->class->bd_table_len; $j++) {
			echo'<div><a href="?chapter='.$_GET['chapter'].'&db_chapter=edit_form&id='.$this->class->bd_table_content['id'][$j].'">'.($j+1).'. '.$this->class->bd_table_content['name'][$j].' (id '.$this->class->bd_table_content['id'][$j].')</a>
			 [<a href="?chapter=main_menu_confirm_delete&id='.$this->class->bd_table_content['id'][$j].'">Удалить</a>]</div>';
		}
		$this->DrawDivAreaBigEnd();
		
		echo'<div class="create_new_bt"><a href="index.php?chapter='.$_GET['chapter'].'&db_chapter=create_new">Создать новую запись</a></div>';
	}
	
	function TableCreateNewDraw() {
		$this->class->CreateNew();
		$this->TableEditFormDraw( $this->class->ReturnLastInsertId() );
	}
	
	function TableEditFormDraw($id=null) {
		if($id == null)
			$id = $_GET['id'];
		$this->class->GetTableItems('query_one', Array('id'), Array($id));
		
		echo'<div><a href="index.php">&larr; Главная</a> &larr; <a href="?chapter='.$_GET['chapter'].'">Список записей</a></div>';
		echo'<h2>Редактирование раздела "'.$this->class->bd_table_content['name'][0].'" (id '.$id.')</h2>';
		
		//echo get_include_path();
		//set_include_path(".;./../;/usr/local/php5/PEAR");
		//echo get_include_path();
		
		include_once $this->mono_core_path.'layouts/form_layouts.php';
		$form_layouts = new FormsLayot();

		$form_layouts->formHeader('?chapter='.$_GET['chapter'].'&db_chapter=save_form&id='.$id);
		
		$form_layouts->formSubmit('Сохранить');
		$this->DrawSeparate();
		
		$_len = count($this->class->_fields_name);
		for ($i = 0; $i < $_len; $i++) {
			if($this->class->_fields_form_type[$i] == 'text_field'){
				$this->DrawDivAreaBig();
					$form_layouts->inputText($this->class->_fields_form_name_ru[$i].': ', 70, $this->class->bd_table_content[ $this->class->_fields_name[$i] ][0], $this->class->_fields_name[$i]);
				$this->DrawDivAreaBigEnd();
			}else if($this->class->_fields_form_type[$i] == 'text_area'){
				$this->DrawDivAreaBig();
					$this->DrawDivAreaBigCaption('<img src="images/layout/description.png" /> '.$this->class->_fields_form_name_ru[$i]);
					$form_layouts->inputTextarea('', 80, 5, $this->class->bd_table_content[ $this->class->_fields_name[$i] ][0], $this->class->_fields_name[$i], '', 'elrte_editor');
				$this->DrawDivAreaBigEnd();
			}else if($this->class->_fields_form_type[$i] == 'img'){
				$this->DrawDivAreaBig();
				if($mainMenu->bd_table_content[ $this->class->_fields_name[$i] ][0] != ''){
					$this->DrawDivAreaBig();
					echo '<div><a href="'.$mainMenu->bd_table_content[ $this->class->_fields_name[$i] ][0].'" target="_blank"><img src="'.$mainMenu->bd_table_content[ $this->class->_fields_name[$i] ][0].'" height="150px" /></a></div>';
					echo '<div>'.$this->infoMessages->site_adminka_url.$mainMenu->bd_table_content['img_1'][0].'</div>';
					//echo '<div><a href="?chapter=main_menu_delete_img&img=img_1&id='.$mainMenu->bd_table_content['id'][0].'">Удалить</a></div>';
					$this->DrawDivAreaBigEnd();
				}
				
				$form_layouts->inputFile($this->class->_fields_form_name_ru[$i].': ', $this->class->_fields_name[$i]);
				$this->DrawDivAreaBigEnd();
			}
		}
		
		$form_layouts->formSubmit('Сохранить');
		$form_layouts->formFooter();
	}
	
	function TableUpdateDraw($id=null) {
		if($id == null)
			$id = $_GET['id'];
		
		$_field_str = array  ();
		
		foreach ($_POST as $key => $value)	{
			//echo "Индекс:  $key;  Значение:  $value\n";
			$_ind = $this->GetIndexByValue($this->class->_fields_name, $key);
			
			if($this->class->_fields_form_type[$_ind] == 'text_field'){
				array_push($_field_str, $this->class->_fields_name[$_ind].' = "'.$value.'"');
			}else if($this->class->_fields_form_type[$_ind] == 'text_area'){
				$_text_area_val = htmlspecialchars($value);
				array_push($_field_str, $this->class->_fields_name[$_ind].' = "'.$_text_area_val.'"');
			}
		}
		
		$_query_sub_str = '';
		$_len = count($_field_str);
		for ($i = 0; $i < $_len; $i++) {
			if($i != $_len-1)
				$_query_sub_str .= $_field_str[$i].', ';
			else 
				$_query_sub_str .= $_field_str[$i];
		}
		
		mysql_query('
		UPDATE '.$this->class->db_table_names_full.' SET
			'.$_query_sub_str.'
			WHERE id = '.$id.' LIMIT 1;
		');
		
		$this->TableEditFormDraw( $id );
	}
	
	// HELPER FUNC PROCESSING
	function GetIndexByValue($_arr, $_val) {		// Get index of the array's element by value 
		$_len = count($_arr);
		$_ind = null;
		for ($i = 0; $i < $_len; $i++) {
			if($_arr[$i] == $_val)
				$_ind = $i;
		}
		return $_ind;
	}
	// END HELPER DRAW PROCESSING
	
	
	// HELPER DRAW PROCESSING
	function DrawDivAreaBig() {
		echo '<div class="div_area_big">';
	}
	function DrawDivAreaBigEnd() {
		echo '</div>';
	}
	function DrawDivAreaBigCaption($_caption) {
		echo '<h2>'.$_caption.'</h2>';
	}
	function DrawDivAreaBig2() {
		echo '<div class="div_area_big_2">';
	}
	function DrawDivAreaBig2End() {
		echo '</div>';
	}
	function DrawInfo($_info) {
		echo '<div class="info_field">'.$_info.'</div>';
	}
	function DrawSeparate() {
		echo '<div class="separate_1"></div>';
	}
	// END HELPER
}
?>