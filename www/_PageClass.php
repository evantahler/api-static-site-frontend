<?php

class Page
{
	protected $PAGE, $PageVariables, $Layout;
	
	public function __construct($Layout = null)
	{
		global $CONFIG;
		$this->PageVariables = array();
		if ($Layout == null)
		{
			$Layout = $CONFIG["DefaultLayout"];
		}
		if(file_exists($CONFIG['App_dir'] . $Layout))
		{
			$this->Layout = file_get_contents($CONFIG['App_dir'] . $Layout);
			$this->init_layout();
		}
		else
		{
			echo "Layout file ".($CONFIG['App_dir'] . $Layout)." not found";
			exit;
		}
	}
	
	public function init_layout()
	{
		$this->PAGE = $this->Layout;
	}
	
	public function clear_page()
	{
		$this->PAGE = "";
	}
	
	public function set($block, $value)
	{
		$this->PageVariables[$block] = $value;
	}
	
	public function fill($block, $content = "")
	{
		$this->PAGE = str_replace("##".$block."##",$content,$this->PAGE);
	}
	
	public function get_blocks()
	{
		$resp = preg_match_all("/##(\S*)##/",$this->Layout,$blocks);
		return $blocks[1];
	}
	
	public function remove_blocks()
	{
		$blocks = $this->get_blocks();
		foreach ($blocks as $block)
		{
			$this->fill($block);
		}
	}
	
	public function load_partials()
	{
		$blocks = $this->get_blocks();
		foreach ($blocks as $block)
		{
			$file = "partials/".$block.".php";
			$set_partials = array_keys($this->PageVariables);
			if(file_exists($file) && !in_array($block,$set_partials))
			{
				$block_contents = file_get_contents($file);
				$this->fill($block,$block_contents);
			}
		}
	}
	
	public function render()
	{
		$this->load_partials();
		foreach($this->PageVariables as $k => $v)
		{
			$this->fill($k, $v);
		}
		$this->remove_blocks();
		print $this->PAGE;
	}
	
}

?>