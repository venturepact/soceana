<?php
/*
* @ Soceana Project 
* @ Users Controller class
* @ Created on : 19th July 2013
* @ Created by : Inderjit Singh
*/
class UsersController extends AppController{ 
    

    var $helpers = array('Cropimage');
    
    var $components = array('JqImgcrop');
    
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('add','forgot_password','reset_password');
    }
    
    public function login(){
        $this->layout = 'login';
        if($this->request->is('post')){            
            if($this->Auth->login()){
                $this->Session->write('User',$this->Auth->user());                
                $this->redirect(array('controller'=>'pages','action'=>'display'));
            }
            else{
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }        
    }
    
    public function logout(){
        $this->Session->delete('User');
        $this->Session->delete('page_limit');
        $this->Auth->logout();
        $this->redirect(array('controller'=>'users','action'=>'login'));
    }   
    
    public function add($type = 'user'){        
        $this->loadModel('ServiceType');
        if($this->request->is('post')){
            
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
                $this->User->create();
                if($this->User->save($this->request->data)){
                    $this->Session->setFlash(__('User details has been saved successfully'));
                    $this->redirect(array('action'=>'login'));
                }
                else{
                    $this->Session->setFlash(__('User details could not be saved. Please try again.'));    
                }
            }
        }
        $this->set('service_type',$this->ServiceType->find('list',array('order'=>'id')));
        $this->set('type',$type);
    }
    
    public function user_profile(){
        $this->loadModel('ServiceType');
        $this->User->id = $this->Session->read('User.id');
        if(!$this->User->exists()){
            throw new NotFoundException(__('Invalid User'));       
        }
        if($this->request->is('post') || $this->request->is('put')){
            if($this->User->save($this->request->data)){
                $this->Session->setFlash(__('User details has been updated successfully'));
                $this->redirect('/');
            }
            else{
                $this->Session->setFlash(__('User details could not be saved. Please try again'));
            }
        }
        else{
            $this->request->data = $this->User->read(null,$this->User->id);
            $this->set('service_type',$this->ServiceType->find('list',array('order'=>'id')));
            unset($this->request->data['User']['Password']);
        }
    }
    public function organization_profile(){
        $this->loadModel('ServiceType');
        $this->User->id = $this->Session->read('User.id');
        
        if(!$this->User->exists()){
            throw new NotFoundException(__('Invalid User'));       
        }
        if($this->request->is('post') || $this->request->is('put')){
            if($this->User->save($this->request->data)){
                $this->Session->setFlash(__('Your details has been updated successfully'));
                $this->redirect('/');
            }
            else{
                $this->Session->setFlash(__('Your details could not be saved. Please try again'));
            }
        }
        else{
            $this->request->data = $this->User->read(null,$this->User->id);
            $this->set('service_type',$this->ServiceType->find('list',array('order'=>'id')));
            unset($this->request->data['User']['Password']);
        }
    }
    
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
    
    public function user_pic(){       
        
    }
    
    public function user_pic2(){        
        if($this->request->is('post') || $this->request->is('put')){
            $imageName = 'img_'.$this->Session->read('User.id');
            $uploaded = $this->JqImgcrop->uploadImage($this->request->data['User']['image'], '/img/upload/', $imageName);            
            $this->set('uploaded',$uploaded); 
        }
    }
    
    public function user_pic3(){       
        $data = $this->JqImgcrop->cropImage(170, $this->request->data['User']['x1'], $this->request->data['User']['y1'], $this->request->data['User']['x2'], $this->request->data['User']['y2'], $this->request->data['User']['w'], $this->request->data['User']['h'], $this->request->data['User']['imagePath'], $this->request->data['User']['imagePath']);
        $this->User->id = $this->Session->read('User.id');
        $this->User->save($data);
        $this->Session->setFlash(__('Your profile picture saved successfully'));
        if($this->Session->read('User.role') == 'organizations'){
            $this->redirect(array('action'=>'organization_profile'));
        }
        else{
             $this->redirect(array('action'=>'user_profile')); 
        }        
    }
    
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
    
    public function forgot_password($email_id = null){
       $this->layout = 'ajax';
       if($email_id == null){
            echo 'Please fill your email id';
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
                $mail_url = 'http://localhost'.$this->webroot.'users/reset_password/'.$fpid;
                $message = '<div style="float:left;background:#e7e7e7;min-height:200px;width:800px;font-family:Verdana, Geneva, sans-serif"><p>&nbsp;</p><div style="margin:0px 10px">Hello, <strong style="font-size:15px">'.$user['User']['first_name'].' '.$user['User']['last_name'].'</strong></div><p style="margin:15px 10px">You have requested for new password , Please click on following link to reset your password.</p><p style="margin:15px 10px"><a href="'.$mail_url.'">Click Here</a></p><p>&nbsp;</p><div style="margin:0px 10px">Thanks,<br /><h2 style="margin:0px">Soceana</h2>Generating Social Good</div><p>&nbsp;</p></div>';
                $subject = 'Soceana - Request for Forgot Password';
                // Email code
                App::uses('CakeEmail', 'Network/Email');        
                $email = new CakeEmail('gmail');
                $email->from('soceana@venturepact.com');
                $email->to($email_id);
                $email->subject($subject);
                $email->emailFormat('both');
                $email->send($message);
                echo 'Please check your email for reseting of password';                
            }
            else echo "Email id doesn't exists in our database";
       }
       $this->autoRender = false;
    }
    
    public function reset_password($id = null){
        if($id == null){
            $this->Session->setFlash('You are not authorized to reset the password');
        }
        else{
            // echo urldecode(base64_decode($id));
            }
    }
    
    /*public function send_email(){
        App::uses('CakeEmail', 'Network/Email');
        $message='<div style="float:left;background:#e7e7e7;min-height:200px;width:800px;font-family:Verdana, Geneva, sans-serif"><p>&nbsp;</p><div style="margin:0px 10px">Hello, <strong style="font-size:22px">Inderjit Singh</strong></div><p style="margin:15px 10px">You have requested for new password , Please click on following link to reset your password.</p><p style="margin:15px 10px"><a href="#">Click Here</a></p><p>&nbsp;</p><div style="margin:0px 10px">Thanks,<br /><h2 style="margin:0px">Soceana</h2>Generating Social Good</div><p>&nbsp;</p></div>';
        $email = new CakeEmail('gmail');
        $email->from('inderjit.singh@venturepact.com');
        $email->to('inderjit.singh@venturepact.com');
        $email->subject('Test email');
        $email->emailFormat('both');
        $email->send($message);            
        echo 'email sent';die;
    }*/
    
    //soceana123@gmail.com #### soceana_2013
}
?>