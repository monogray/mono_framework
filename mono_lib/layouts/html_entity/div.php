<?php
class Div {
	private $locator_type;
	private $locator_name;
	
	private $content;
	
	function Div() {
	}
	
	static public function getNew() {
		return new Div();
	}
	
	public function init($_locator_type, $_locator_name) {
		$this->locator_type = $_locator_type;
		$this->locator_name = $_locator_name;
		return $this;
	}
	
	public function addContent($_content) {
		$this->content = $_content;
		return $this;
	}

	public function draw() {
		echo '<div '.$this->locator_type.'='.$this->locator_name.'>'.$this->content.'</div>';
		return $this;
	}
	
	public function drawHeader() {
		echo '<div '.$this->locator_type.'='.$this->locator_name.'>';
		return $this;
	}
	
	public function drawContent() {
		echo $this->content;
		return $this;
	}
	
	public function drawFooter() {
		echo '</div>';
		return $this;
	}
}