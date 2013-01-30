<?php
/*	Functions List (02.07.2012)
	
	TableItem( $_bd_table_prefix_names, $_bd_table_names, $_bd_table_fields_names );
	GetTableItems( $_query_type = 'all', $_field_name = Array(), $_field_equals = Array(),  $_field_settings = Array() );
	ReturnLastInsertId();
*/
class TableItem {
	// DB Table Settings
	public $bd_table_prefix_names;
	public $bd_table_names;
	public $db_table_names_full;
	public $bd_table_fields_names = Array();
	
	public $query_type;
	public $field_name = Array();
	public $field_equals = Array();
	
	// DB Table All Content
	public $bd_table_len;
	public $bd_table_content = Array();
	
	function TableItem( $_bd_table_prefix_names, $_bd_table_names, $_bd_table_fields_names ) {
		$this->bd_table_prefix_names = $_bd_table_prefix_names;
		$this->bd_table_names = $_bd_table_names;
		$this->db_table_names_full = $this->bd_table_prefix_names.$this->bd_table_names;
		$this->bd_table_fields_names = $_bd_table_fields_names;
	}
	
	function GetTableItems( $_query_type = 'all', $_field_name = Array(), $_field_equals = Array(),  $_field_settings = Array(), $_sql_query = "" ) {
		$this->query_type = $_query_type;
		$this->field_name = $_field_name;
		$this->field_equals = $_field_equals;
		
		if( !isset($_field_settings['ORDER BY']) )
			$_field_settings['ORDER BY'] = 'id';
			
		if( !isset($_field_settings['SORT ORDER']) )
			$_field_settings['SORT ORDER'] = 'ASC';
		
		/*$bd_table_name = $this->bd_table_names.'_issue_type';
		if($this->query_type == 'all'){
			$result = mysql_query("SELECT * FROM $bd_table_name ORDER BY id	ASC;");
		}else if($this->query_type == 'one'){
			$result = mysql_query("SELECT * FROM $bd_table_name WHERE id='".$this->query_param['id']."' LIMIT 1;");
		}else if($this->query_type == 'one_by_name_ru'){
			$result = mysql_query("SELECT * FROM $bd_table_name WHERE name_ru='".$this->query_param['name']."' LIMIT 1;");
		}else if($this->query_type == 'one_by_name_eng'){
			$result = mysql_query("SELECT * FROM $bd_table_name WHERE name_eng='".$this->query_param['name']."' LIMIT 1;");
		}
		$i = 0;
		while( $row = mysql_fetch_array($result) ){
			$this->mono_issue_type__id[$i] = $row['id'];
			$this->mono_issue_type__name_ru[$i] = $row['name_ru'];
			$this->mono_issue_type__name_eng[$i] = $row['name_eng'];
			$this->mono_issue_type__description[$i] = $row['description'];
			$i++;
		}
		$this->mono_issue_type_length = count($this->mono_issue_type__id);*/
		
		$bd_table_name = $this->bd_table_prefix_names.$this->bd_table_names;
		if($this->query_type == 'all'){
			$result = mysql_query("SELECT * FROM $bd_table_name ORDER BY ".$_field_settings['ORDER BY']." ".$_field_settings['SORT ORDER'].";");
		}
		else if($this->query_type == 'query_all'){
			$_equal_query = '';
			$_len = count($this->field_name);
			for ($i = 0; $i < $_len; $i++) {
				if($this->field_equals[$i][0] == "!" && $this->field_equals[$i][1] == "=" ){
					$_sign = '!=';
					$this->field_equals[$i] = str_replace(array("!", "="), "", $this->field_equals[$i]);
				}else if($this->field_equals[$i][0] == ">"){
					$_sign = '>';
					$this->field_equals[$i] = str_replace(array(">"), "", $this->field_equals[$i]);
				}else{
					$_sign = '=';
				}

				if($i == 0)
					$_equal_query .= $this->field_name[$i].$_sign."'".$this->field_equals[$i]."'";
				else 
					$_equal_query .= " AND ".$this->field_name[$i].$_sign."'".$this->field_equals[$i]."'";
			}
			//$result = mysql_query("SELECT * FROM $bd_table_name WHERE ".$this->field_name[0]."='".$this->field_equals[0]."' ORDER BY ".$_field_name['ORDER BY']." ASC;");
			$result = mysql_query("SELECT * FROM $bd_table_name WHERE $_equal_query ORDER BY ".$_field_settings['ORDER BY']." ".$_field_settings['SORT ORDER'].";");
		}
		else if($this->query_type == 'query_one'){
			$result = mysql_query("SELECT * FROM $bd_table_name WHERE ".$this->field_name[0]."='".$this->field_equals[0]."' LIMIT 1;");
		}
		else if($this->query_type == 'query_all_by_sql_sintax'){
			$result = mysql_query("SELECT * FROM $bd_table_name WHERE $_sql_query;");
		}
		
		$_len = count($this->bd_table_fields_names);
		$i = 0;
		while( $row = mysql_fetch_array($result) ){
			for ($j = 0; $j < $_len; $j++) {
				$ind = $this->bd_table_fields_names[$j];
				$this->bd_table_content[$ind][$i] = $row[$ind];
			}
			$i++;
		}
		$this->bd_table_len = $i;
	}
	
	function ReturnLastInsertId() {
		$bd_table_name = $this->db_table_names_full;
		$result = mysql_query("SELECT LAST_INSERT_ID() FROM $bd_table_name");
		$row = mysql_fetch_array($result);
		return $row[0];
	}
}
?>