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

	public $helpers = array('Sponsor');
	
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
	
	function _getHours($userType = 'user'){
		
		$this->LoadModel('LogHour');
		
		switch($userType){
			case 'user' :
			$data_array = $this->LogHour->find('all',array(
	      							        'conditions'=>array(
									    		    'user_id'=>$this->Session->read('User.id'),
											    'LogHour.status' => 1
											    ),
											    'fields'=>array('hours')
			));	
			break;
			case 'organizatons' :
			$data_array = $this->LogHour->find('all',array(
	      							        'conditions'=>array(
									    		  'organization'=>$this->Session->read('User.id'),
											  'LogHour.status' => 1
											  ),
											'fields'=>array('hours')
			));
			
			break;
			case 'companies':
			
			$this->LogHour->bindModel(
					array('belongsTo' => array(
							'User'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'user_id','fields'=>array('first_name','last_name','employer')),
						),
					),false
				);
			
			$data_array = $this->LogHour->find('all',array(
	      							        'conditions'=>array(
									    		    'User.employer'=>$this->Session->read('User.id'),
											    'LogHour.status' => 1
											    ),
											    'fields'=>array('hours')
			));	
			
			break;
			
		}
		
		if(count($data_array) == 0){
                    $hours = 0;
                }
                else{	
		
			$ct = 0;
			$hr_array = array();
			foreach($data_array as $arr){
			   $lg_hr = explode(':',$arr['LogHour']['hours']);
			   $hr_array[$ct] = (int)$lg_hr[0];
			   if(isset($lg_hr[1]))$min_array[$ct] = (int)$lg_hr[1];
			   $ct++;
			}
			$hrs = array_sum($hr_array);
			if(isset($min_array) && count($min_array)>0){
				$mins = array_sum($min_array);
				$mins_c = $mins / 60;
				$hrs = $hrs + $mins_c;
			}
                        $hours = $hrs;
			unset($hr_array);unset($min_array);
                }
		
		return $hours;
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
			
			$this->loadModel('LogHour');
			// check for current page with page limit that record exits to show page or not
			if(isset($this->params['named']['page']) && $this->params['named']['page'] >= 2){
			 //echo $this->params['named']['page'];
				
				$start_count =  $limit * ($this->params['named']['page'] - 1) + 1 ;
				
				$count = $this->LogHour->find('count',array('conditions'=>array('organization'=>$this->Session->read('User.id'))));			
				
				if($start_count > $count){
					
					$this->redirect('/');
				}
			 
			}
			
			$this->set('loghours',$this->_organizationGridData($limit));

			$this->set('total_hours' , $this->_getHours('organizatons'));
			
				
		}
		elseif($this->Session->read('User.role') == 'companies'){
			
			if(isset($this->params['named']['page']) && $this->params['named']['page'] >= 2){
				
				$this->loadModel('User');
				
				$start_count =  $limit * ($this->params['named']['page'] - 1) + 1 ;
			
				$this->User->unbindModel(
											array('hasAndBelongsToMany' => array(
																					'SkillSet','ServiceType'
																				),				
											));
											
				$count = $this->User->find('count',array( 'conditions' => array('employer'=>$this->Session->read('User.id'))));	
				
				if($start_count > $count){
					
					$this->redirect('/');
				}						
											
			}
			
			
			
			
			$this->set('loghours',$this->_companyGridData($limit));
			 
			$this->set('total_hours' , $this->_getHours('companies'));
		}
		else{
			// case  of volunteer 
			$this->loadModel('LogHour');
			// check for current page with page limit that record exits to show page or not
			if(isset($this->params['named']['page']) && $this->params['named']['page'] >= 2){
			 //echo $this->params['named']['page'];
				
				$start_count =  $limit * ($this->params['named']['page'] - 1) + 1 ;
				
			    $count = $this->LogHour->find('count',array('conditions'=>array('user_id'=>$this->Session->read('User.id'))));			
				
				if($start_count > $count){
					
					$this->redirect('/');
				}
			 
			}
			
			$this->set('loghours',$this->_volunteerGridData($limit));	
			
			$this->set('total_hours' , $this->_getHours('user'));
			
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
		
		$fields = array('LogHour.id','LogHour.hours','LogHour.job_date','LogHour.status','ServiceType.name','User.first_name','User.last_name','User.employer','User.employer_name');
		
		 $this->paginate = array(
				'limit'       => $limit,
				'order'       => 'LogHour.job_date DESC',
				'fields'      => $fields,
				'conditions'  => array( 'organization' => $this->Session->read('User.id'))
			);
		
		 $this->LogHour->bindModel(
			array('belongsTo' => array(
					/*'Category'    =>  array('className' => 'Category','joinTable' => 'categories','foreignKey' => 'category_id','fields'=>array('category_name')),*/
					'ServiceType' =>  array('className' => 'ServiceType','joinTable' => 'service_types','foreignKey' => 'service_type_id','fields'=>array('name')),
					'User'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'user_id','fields'=>array('first_name','last_name')),
				
				)
			),false
		);
		
		$loghours = $this->paginate('LogHour');
		
		$this->loadModel('User');
		
		
		$i = 0;
		foreach($loghours as $lg_hour){
			
			if($lg_hour['User']['employer']!= 0){
			
				$this->User->unbindModel(
									array('hasAndBelongsToMany' => array(
																			'SkillSet','ServiceType'
																		),				
			   ));
				
				$user = $this->User->find('first',array( 'fields' => array('organization_name'),
													'conditions' => array('id' => $lg_hour['User']['employer']), 					
												));				
												
				$loghours[$i]['emp_name'] = $user['User']['organization_name'];							
												
			}
			else $loghours[$i]['emp_name'] = $lg_hour['User']['employer_name'];		
			
		$i++;
		}
		 
		return $loghours;
	}
	
	/* @ function to show the Organization Grid Data */	
	public function _companyGridData($limit = 5){
	
		$this->loadModel('User');
		$this->loadModel('LogHour');
		
		$this->User->unbindModel(
		 					    array('hasAndBelongsToMany' => array(
																		'SkillSet','ServiceType'
																	),				
								));
		
		
		$fields = array('first_name','last_name','id');
		
		$this->paginate = array(
				'limit'       => $limit,
				'order'       => 'first_name',
				'fields'      => $fields,
				'conditions'  => array( 'employer' => $this->Session->read('User.id'))
			);
		
		
		
		$this->LogHour->bindModel(
			array('belongsTo' => array(				
					'User'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'user_id','fields'=>array('first_name','last_name','employer')),				
				),
			),false
		);
	
		$users = $this->paginate('User');
		$i = 0 ;
		foreach($users as $user){
			
			$this->LogHour->unbindModel(
		 					    array('belongsTo' => array(
																		'User'
																	),				
								));
								
			$this->LogHour->bindModel(
					array('belongsTo' => array(
							'Category'    =>  array('className' => 'Category','joinTable' => 'categories','foreignKey' => 'category_id','fields'=>array('category_name')),
							'ServiceType' =>  array('className' => 'ServiceType','joinTable' => 'service_types','foreignKey' => 'service_type_id','fields'=>array('name')),
							'User' =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'organization','fields'=>array(' 	organization_name'))
						)
					),false
				);
			$log_hours = $this->LogHour->find('all',array(
															'fields' => array('LogHour.hours','LogHour.job_date','Category.category_name','ServiceType.name','User.organization_name'),
															'conditions' => array('user_id'=>$user['User']['id'],'LogHour.status'=>1),
															'order' => array('job_date desc')
												          )
											  );			
			$users[$i]['lg_hour'] = $log_hours;
			
			if(count($log_hours) == 0){
					    $hours = 0;
					}
					else{	
					
						$ct = 0;
						$hr_array = array();
						foreach($log_hours as $arr){
						   $lg_hr = explode(':',$arr['LogHour']['hours']);
						   $hr_array[$ct] = (int)$lg_hr[0];
						   if(isset($lg_hr[1]))$min_array[$ct] = (int)$lg_hr[1];
						   $ct++;
						}
						$hrs = array_sum($hr_array);
						if(isset($min_array) && count($min_array)>0){
							$mins = array_sum($min_array);							
							$mins_c = floor($mins / 60);
							$mins_m = $mins % 60 ;			
							$hrs = ( $hrs + $mins_c ).':'.$mins_m;	
						}
						$hours = $hrs;
						unset($hr_array);unset($min_array);
					}
					$users[$i]['total_hrs'] = $hours;
					$i++;
		}
		
		return $users;
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
			 
			  $details = '<div style="float:left;background:#e7e7e7;min-height:200px;width:800px;font-family:Verdana, Geneva, sans-serif"><p>&nbsp;</p><div style="margin:0px 10px"><p>Details of New Enquiry received from Soceana</p><p>Name : '.$name.'</p><p>E-Mail: '.$email_id.'</p><p>Company: '.$company.'</p><p>Message : '.$message.'</p></div><p style="margin:15px 10px">&nbsp;</p><p>&nbsp;</p><div style="margin:0px 10px">Thanks,<br /><h2 style="margin:0px">Soceana</h2>Generating Social Good</div><p>&nbsp;</p></div>';
                
              $subject = 'Soceana - New Enquiry received from '.$name;
              
			  $to = 'inderjit.singh@venturepact.com';
			  				
              $this->_sendMail($email_id,$to,$subject,$details);
			  
			  $this->Session->setFlash('Your Enquiry has been successfully received.We will reach you shortly.');
			  
			  $this->redirect(array('controller'=>'pages','action'=>'display'));
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
		
		$records = $this->Message->query('SELECT Message.* , User.first_name, User.last_name,User.thumb_image,User.last_login FROM messages AS Message, users as User WHERE Message.id IN ( SELECT max( id ) FROM messages WHERE message_to ='.$this->Session->read('User.id').' GROUP BY reference_id ) AND Message.message_from = User.id and Message.from_deleted = 0 order by Message.id desc');
		
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
							      'fields'=>array('reference_id','message_from','viewed_status')
							      ));

		// check if message is not already read then make the status of message as read
		if($message['Message']['viewed_status'] == 0){
			$data = array();
			$data['Message']['id'] = $this->request->data['id'];
			$data['Message']['viewed_status'] = 1;
			$this->Message->save($data);
		}
		
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
	
	public function gallery(){
				
		$limit = 9;		
		
		switch($this->Session->read('User.role')){
			
			case 'user' :
			
				$fields = array('LogHourImage.*');
				
				$this->loadModel('LogHourImage');
				
				$this->paginate = array(
					'limit'       => $limit,
					'order'       => 'LogHourImage.id DESC',
					'fields'	  => $fields,					
					'conditions'  => array( 'LogHour.user_id' => $this->Session->read('User.id'),'LogHour.status' => 1)
				);
				
				$this->LogHourImage->bindModel(
					array('belongsTo' => array(
							'LogHour'    =>  array('className' => 'LogHour','joinTable' => 'log_hours','foreignKey' => 'log_hour_id'),							
						)
					),false
				);
				
				if(isset($this->params['named']['page']) && $this->params['named']['page'] >= 2){
			    //echo $this->params['named']['page'];
				
					$start_count =  $limit * ($this->params['named']['page'] - 1) + 1 ;
					
					$count = $this->LogHourImage->find('count',array('conditions'=>array( 'LogHour.user_id' => $this->Session->read('User.id'),'LogHour.status' => 1)));			
					
					if($start_count > $count){
						
						$this->redirect('/pages/gallery');
					}
			 
				}
				
				$pictures = $this->paginate('LogHourImage');	
						
			break;
			
			case 'organizations' :
			
			   $this->loadModel('UserPic');				
		
			   $this->paginate = array(
					'limit'       => $limit,
					'order'       => 'UserPic.id DESC',					
					'conditions'  => array( 'user_id' => $this->Session->read('User.id'))
				);
				
				if(isset($this->params['named']['page']) && $this->params['named']['page'] >= 2){
			    //echo $this->params['named']['page'];
				
					$start_count =  $limit * ($this->params['named']['page'] - 1) + 1 ;
					
					$count = $this->UserPic->find('count',array('conditions'=> array( 'user_id' => $this->Session->read('User.id'))));			
					
					if($start_count > $count){
						
						$this->redirect('/pages/gallery');
					}
			 
				}
				
				$pictures = $this->paginate('UserPic');	
			
				
			break;
			
			case 'companies':
				 $this->loadModel('UserPic');				
		
			   $this->paginate = array(
					'limit'       => $limit,
					'order'       => 'UserPic.id DESC',					
					'conditions'  => array( 'user_id' => $this->Session->read('User.id'))
				);
				
				if(isset($this->params['named']['page']) && $this->params['named']['page'] >= 2){
			    //echo $this->params['named']['page'];
				
					$start_count =  $limit * ($this->params['named']['page'] - 1) + 1 ;
					
					$count = $this->UserPic->find('count',array('conditions'=> array( 'user_id' => $this->Session->read('User.id'))));			
					
					if($start_count > $count){
						
						$this->redirect('/pages/gallery');
					}
			 
				}
				
				$pictures = $this->paginate('UserPic');	
				
			break;
			
		}	
		$this->set('pictures',$pictures);
	}
}