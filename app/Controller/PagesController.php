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
		//echo 'select distinct(l.category_id)as cat_id ,c.category_name,(select sum(hours) from log_hours where category_id = cat_id and user_id = '.$this->Session->read('User.id').' and status = 1)as total_hours from log_hours l,categories c where l.user_id = '.$this->Session->read('User.id').' and c.id = l.category_id and l.status = 1';
		//pr($this->Session->read('User'))	;
	}
}
