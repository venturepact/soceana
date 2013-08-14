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
	public $uses = array('LogHour');

	
	public $components = array('Session','Auth');    
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function beforeFilter() {		
		parent::beforeFilter();
		$this->Auth->allow('vision','management','faq');
	}
    
	public function display() {
		
		if($this->request->is('post')){
			 $this->Session->write('page_limit',$this->request->data['Pages']['limit']);  
		}
		
		if($this->Session->read('page_limit') != null){
			$limit = $this->Session->read('page_limit');			
		}
		else $limit = 5;
		
		if($this->Session->read('User.role') == 'organizations'){
			$this->set('loghours',$this->_organizationGridData($limit));	
		}
		else{
			$this->set('loghours',$this->_volunteerGridData($limit));	
		}		
		
	}
	
	public function _volunteerGridData($limit = 5){
		$fields = array('LogHour.id','LogHour.hours','LogHour.job_date','LogHour.status','Category.category_name','ServiceType.name','User.organization_name');
		
		 $this->paginate = array(
				'limit'       => $limit,
				'order'       => 'LogHour.job_date DESC',
				'fields'      => $fields,
				'conditions'  => array( 'user_id' => $this->Session->read('User.id'))
			);
		
		 $this->LogHour->bindModel(
			array('belongsTo' => array(
					'Category'    =>  array('className' => 'Category','joinTable' => 'categories','foreignKey' => 'category_id','fields'=>array('category_name')),
					'ServiceType' =>  array('className' => 'ServiceType','joinTable' => 'service_types','foreignKey' => 'service_type_id','fields'=>array('name')),
					'User'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'organization','fields'=>array('organization_name'))
				)
			),false
		);
		 
		return $this->paginate('LogHour');
	}
	
	public function _organizationGridData($limit = 5){
		$fields = array('LogHour.id','LogHour.hours','LogHour.job_date','LogHour.status','Category.category_name','ServiceType.name','User.first_name','User.last_name');
		
		 $this->paginate = array(
				'limit'       => $limit,
				'order'       => 'LogHour.job_date DESC',
				'fields'      => $fields,
				'conditions'  => array( 'organization' => $this->Session->read('User.id'))
			);
		
		 $this->LogHour->bindModel(
			array('belongsTo' => array(
					'Category'    =>  array('className' => 'Category','joinTable' => 'categories','foreignKey' => 'category_id','fields'=>array('category_name')),
					'ServiceType' =>  array('className' => 'ServiceType','joinTable' => 'service_types','foreignKey' => 'service_type_id','fields'=>array('name')),
					'User'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'user_id','fields'=>array('first_name','last_name'))
				)
			),false
		);
		 
		return $this->paginate('LogHour');
	}
	
	public function vision(){
		
	}
	
	public function management(){
		
	}
	public function faq(){
		
	}
}
