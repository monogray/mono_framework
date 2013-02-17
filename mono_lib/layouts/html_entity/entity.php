<?php
class Entity {
	static public $instance		= null;
	
	private $entity_layout_type	= 'closed';	// closed | self_closed. With closed tag or without
	private $entity_type;
	private $locator_type;
	private $locator_name;
	
	private $attrs				= Array();
	
	private $content;
	
	function Entity() {
	}
	
	static public function getNew() {
		return new Entity();
	}
	
	static public function inst(){
		if(self::$instance == null){
			self::$instance = new self();
		}else{
			self::$instance->entity_layout_type	= 'closed';
			self::$instance->entity_type = '';
			self::$instance->locator_type = '';
			self::$instance->locator_name = '';
			self::$instance->content = '';
			self::$instance->attrs = Array();
		}
		return self::$instance;
	}
	
	public function init($_entity_type, $_locator_type='', $_locator_name='', $_entity_layout_type='closed') {
		$this->entity_layout_type = $_entity_layout_type;
		$this->entity_type = $_entity_type;
		$this->locator_type = $_locator_type;
		$this->locator_name = $_locator_name;
		return $this;
	}
	
	public function setContent($_content) {
		if( is_string($_content) ){
			$this->content = $_content;
		}else if( get_class($_content) == 'Entity' ){
			$this->content = Array();
			$this->content[0] = $_content;
		}
		return $this;
	}
	
	public function addContent($_content) {
		if( is_string($_content) ){
			$this->content .= $_content;
		}else if( get_class($_content) == 'Entity' ){
			if(!is_array($this->content))
				$this->content = Array();
			array_push($this->content, $_content);
		}
		return $this;
	}
	
	public function addAttr($_atr_name, $_atr_val) {
		$this->attrs[$_atr_name] = $_atr_val;
		return $this;
	}

	public function draw() {
		echo $this->toString();
		return $this;
	}
	
	public function toString() {
		$res = '';
		$attrs = '';
		foreach ($this->attrs as $key => $value)
			$attrs .= "$key='$value' ";
	
		$content = '';
		if( is_string($this->content) ){
			$content = $this->content;
		}else if( is_array($this->content)){
			$_len = count($this->content);
			for($i = 0; $i < $_len; $i++ ){
				if( get_class($this->content[$i]) == 'Entity' ){
					$content .= $this->content[$i]->toString();
				}
			}
		}
	
		if($this->entity_layout_type == 'closed'){
			if($this->locator_type != '')
				$res = '<'.$this->entity_type.' '.$this->locator_type.'="'.$this->locator_name.'" '.$attrs.'>'.$content.'</'.$this->entity_type.'>';
			else
				$res = '<'.$this->entity_type.' '.$attrs.'>'.$content.'</'.$this->entity_type.'>';
		}else if($this->entity_layout_type == 'self_closed'){
			if($this->locator_type != '')
				$res = '<'.$this->entity_type.' '.$this->locator_type.'="'.$this->locator_name.'" '.$attrs.'/>';
			else
				$res = '<'.$this->entity_type.' '.$attrs.'/>';
		}
		return $res;
	}
	
	public function drawHeader() {
		$attrs = '';
		foreach ($this->attrs as $key => $value)
			$attrs .= "$key=$value ";
		
		if($this->locator_type != '')
			echo '<'.$this->entity_type.' '.$this->locator_type.'="'.$this->locator_name.'" '.$attrs.'>';
		else
			echo '<'.$this->entity_type.' '.$attrs.'>';
		return $this;
	}
	
	public function drawContent() {
		echo $this->content;
		return $this;
	}
	
	public function drawFooter($_locator_name_for_convenience='') {
		echo '</'.$this->entity_type.'>';
		return $this;
	}
	
	static public function drawFooter_st($_locator_type_for_convenience='', $_locator_name_for_convenience='') {
		if($_locator_type_for_convenience != '')
			self::$instance->entity_type = $_locator_type_for_convenience;
		echo '</'.self::$instance->entity_type.'>';
	}
}