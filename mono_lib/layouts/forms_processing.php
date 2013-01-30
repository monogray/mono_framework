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
					$_SESSION['message'] .= '<div>������ ����� ��������� '.$_max_file_size.' ��������</div>';
				} else if( copy($_FILES[$_post_name]['tmp_name'], "$_dir$_attach_name") ){
					$_attach = "$_dir/$_attach_name";
					$_SESSION['message'] .= '<div>���� "'.$_attach_name.'" ������� ��������</div>';
					// Delete old File
					if($_old_file_name != $_attach && $_old_file_name != '')
						unlink($_old_file_name);
				} else{
					$_SESSION['message'] .= "<div>������ �������� �����</div>";
				}
			}
		}		// if( !is_array($_FILES[$_post_name]['name']) )
		else{													// If multiply Files
			$_len = count($_FILES[$_post_name]['name']);
			for ($i = 0; $i < $_len; $i++) {
				if ( $_FILES[$_post_name]['name'][$i] != NULL ){
					$_attach_name = date("d-m-Y H-i-s").'_'.$this->encodestring($_FILES[$_post_name]['name'][$i]);
					if($_FILES[$_post_name]['size'][$i] > 1024*1024*$_max_file_size){
						$_SESSION['message'] .= '<div>������ ����� ��������� '.$_max_file_size.' ��������</div>';
					} else if( copy($_FILES[$_post_name]['tmp_name'][$i], "$_dir$_attach_name") ){
						if($_attach == '')
							$_attach = "$_attach_name";
						else 
							$_attach .= "$_separator$_attach_name";
						$_SESSION['message'] .= '<div>���� "'.$_attach_name.'" ������� ��������</div>';
						// Delete old File
						//if($_old_file_name != $_attach && $_old_file_name != '')
							//unlink($_old_file_name);
					} else{
						$_SESSION['message'] .= "<div>������ �������� �����</div>";
					}
				}
			}
		}
		return $_attach;
	}
	
	// HELPER
	// Convert to Translite
	function encodestring($st) {
		// ������� �������� "��������������" ������
		$st=strtr($st,"������������������������",
		"abvgdeeziyklmnoprstufh'ie");
		$st=strtr($st,"�����Ũ������������������",
		"ABVGDEEZIYKLMNOPRSTUFH'IE");
		// ����� - "���������������"
		$st=strtr($st, 
				array(
					"�"=>"zh", "�"=>"ts", "�"=>"ch", "�"=>"sh", 
					"�"=>"shch","�"=>"", "�"=>"yu", "�"=>"ya",
					"�"=>"ZH", "�"=>"TS", "�"=>"CH", "�"=>"SH", 
					"�"=>"SHCH","�"=>"", "�"=>"YU", "�"=>"YA",
					"�"=>"i", "�"=>"Yi", "�"=>"ie", "�"=>"Ye"
					)
		);
		return $st;
	}
}