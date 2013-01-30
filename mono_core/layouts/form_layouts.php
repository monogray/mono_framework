<?php
class FormsLayot {
	function FormsLayot() {
	}
	
	function formHeader($_link) {
		echo '<form action="'.$_link.'" method="post" enctype="multipart/form-data">';
	}
	
	function formFooter() {
		echo '</form>';
	}
	
	function formSubmit($_value) {
		echo '<div><input type="submit" value="'.$_value.'" class="input_submit"/></div>';
	}
	
	function inputText($_name_on, $_size, $_value, $_name, $_id='', $_css_class='') {
		echo "<div class='$_css_class'>$_name_on<input type='text' size='$_size' value='$_value' name='$_name' id='$_id'/></div>";
	}
	
	function inputTextarea($_name_on, $_cols, $_rows, $_value, $_name, $_id='', $_class='') {
		echo "<div>$_name_on<br/><textarea cols='$_cols' rows='$_rows' name='$_name' id='$_id' class='$_class'>$_value</textarea></div>";
	}
	
	function inputCheckbox($_name_on, $_name, $_id="", $_is_checked=0) {
		if($_is_checked == 1)
			echo "<div><input type='checkbox' name='$_name' id='$_id' checked/>$_name_on</div>";
		else
			echo "<div><input type='checkbox' name='$_name' id='$_id'/>$_name_on</div>";
	}
	
	function inputFile($_name_on, $_name, $_is_multiple='false') {
		if(!$_is_multiple)
			echo "<div>$_name_on<input type='file' name='$_name'/></div>";
		else 
			echo "<div>$_name_on<input type='file' name='$_name' multiple='multiple'/></div>";
	}
	
	function inputSelect($_name_on, $_name, $_values, $_default_values="", $_value_text=null) {
		if($_value_text == null)
			$_value_text = $_values;
		echo "<div>
			$_name_on
			<select size='1' name='$_name'>
			<option disabled>Сделайте выбор</option>";
		$len = sizeof($_values);
		for ($i = 0; $i < $len; $i++) {
			if($_default_values != $_values[$i])
				echo '<option value="'.$_values[$i].'">'.$_value_text[$i].'</option>';
			else
				echo '<option selected="selected" value="'.$_values[$i].'">'.$_value_text[$i].'</option>';
		}	
		echo "</select></div>";
	}
	
	function inputHidden($_name, $_value) {
		echo "<input type='hidden' name='$_name' value='$_value'>";
	}
}
?>