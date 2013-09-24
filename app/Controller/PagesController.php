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
			
			$this->loadModel('LogHour');
			//$this->LogHour->recursive = -1;
			$this->set('total_hours',$this->LogHour->find('first',array(
											     'conditions'=>array(
												 				'organization'=>$this->Session->read('User.id'),
																'LogHour.status' => 1
																),
												 'fields'=>array('sum(hours) as total_hours')
			)));
				
		}
		else{
			$this->set('loghours',$this->_volunteerGridData($limit));	
			$this->loadModel('LogHour');
			//$this->LogHour->recursive = -1;
			$this->set('total_hours',$this->LogHour->find('first',array(
											     'conditions'=>array(
												 				'user_id'=>$this->Session->read('User.id'),
																'LogHour.status' => 1
																),
												 'fields'=>array('sum(hours) as total_hours')
			)));
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
	    if($this->Session->read('User.role') != '')$this->layout = 'default';
		else $this->layout = 'default2';
	}
	
	/* @ function for management page */
	public function management(){
	    if($this->Session->read('User.role') != '')$this->layout = 'default';
		else $this->layout = 'default2';
	}
	
	/* @ function for faq page */
	public function faq(){
	     if($this->Session->read('User.role') != '')$this->layout = 'default';
		else $this->layout = 'default2';
	}
	
	/* @ function for contact page */
	public function contact(){
	     if($this->Session->read('User.role') != '')$this->layout = 'default';
		else $this->layout = 'default2';
		 if($this->request->is('post') || $this->request->is('put')){
			  $name = $this->request->data['Contact']['name'];
			  $email_id = $this->request->data['Contact']['email_id'];
			  $company = $this->request->data['Contact']['company'];
			  $message = $this->request->data['Contact']['message'];
			 
			  $details = '<div style="float:left;background:#e7e7e7;min-height:200px;width:800px;font-family:Verdana, Geneva, sans-serif"><p>&nbsp;</p><div style="margin:0px 10px"><p>Details of New Enquiry recieved from Soceana</p><p>Name : '.$name.'</p><p>E-Mail: '.$email_id.'</p><p>Company: '.$company.'</p><p>Message : '.$message.'</p></div><p style="margin:15px 10px">&nbsp;</p><p>&nbsp;</p><div style="margin:0px 10px">Thanks,<br /><h2 style="margin:0px">Soceana</h2>Generating Social Good</div><p>&nbsp;</p></div>';
                
              $subject = 'Soceana - New Enquiry recieved from '.$name;
              
			  $to = 'inderjit.singh@venturepact.com';
			  				
              $this->_sendMail($email_id,$to,$subject,$details);
			  
			  $this->Session->setFlash('Your Enquiry has been successfully recieved.We will reach you shortly.');
			  
			  unset($this->request->data);
		 }
	}
	
	 /* @ function for sending Email */
    function _sendMail( $from , $to , $subject , $message ){
        App::uses('CakeEmail', 'Network/Email');        
        $email = new CakeEmail('gmail');
        $email->from($from);
        $email->to($to);
        $email->subject($subject);
        $email->emailFormat('both');
        $email->send($message);
    }
	
	/* @ function for aboutus page */
	public function about(){
	    if($this->Session->read('User.role') != '')$this->layout = 'default';
		else $this->layout = 'default2';
	}
	
	public function messages(){
		$this->layout = 'ajax';
		
		$this->loadModel('Message');		
		
		$records = $this->Message->query('SELECT Message.* , User.first_name, User.last_name,User.thumb_image,User.last_login FROM messages AS Message, users User WHERE Message.id IN ( SELECT max( id ) FROM messages WHERE message_to ='.$this->Session->read('User.id').' GROUP BY reference_id ) AND Message.message_from = User.id and Message.from_deleted = 0 order by Message.id desc');

		$this->set('messages',$records);		
	}
	
	public function messages_delete(){
		 $this->layout = 'ajax';
		$ids = $this->request->data['ids'];
		$this->loadModel('Message');
		foreach($ids as $id){
		   $data['Message']['from_deleted'] = 1;
		   $data['Message']['id']= $id;
		   $this->Message->save($data);
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
					'User'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'message_from','fields'=>array('first_name','last_name','thumb_image','last_login'))
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