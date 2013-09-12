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
		$this->Auth->allow('vision','management','faq','contact','about','messages_delete','send_message','send_message2');
	}
    
	/* @ function to display the dashboard of the logged user */
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
		//pr($this->_messages());die;
		//$this->set('messages',$this->_messages());
		
	}
	
	/* @ function to show the Volunteer Grid Data */
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
	
	/* @ function to show the Organization Grid Data */
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
	
	/* @ function for vision page */
	public function vision(){
	     $this->layout = 'default2';
	}
	
	/* @ function for management page */
	public function management(){
	     $this->layout = 'default2';
	}
	
	/* @ function for faq page */
	public function faq(){
	     $this->layout = 'default2';
	}
	
	/* @ function for contact page */
	public function contact(){
	    $this->layout = 'default2';
	}
	
	/* @ function for aboutus page */
	public function about(){
	    $this->layout = 'default2';
	}
	
	public function messages(){
		$this->layout = 'ajax';
		
		$this->loadModel('Message');
		
		$this->Message->bindModel(
			array('belongsTo' => array(					
					'User'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'message_from','fields'=>array('first_name','last_name','thumb_image'))
				)
			),false
		);
		
		$conditions = array('message_to'=>$this->Session->read('User.id'));
		$records = $this->Message->find('all',array('conditions'=>$conditions));
		$this->set('messages',$records);		
	}
	
	public function messages_delete(){
		 $this->layout = 'ajax';
		$ids = $this->request->data['ids'];
		$this->loadModel('Message');
		foreach($ids as $id){
		  $this->Message->delete($id);
		}		
		$this->autoRender = false;
	}
	
	public function send_message(){
		$this->layout = 'ajax';
		$data['Message']['message_to'] = $this->request->data['message_to'];
		$data['Message']['message'] = $this->request->data['message'];
		$data['Message']['message_from'] = $this->Session->read('User.id');		
		$this->loadModel('Message');
		$this->Message->save($data);
		$id = $this->Message->id;
		$data2['Message']['reference_id'] = $id;
		$this->Message->save($data2);
		$this->autoRender = false;
	}
	
	public function message_reply(){
		$this->layout = 'ajax';		
		$this->loadModel('Message');
		
		$message = $this->Message->find('first',array(
							      'conditions'=>array('Message.id'=>$this->request->data['id']),
							      'fields'=>array('reference_id','message_from')
							      ));
		
		
		$this->Message->bindModel(
			array('belongsTo' => array(					
					'User'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'message_from','fields'=>array('first_name','last_name','thumb_image'))
				)
			),false
		);	
		
		
		$mess = $this->Message->find('all',array(
								     'conditions'=>array('Message.reference_id'=>$message['Message']['reference_id']),
								     'order'=>'id',
							 ));
		$this->set('mess',$mess);
		$this->set('reference_id',$message['Message']['reference_id']);
		$this->set('message_from',$message['Message']['message_from']);
				
	}
	
	public function send_message2(){
		$this->layout = 'ajax';
		$data['Message']['message_to'] = $this->request->data['message_to'];
		$data['Message']['message'] = $this->request->data['message'];
		$data['Message']['message_from'] = $this->Session->read('User.id');
		$data['Message']['reference_id'] = $this->request->data['reference_id'];
		$this->loadModel('Message');
		$this->Message->save($data);	
		$this->autoRender = false;
	}
}