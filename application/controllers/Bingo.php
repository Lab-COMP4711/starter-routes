<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bingo
 *
 * @author manish
 */
class Bingo extends Application {
    //put your code here
    public function index()
	{
		// this is the view we want shown
		$this->data['pagebody'] = 'justone';

		// build the list of authors, to pass on to our view
		$first = $this->quotes->get('5');
                
		$this->data = array_merge($this->data, $first);

		$this->render();
	}
}
