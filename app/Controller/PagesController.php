<?php
/*
* @ Soceana Project 
* @ Pages Controller class
* @ Created on : 19th July 2013
* @ Created by : Inderjit Singh
*/
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		//pr($this->Session->read('User'))	;
	}
}
