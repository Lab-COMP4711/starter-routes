<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class First extends Application
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Homepage for our app
	 */
	public function index()
	{
		// this is the view we want shown
		$this->data['pagebody'] = 'justone';

		// build the list of authors, to pass on to our view
		$first = $this->quotes->get('1');
                
		$this->data = array_merge($this->data, $first);

		$this->render();
	}
        public function zzz() { 
            $this->data['pagebody'] = 'justone';
            $author = $this->quotes->get('1');
                
	    $this->data = array_merge($this->data, $author);
            $this->render();
        }
        public function gimme($id){
            // this is the view we want shown
		$this->data['pagebody'] = 'justone';

		// build the list of authors, to pass on to our view
		$author = $this->quotes->get($id);
                
		$this->data = array_merge($this->data, $author);

		$this->render(); 
        }
}