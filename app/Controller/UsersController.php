<?php
/*
* @ Soceana Project 
* @ Users Controller class
* @ Created on : 19th July 2013
* @ Created by : Inderjit Singh
*/
class UsersController extends AppController{ 
    
    var $name = 'Users';
    
    var $helpers = array('Cropimage','Sponsor');
    
    var $components = array('JqImgcrop');  
    
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('add','forgot_password','reset_password');
    }
    
    /* @ function for login of Volunteer / Organization */
    public function login(){        
        $this->layout = 'login';
        $this->set('title_for_layout','Soceana - User Login');
        if($this->request->is('post')){           
            if($this->Auth->login()){
				if($this->request->data['User']['role'] == 'organizations|companies'){					
					if($this->Auth->user('role')=='user'){					
						unset($this->request->data);                   
						$this->Auth->logout();
						$this->Session->setFlash(__('You are not allowed to access system as Organization / Company'));
					}
					else{
						if ($this->request->data['User']['rememberMe'] == 1) {
						// After what time frame should the cookie expire
						$cookieTime = "14 days"; 
	 
						// remove "remember me checkbox"
						unset($this->request->data['User']['rememberMe']);
					 
						// hash the user's password
						$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
					 
						// write the cookie
						$this->Cookie->write('rememberMe', $this->request->data['User'], true, $cookieTime);
						}
					   
						$this->Session->write('User',$this->Auth->user());  
						$data['User']['id'] = $this->Session->read('User.id');
						$data['User']['last_login'] = date('Y-m-d H:i:s') ;
						$this->User->save($data); 
							
						$this->redirect(array('controller'=>'pages','action'=>'display'));
						//$this->redirect('/');
					}
				}
				else{
					if($this->Auth->user('role') !='user' ){					
						unset($this->request->data);                   
						$this->Auth->logout();
						$this->Session->setFlash(__('You are not allowed to access system as a Volunteer'));
					}
					else{
						if ($this->request->data['User']['rememberMe'] == 1) {
						// After what time frame should the cookie expire
						$cookieTime = "14 days"; 
	 
						// remove "remember me checkbox"
						unset($this->request->data['User']['rememberMe']);
					 
						// hash the user's password
						$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
					 
						// write the cookie
						$this->Cookie->write('rememberMe', $this->request->data['User'], true, $cookieTime);
						}
					   
						$this->Session->write('User',$this->Auth->user());  
						$data['User']['id'] = $this->Session->read('User.id');
						$data['User']['last_login'] = date('Y-m-d H:i:s') ;
						$this->User->save($data); 
							
						$this->redirect(array('controller'=>'pages','action'=>'display'));
						//$this->redirect('/');
					}					
				}
			}
            else{
                unset($this->request->data);
                $this->Session->setFlash(__('Invalid username or password, Try again'));
            }
        }        
    }  
	    
    /* @ function for logout */
    public function logout(){
        $this->Session->delete('User');
        $this->Session->delete('page_limit');
        $this->Cookie->delete('rememberMe');
        $this->Auth->logout();
        $this->redirect(array('controller'=>'users','action'=>'login'));
    }   
    
    /* @ function for user registration i.e adding user to our database */
    public function add($type = 'user'){
        $this->layout = 'default2';
        $this->loadModel('ServiceType');
        if($this->request->is('post')){
            
            //pr($this->request->data);die;
            /* @ check for the email id (login id) if already exists with the same id then
             * @ prompt the user with error message and give the message that user is already in database
             */
            $conditions = array( 'email_id' => $this->data['User']['email_id'] );
            
            $no_of_records = $this->User->find('count',array('conditions'=>$conditions));
          
            if($no_of_records > 0)
            {
                $this->Session->setFlash(__('Your email id already exits in database.'));
               // $this->redirect(array('action'=>'add',$this->request->data['User']['role'])); 
            }
            else{
                $password = $this->request->data['User']['password'];
                $this->User->create();
                if($this->User->save($this->request->data)){
                    
                    // Sending email for registration with us.                    
                    
                    $message = '<div style="float:left;background:#e7e7e7;min-height:200px;width:800px;font-family:Verdana, Geneva, sans-serif"><p>&nbsp;</p><div style="margin:0px 10px">Hello, <strong style="font-size:15px">'.$this->request->data['User']['first_name'].' '.$this->request->data['User']['last_name'].'</strong></div><p style="margin:15px 10px">Thanks for registering with us.Now you can use our services after logging in.Your login credentials are :</p><p style="margin:15px 10px">Login id : '.$this->request->data['User']['email_id'].'</p><p style="margin:15px 10px">Password : '.$password.'</p><p>&nbsp;</p><div style="margin:0px 10px">Thanks,<br /><h2 style="margin:0px">Soceana</h2>Generating Social Good</div><p>&nbsp;</p></div>';
                
                    $subject = 'Soceana - Thanks for registration';
                
                    $this->_sendMail('yourfriends.soceana@venturepact.com',$this->request->data['User']['email_id'],$subject,$message);
					if($this->Auth->login()){
						 $this->Session->write('User',$this->Auth->user()); 
						 $this->redirect(array('controller'=>'pages','action'=>'display'));
					}
                    /* Older functionality commented
                    $this->Session->setFlash(__('User details has been saved successfully'));
                    
					$this->redirect(array('action'=>'login'));*/
                }
                else{
                    $this->Session->setFlash(__('User details could not be saved. Please try again.'));    
                }
            }
        }
        $this->set('service_types',$this->ServiceType->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));
        //$this->set('service_type',$this->ServiceType->find('list',array('order'=>'id')));
        $this->set('type',$type);
    }
    
    /* @ function for update profile of a Volunteer */
    public function user_profile(){
        $this->loadModel('ServiceType');
		$this->loadModel('State');
        $this->User->id = $this->Session->read('User.id');
        if(!$this->User->exists()){
            throw new NotFoundException(__('Invalid User'));       
        }
        if($this->request->is('post') || $this->request->is('put')){
             // for conversion of normal date to mysql date          
             $this->request->data['User']['birth_date'] = date('Y-m-d',strtotime(str_replace('-', '/', $this->request->data['User']['birth_date'])));
			
            if($this->User->save($this->request->data)){
				 /*
				* @  checking the new values and setting in the session
				*/
				$this->Session->write('User.first_name',$this->request->data['User']['first_name']);
				$this->Session->write('User.last_name',$this->request->data['User']['last_name']);
                $this->Session->setFlash(__('User details has been updated successfully'));
                $this->redirect('/');
            }
            else{
                $this->Session->setFlash(__('User details could not be saved. Please try again'));
            }
        }
        else{
            $this->request->data = $this->User->read(null,$this->User->id);
			
            // code for new array of volunteer type selection from database
            $i = 0;
            $temp = array();
            if(count($this->request->data['ServiceType'])>0)
            {
                foreach($this->request->data['ServiceType'] as $sel_options){
                    $temp[$i] = $sel_options['id'] ;
                    $i++;
                }               
            }
            else
            {
                $temp[$i] = 0;
            }
            if($this->request->data['User']['birth_date'] == '0000-00-00'){
				$this->request->data['User']['birth_date'] = '';
				$this->request->data['User']['employer'] = '';
			}
			else{
				$this->request->data['User']['birth_date'] = date("m-d-Y", strtotime($this->request->data['User']['birth_date']));			
			}
			
            $this->set('temp_types',$temp);
            $this->set('service_types',$this->ServiceType->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));
            unset($this->request->data['User']['Password']);
			
			
			$companies = $this->User->find('list',array('fields'=>array('id','organization_name'),'conditions'=>array('role'=>'companies')));
			$companies[0] = 'Others';

			$this->set('companies',$companies);
			
			$this->set('states',$this->State->find('list',array('order'=>'id','fields'=>array('id','state_name'))));
			
			if($this->request->data['User']['state']!='' || $this->request->data['User']['state']!= 0 )
			{
				$this->loadModel('City');
				
				$this->set('cities',$this->City->find('list',array('order'      => 'city_name',
											    				   'fields'     => array('id','city_name'),
									                               'conditions' => array('state_id' => $this->request->data['User']['state']),						     
									   )
				));
			}
			else{
				$this->set('cities',array());
			}		
        }
    }
    
    /* @ function for update profile of an Organization */
    public function organization_profile(){
        $this->loadModel('ServiceType');
	    $this->loadModel('SkillSet');
		$this->loadModel('UserPic');
		$this->loadModel('State');
        $this->User->id = $this->Session->read('User.id');
        
        if(!$this->User->exists()){
            throw new NotFoundException(__('Invalid User'));       
        }
        if($this->request->is('post') || $this->request->is('put')){          
          
            if($this->User->save($this->request->data)){
                /*for saving star rating according to Skill Set*/
                if(count($this->request->data['SkillSet']['SkillSet']) > 0)
                {
                    foreach($this->request->data['SkillSet']['SkillSet'] as $skilset){
                        $rate = $this->request->data['skilset'.$skilset];
                        $this->User->query("update user_skill_sets set rate ='$rate' where user_id='".$this->Session->read('User.id')."' and skill_set_id='".$skilset."'");
                    }
                }
				
				
               // $id = $this->UserPic->id;
				if(isset($this->request->data['UserPic']['id'])){
                foreach($this->request->data['UserPic']['id'] as $image_id){
                    $data['UserPic']['id'] = $image_id;
                    $data['UserPic']['user_id'] = $this->Session->read('User.id');
                    $data['UserPic']['temp_session'] = '';
                    $this->UserPic->save($data);
                	}
				}
				
				
                /*
				* @  checking the new values and setting in the session
				*/
				$this->Session->write('User.first_name',$this->request->data['User']['first_name']);
				$this->Session->write('User.last_name',$this->request->data['User']['last_name']);
				$this->Session->write('User.organization_name',$this->request->data['User']['organization_name']);				
				
                $this->Session->setFlash(__('Your details has been updated successfully'));
                $this->redirect('/');
            }
            else{
                $this->Session->setFlash(__('Your details could not be saved. Please try again'));
            }
        }
        else{
            $this->request->data = $this->User->read(null,$this->User->id);
            
            // code for new array of volunteer type selection from database
            $i = 0;
            $temp = array();
            if(count($this->request->data['ServiceType'])>0)
            {
                foreach($this->request->data['ServiceType'] as $sel_options){
                    $temp[$i] = $sel_options['id'] ;
                    $i++;
                }               
            }
            else
            {
                $temp[$i] = 0;
            }           
            
            // code for new array of service type selection from database
            $i = 0;
            $temp2 = array();
            if(count($this->request->data['SkillSet'])>0)
            {
                foreach($this->request->data['SkillSet'] as $skl_options){
                    $temp2[$i] = $skl_options['id'];
                    $this->request->data['skilset'.$skl_options['UserSkillSet']['skill_set_id']] = $skl_options['UserSkillSet']['rate'];
                    $i++;
                }               
            }
            else
            {
                $temp2[$i] = 0;
            }     
			
			//getting temporary images and removing temp images and their database record
						$temp_images = $this->UserPic->find('all',array(
														'conditions' => array('temp_session'=> $this->Session->read('User.id')),
														'fields'=> array('id','picture_url')
													 ));
			if(sizeof($temp_images) > 0){
				foreach($temp_images as $log_image){				
					$this->_remove_images($log_image['UserPic']['picture_url']);
					$this->UserPic->delete($log_image['UserPic']['id']);
				}
			}
			// end of deletion of temporary images
			     
            $this->set('temp_types',$temp);
            $this->set('temp_skills',$temp2);
            $this->set('service_types',$this->ServiceType->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));
	    $this->set('skill_sets',$this->SkillSet->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));
            unset($this->request->data['User']['Password']);
			
			$this->set('states',$this->State->find('list',array('order'=>'id','fields'=>array('id','state_name'))));
			
			if($this->request->data['User']['state']!='' || $this->request->data['User']['state']!= 0 )
			{
				$this->loadModel('City');
				
				$this->set('cities',$this->City->find('list',array('order'      => 'city_name',
											    				   'fields'     => array('id','city_name'),
									                               'conditions' => array('state_id' => $this->request->data['User']['state']),						     
									   )
				));
			}
			else{
				$this->set('cities',array());
			}
        }
    }
	
	  /* @ function for update profile of company */
    public function company_profile(){
        $this->loadModel('ServiceType');	
		$this->loadModel('UserPic');
		$this->loadModel('State');
        $this->User->id = $this->Session->read('User.id');
        
        if(!$this->User->exists()){
            throw new NotFoundException(__('Invalid User'));       
        }
        if($this->request->is('post') || $this->request->is('put')){          
          
            if($this->User->save($this->request->data)){ 
			
				if(isset($this->request->data['UserPic']['id'])){
                foreach($this->request->data['UserPic']['id'] as $image_id){
                    $data['UserPic']['id'] = $image_id;
                    $data['UserPic']['user_id'] = $this->Session->read('User.id');
                    $data['UserPic']['temp_session'] = '';
                    $this->UserPic->save($data);
                	}
				}
			              
				$this->Session->write('User.first_name',$this->request->data['User']['first_name']);
				$this->Session->write('User.last_name',$this->request->data['User']['last_name']);
				$this->Session->write('User.organization_name',$this->request->data['User']['organization_name']);			
                $this->Session->setFlash(__('Your details has been updated successfully'));
                $this->redirect('/');
            }
            else{
                $this->Session->setFlash(__('Your details could not be saved. Please try again'));
            }
        }
        else{
            $this->request->data = $this->User->read(null,$this->User->id);
            
            // code for new array of volunteer type selection from database
            $i = 0;
            $temp = array();
            if(count($this->request->data['ServiceType'])>0)
            {
                foreach($this->request->data['ServiceType'] as $sel_options){
                    $temp[$i] = $sel_options['id'] ;
                    $i++;
                }               
            }
            else
            {
                $temp[$i] = 0;
            }           
         
		    //getting temporary images and removing temp images and their database record
			$temp_images = $this->UserPic->find('all',array(
														'conditions' => array(
																			  'temp_session'=> $this->Session->read('User.id')
																			  ),
														'fields'=> array('id','picture_url')
													      )
												);
			if(sizeof($temp_images) > 0){
				foreach($temp_images as $log_image){				
					$this->_remove_images($log_image['UserPic']['picture_url']);
					$this->UserPic->delete($log_image['UserPic']['id']);
				}
			}
			// end of deletion of temporary images
		 	
			
            $this->set('temp_types',$temp);            
            $this->set('service_types',$this->ServiceType->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));	    
        }
		
			$this->set('states',$this->State->find('list',array('order'=>'id','fields'=>array('id','state_name'))));
			
			if($this->request->data['User']['state']!='' || $this->request->data['User']['state']!= 0 )
			{
				$this->loadModel('City');
				
				$this->set('cities',$this->City->find('list',array('order'      => 'city_name',
											    				   'fields'     => array('id','city_name'),
									                               'conditions' => array('state_id' => $this->request->data['User']['state']),						     
									   )
				));
			}
			else{
				$this->set('cities',array());
			}
    }
    
    /* @ function for change password  of Volunteer / Organization */
    public function change_password(){
        if($this->request->is('post') || $this->request->is('put')){
            $count = $this->User->find('count', array( 'conditions' => array('id' => $this->Session->read('User.id'),'password' => AuthComponent::password($this->request->data['User']['old_password']))));
            if($count > 0){
                $this->User->id = $this->Session->read('User.id');
                $this->User->save($this->request->data);
                $this->Session->setFlash(__('Your password changed successfully'));
                unset($this->request->data);  
            }else{
                $this->Session->setFlash(__('Your current password is not correct'));
                unset($this->request->data);  
            }            
        }        
    }
    
    /* @ function for updating user picture */
    public function user_pic(){       
        
    }
    
    /* @ function for updating user picture */
    public function user_pic2(){        
        if($this->request->is('post') || $this->request->is('put')){			
			if($this->request->data['User']['image']['name']!=''){
            $imageName = 'img_'.$this->Session->read('User.id');
            $uploaded = $this->JqImgcrop->uploadImage($this->request->data['User']['image'], '/img/upload/', $imageName);            
            $this->set('uploaded',$uploaded); 
			//echo 'test';
			}
			else{
				$this->Session->setFlash('Please select an image to upload');	
				$this->redirect('/users/user_pic');
			}
        }
    }
    
    /* @ function for updating user picture */
    public function user_pic3(){       
        $data = $this->JqImgcrop->cropImage(170, $this->request->data['User']['x1'], $this->request->data['User']['y1'], $this->request->data['User']['x2'], $this->request->data['User']['y2'], $this->request->data['User']['w'], $this->request->data['User']['h'], $this->request->data['User']['imagePath'], $this->request->data['User']['imagePath']);
        $this->User->id = $this->Session->read('User.id');		
        if($this->User->save($data)){
			/*
			* @  checking the new values and setting in the session
			*/	
			$this->Session->write('User.image',$data['User']['image']);
			$this->Session->write('User.thumb_image',$data['User']['thumb_image']);
		}
        $this->Session->setFlash(__('Your profile picture saved successfully'));
        if($this->Session->read('User.role') == 'organizations'){
            $this->redirect(array('action'=>'organization_profile'));
        }
		elseif($this->Session->read('User.role') == 'companies'){
            $this->redirect(array('action'=>'company_profile'));
        }
        else{
             $this->redirect(array('action'=>'user_profile')); 
        }        
    }
    
    /* @ function for reposition of picture */
    public function reposition_pic(){        
          
        $user = $this->User->read(null,$this->Session->read('User.id'));        
        $uploaded['imagePath'] = '/img/upload/'.$user['User']['image'];
        $uploaded['imageName'] = $user['User']['image'];
        $upload_path = WWW_ROOT.str_replace("/", DS, 'img/upload/').$user['User']['image'];
        $height = $this->JqImgcrop->getHeight($upload_path);
        $width = $this->JqImgcrop->getWidth($upload_path);
        $uploaded['imageWidth'] = $width;
        $uploaded['imageHeight'] = $height;           
        $this->set('uploaded',$uploaded);         
    }
    
    /* @ function for request of forgot password */
    public function forgot_password($email_id = null){
       
       $this->layout = 'ajax';
       if($email_id == null){
            echo '<div id="fp_message">Please fill your email id</div>';
       }
       else{
            $this->User->recursive = 0;
            
            $user = $this->User->find('first',array('fields'=>array('User.id','first_name','last_name'),'conditions'=>array('User.email_id'=>$email_id)));
            
            if(isset($user['User'])){
                $this->loadModel('FpRequest');              
                $data['FpRequest']['user_id'] = $user['User']['id'];
                $this->FpRequest->save($data);             
                $fpid = $this->FpRequest->id;
                $fpid = urlencode(base64_encode($fpid));
                
                $mail_url = 'http://'.$_SERVER['SERVER_NAME'].$this->webroot.'users/reset_password/'.$fpid;                
                
                $message = '<div style="float:left;background:#e7e7e7;min-height:200px;width:800px;font-family:Verdana, Geneva, sans-serif"><p>&nbsp;</p><div style="margin:0px 10px">Hello, <strong style="font-size:15px">'.$user['User']['first_name'].' '.$user['User']['last_name'].'</strong></div><p style="margin:15px 10px">You have requested for new password , Please click on following link to reset your password.</p><p style="margin:15px 10px"><a href="'.$mail_url.'">Click Here</a></p><p>&nbsp;</p><div style="margin:0px 10px">Thanks,<br /><h2 style="margin:0px">Soceana</h2>Generating Social Good</div><p>&nbsp;</p></div>';
                
                $subject = 'Soceana - Request for Password Reset';
                
                $this->_sendMail('yourfriends.soceana@venturepact.com',$email_id,$subject,$message);
                
                echo '<div id="fp_message">Please check your email for resetting of password</div>';                
            }
            else echo '<div id="fp_message">Email id doesn\'t exists in our database</div>';
       }
       $this->autoRender = false;
    }
    
    /* @ function for reseting the password */
    public function reset_password($id = null){
        $this->layout = 'default2';
        if($id == null){
            $this->Session->setFlash('You are not authorized to reset the password');
        }
        else{
            $id  = urldecode(base64_decode($id));
            $this->loadModel('FpRequest');
            $fp_data = $this->FpRequest->find('first',array('conditions'=>array('id'=>$id),'order'=>'id desc'));

            switch(count($fp_data['FpRequest']['id'])){
                case  0:
                    $this->Session->setFlash('You reset password link is not a valid link');
                    $this->redirect('/');
                break;
                case 1:                    
                    if($fp_data['FpRequest']['status']== 1){
                        $this->Session->setFlash('You have already reset your password');
                        $this->redirect('/');
                    }
                    else{                        
                        if($this->request->is('post') || $this->request->is('put')){                           
                                $this->User->id = $fp_data['FpRequest']['user_id'];
                                $this->User->save($this->request->data);
                                $fpData['FpRequest']['id'] = $id;                                
                                $fpData['FpRequest']['status'] = 1;
                                $this->FpRequest->save($fpData);                                
                                unset($this->request->data);
                                $this->Session->setFlash(__('Your password has been reseted successfully'));
                                $this->redirect('/');                                
                        }
                    }
                break;
            }
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
    
    function getusers(){
        $this->layout = 'ajax';
        $q = strtolower($_GET["q"]);
        if (!$q) return;
        $users = $this->User->find('all');
        //$this->Session->read('User.id')
        foreach($users as $user){
                $items[$user['User']['first_name'].' '.$user['User']['last_name']] = $user['User']['id'] ; 	
        }
      
        foreach ($items as $key=>$value) {
            if (strpos(strtolower($key), $q) !== false) {
                    echo "$key|$value\n";
            }
        }
        $this->autoRender = false;
    }
    
    function getuser_image(){
        $this->layout = 'ajax';
        $id = $this->request->data['user_id'] ;
        
        $user_image = $this->User->find('first',array('fields'=>array('thumb_image'),'conditions'=>array('id'=>$id)));
        
        if(strlen($user_image['User']['thumb_image'])>0){
            $image = $this->webroot.'img/upload/'.$user_image['User']['thumb_image'];
        }else{
            $image = $this->webroot.'img/no_image.png';
        }
        echo $image;
        $this->autoRender = false;
    }
    
	/* @ function for personalize search results */
    function getdetails(){
        $this->layout = 'ajax';
        $id = $this->request->data['user_id'] ;
        $this->User->recursive = -1;
        $user_data = $this->User->find('first',array('fields'=>array('first_name','last_name','thumb_image'),'conditions'=>array('id'=>$id)));
        
        $temp['name'] = ucfirst($user_data['User']['first_name']).' '.ucfirst($user_data['User']['last_name']);
        
        if(strlen($user_data['User']['thumb_image'])>0){
            $image = $this->webroot.'img/upload/'.$user_data['User']['thumb_image'];
        }else{
            $image = $this->webroot.'img/no_image.png';
        }
        $temp['image'] = $image;
        
        echo json_encode($temp);
        
        $this->autoRender = false;
    }
    
	/* @ function for personalize search page */
    public function personalize(){
		
        $this->loadModel('SkillSet');
		
		$this->loadModel('State');
		
         if($this->request->is('post') || $this->request->is('put')){
			
           $skillset = implode('-',$this->request->data['SkillSet']['SkillSet']);
		   
		   // for country id
		   if($this->request->data['User']['country']){
			   
			   $country = $this->request->data['User']['country'];
			   
		   } else $country = 0;
		   
		   // for state id
		   if($this->request->data['User']['state']){
			   
			   $state = $this->request->data['User']['state'];
			   
		   } else $state = 0;
		   
		    // for city id
		   if($this->request->data['User']['city']){
			   
			   $city = $this->request->data['User']['city'];
			   
		   } else $city = 0;		   
		  
           $this->redirect(array('action'=>'personalize_results',$skillset,$country,$state,$city));
         }        
        $this->set('skill_sets',$this->SkillSet->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));
		$this->set('states',$this->State->find('list',array('order'=>'id','fields'=>array('id','state_name'))));
    }
	
	/* @ function for personalize search results page */
    public function personalize_results($skillset,$country = 0, $state = 0 , $city = 0){
        
        $this->loadModel('SkillSet');
		
        $this->loadModel('State');
		
        $skillset = explode('-',$skillset);
        
        $limit = 6;
        
        $i = 0;
		
		// checking state id and binding with dropwdown selections if found other than Select State
		if($state != 0){
			$this->request->data['User']['state'] = $state;
			
			$this->loadModel('City');
				
			$this->set('cities',$this->City->find('list',array('order'      => 'city_name',
											    			   'fields'     => array('id','city_name'),
									                           'conditions' => array('state_id' => $state),						     
									   )
				));
		} else {
			$this->set('cities',array());		
			
		}
        
		// checking city id and binding with dropwdown selections if found other than Select City
		if($city != 0){			
			$this->request->data['User']['city'] = $city;									
		} 
		
        foreach($skillset as $sk_set){
            $or[$i] = array('UserSkillSet.skill_set_id' => $sk_set);
            $i++;
        }
      
        
        $this->User->unBindModel(array('hasAndBelongsToMany' => array('ServiceType')));
        
        $this->User->bindModel(
                               array(
                                     'hasOne' => array('UserSkillSet'),                                    
                                     ),false
                               );

        $this->paginate = array(
            'limit' => $limit,           
            'conditions' => array(
                'Or'=>$or,
                'User.role'=>'organizations',
				'User.state'=> $state,
				'User.city'=> $city
            ),            
            'contain' => 'UserSkillSet',
            'group'=>'User.id',
            'order'=>'SUM( UserSkillSet.rate ) DESC',
        );       
       
        $this->set('skillset',$skillset);
        $this->set('skillset_results',$this->paginate());
        $this->set('skill_sets',$this->SkillSet->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));
		$this->set('states',$this->State->find('list',array('order'=>'id','fields'=>array('id','state_name'))));
		
    }	
	/* @ function for gallery images */
	public function gallery_images(){
	$this->layout = '';
	$images = $this->User->query('SELECT images.picture_url,caption FROM log_hour_images AS images, log_hours AS lh WHERE lh.id = images.log_hour_id AND lh.user_id = '. $this->Session->read('User.id').' AND lh.status = 1 ORDER BY rand() LIMIT 5 ');
	return $images;
	$this->autoRender = false;
	}
	
	/* @ function for gallery images */
	public function gallery_images2(){
	$this->layout = '';
	$this->loadModel('UserPic');
	$images = $this->UserPic->find('all',array(
												'conditions' => array( 'user_id' => $this->Session->read('User.id')),
												'order'=> 'rand()',
												'limit'=> 4
												));
	return $images;
	$this->autoRender = false;
	}
	
	public function update_status(){
		$this->layout='';
		$data['User']['id'] = $this->Session->read('User.id'); 
		$data['User']['status_message'] = $this->request->data['status'];
		$this->Session->write('User.status_message',$this->request->data['status']);
		$this->User->save($data);
		$this->Session->setFlash(__('Your status has been changed successfully'));
		echo '1';  
		$this->autoRender = false;
    } 
	
	public function add_images(){
		$this->layout = '';
        $upload_dir = WWW_ROOT.str_replace("/", DS, '/img/user_pics/');
        $upload_path = $upload_dir.DS;
        $i = 0;
        $temp = array();       
        $this->loadModel('UserPic');
        $data = array();
        foreach ($_FILES["images"]["error"] as $key => $error) {
            if ($error == 0) {
                $name = $_FILES["images"]["name"][$key];
                $file_ext = substr($name, strrpos($name, ".") + 1);
                $new_name = time()."_".$this->Session->read('User.id')."_$key.".$file_ext;
                if( move_uploaded_file( $_FILES["images"]["tmp_name"][$key], $upload_path.$new_name ) ){
					chmod ($upload_path.$new_name , 0777);
                    if(isset($_REQUEST['caption_'.$key]))
                    $caption = $_REQUEST['caption_'.$key];
                    else $caption = '';
                       
                        $data['UserPic']['picture_url'] =  $new_name;
                        $data['UserPic']['temp_session'] =  $this->Session->read('User.id');
                        $data['UserPic']['caption'] =  $caption;
                        if($this->UserPic->save($data)){
                        $id = $this->UserPic->id;
                        unset($this->UserPic->id);
                        $temp[$i]['id'] = $id;
                        $temp[$i]['image'] = $new_name;                       
                        $i++;
                        }
                }
            }
        }
        echo json_encode($temp);
        $this->autoRender = false;
	}
	
	public function _remove_images($image_name){
		$upload_dir = WWW_ROOT.str_replace("/", DS, '/img/user_pics/');
        $upload_path = $upload_dir.DS.$image_name;
		unlink($upload_path);
		return true;	
	}
	
}
?>