<?php
/**
 *  Class draw main HTML elements
 */
class MonoLayouts {
	function MonoLayouts() {
	}
	
	// LAYOUTS
	function Draw_DivStart($_class = '', $_id='') {
		if($_id != '')
			echo '<div id="'.$_id.'">';
		else 
			echo '<div class="'.$_class.'">';
	}
	
	function Draw_DivEnd($_end_off = '') {
		echo '</div>';
	}
	
	function Draw_HyperLink($_href, $_text, $_class='', $_id='', $_title='', $_target='_self') {
		if($_class != '' && $_id == '')
			echo '<a href="'.$_href.'" title="'.$_title.'" class="'.$_class.'" target="'.$_target.'">'.$_text.'</a>';
		else if($_class == '' && $_id != '')
			echo '<a href="'.$_href.'" title="'.$_title.'" id="'.$_id.'" target="'.$_target.'">'.$_text.'</a>';
		else if($_class != '' && $_id != '')
			echo '<a href="'.$_href.'" title="'.$_title.'" class="'.$_class.'" id="'.$_id.'" target="'.$_target.'">'.$_text.'</a>';
		else if($_class == '' && $_id == '')
			echo '<a href="'.$_href.'" title="'.$_title.'" target="'.$_target.'">'.$_text.'</a>';
	}
	
	function Draw_H1($_text, $_class='', $_id='') {
		if($_class != '' && $_id == '')
			echo '<h1 class="'.$_class.'">'.$_text.'</h1>';
		else if($_class == '' && $_id != '')
			echo '<h1 id="'.$_id.'">'.$_text.'</h1>';
		else if($_class != '' && $_id != '')
			echo '<h1 class="'.$_class.'" id="'.$_id.'">'.$_text.'</h1>';
		else if($_class == '' && $_id == '')
			echo '<h1>'.$_text.'</h1>';
	}
	
	function Draw_H2($_text, $_class='', $_id='') {
		if($_class != '' && $_id == '')
			echo '<h2 class="'.$_class.'">'.$_text.'</h2>';
		else if($_class == '' && $_id != '')
			echo '<h2 id="'.$_id.'">'.$_text.'</h2>';
		else if($_class != '' && $_id != '')
			echo '<h2 class="'.$_class.'" id="'.$_id.'">'.$_text.'</h2>';
		else if($_class == '' && $_id == '')
			echo '<h2>'.$_text.'</h2>';
	}
	
	function Draw_image($_src, $_class='', $_id='', $_alt='', $_width='', $_height='') {
		$_class_id_str = '';
		if($_class != '')
			$_class_id_str .= ' class='.$_class.' ';
		if($_id != '')
			$_class_id_str .= ' id='.$_id.' ';
		if($_alt != '')
			$_class_id_str .= ' alt='.$_alt.' ';
		if($_width != '')
			$_class_id_str .= ' width='.$_width.' ';
		if($_height != '')
			$_class_id_str .= ' height='.$_height.' ';
		echo '<img src="'.$_src.'" '.$_class_id_str.'/>';
	}
}