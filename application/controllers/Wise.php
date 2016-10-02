<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wise extends Application
{

	function __construct()
	{
		parent::__construct();
	}
	
	public function bingo() { 
		$this->data['pagebody'] = 'justone';
		$author = $this->quotes->get('6');

	    $this->data = array_merge($this->data, $author);
		$this->render();
	}
}