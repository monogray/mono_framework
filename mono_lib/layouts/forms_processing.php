<?php
class FormsProcessing {

	function FormsProcessing() {
	}
	
	function FilesProcessing($_dir, $_post_name, $_old_file_name='', $_max_file_size=10) {
		if ( !is_dir($_dir) )
			mkdir($_dir, 07777);
		
		$_separator = ';';
		$_attach = '';
		if( !is_array($_FILES[$_post_name]['name']) ){			// If single File
			if ( $_FILES[$_post_name]['name'] != NULL ){
				$_attach_name = date("d-m-Y H-i-s").'_'.$this->encodestring($_FILES[$_post_name]['name']);
				
				if($_FILES[$_post_name]['size'] > 1024*1024*$_max_file_size){
					$_SESSION['message'] .= '<div>Размер файла превышает '.$_max_file_size.' мегабайт</div>';
				} else if( copy($_FILES[$_post_name]['tmp_name'], "$_dir$_attach_name") ){
					$_attach = "$_dir/$_attach_name";
					$_SESSION['message'] .= '<div>Файл "'.$_attach_name.'" успешно загружен</div>';
					// Delete old File
					if($_old_file_name != $_attach && $_old_file_name != '')
						unlink($_old_file_name);
				} else{
					$_SESSION['message'] .= "<div>Ошибка загрузки файла</div>";
				}
			}
		}		// if( !is_array($_FILES[$_post_name]['name']) )
		else{													// If multiply Files
			$_len = count($_FILES[$_post_name]['name']);
			for ($i = 0; $i < $_len; $i++) {
				if ( $_FILES[$_post_name]['name'][$i] != NULL ){
					$_attach_name = date("d-m-Y H-i-s").'_'.$this->encodestring($_FILES[$_post_name]['name'][$i]);
					if($_FILES[$_post_name]['size'][$i] > 1024*1024*$_max_file_size){
						$_SESSION['message'] .= '<div>Размер файла превышает '.$_max_file_size.' мегабайт</div>';
					} else if( copy($_FILES[$_post_name]['tmp_name'][$i], "$_dir$_attach_name") ){
						if($_attach == '')
							$_attach = "$_attach_name";
						else 
							$_attach .= "$_separator$_attach_name";
						$_SESSION['message'] .= '<div>Файл "'.$_attach_name.'" успешно загружен</div>';
						// Delete old File
						//if($_old_file_name != $_attach && $_old_file_name != '')
							//unlink($_old_file_name);
					} else{
						$_SESSION['message'] .= "<div>Ошибка загрузки файла</div>";
					}
				}
			}
		}
		return $_attach;
	}
	
	// HELPER
	// Convert to Translite
	function encodestring($st) {
		// Сначала заменяем "односимвольные" фонемы
		$st=strtr($st,"абвгдеёзийклмнопрстуфхъыэ",
		"abvgdeeziyklmnoprstufh'ie");
		$st=strtr($st,"АБВГДЕЁЗИЙКЛМНОПРСТУФХЪЫЭ",
		"ABVGDEEZIYKLMNOPRSTUFH'IE");
		// Затем - "многосимвольные"
		$st=strtr($st, 
				array(
					"ж"=>"zh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", 
					"щ"=>"shch","ь"=>"", "ю"=>"yu", "я"=>"ya",
					"Ж"=>"ZH", "Ц"=>"TS", "Ч"=>"CH", "Ш"=>"SH", 
					"Щ"=>"SHCH","Ь"=>"", "Ю"=>"YU", "Я"=>"YA",
					"ї"=>"i", "Ї"=>"Yi", "є"=>"ie", "Є"=>"Ye"
					)
		);
		return $st;
	}
}