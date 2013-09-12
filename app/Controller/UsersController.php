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
    
    /* @ function for login of Volunteer / Organization */
    public function login(){        
        $this->layout = 'login';
        $this->set('title_for_layout','Soceana - User Login');
        if($this->request->is('post')){            
            if($this->Auth->login()){
                // allowing specific user type from specific form
                if($this->request->data['User']['role'] != $this->Auth->user('role'))
                {
                    if($this->request->data['User']['role']=='organizations')
                    {
                        $message = ' an organization';
                    }
                    else $message = ' a volunteer';
                    unset($this->request->data);                   
                    $this->Auth->logout();
                    $this->Session->setFlash(__('You are not allowed to access system as'.$message));
                }
                else
                {
                    $this->Session->write('User',$this->Auth->user());                
                    $this->redirect(array('controller'=>'pages','action'=>'display'));
                    //$this->redirect('/');
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
                    
                    $this->Session->setFlash(__('User details has been saved successfully'));
                    
                    $this->redirect(array('action'=>'login'));
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
        $this->User->id = $this->Session->read('User.id');
        if(!$this->User->exists()){
            throw new NotFoundException(__('Invalid User'));       
        }
        if($this->request->is('post') || $this->request->is('put')){
            //pr($this->request->data);die;
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
            
            $this->set('temp_types',$temp);
            $this->set('service_types',$this->ServiceType->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));
            unset($this->request->data['User']['Password']);
        }
    }
    
    /* @ function for update profile of an Organization */
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
            
            $this->set('temp_types',$temp);
            $this->set('service_types',$this->ServiceType->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));
            unset($this->request->data['User']['Password']);
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
            $imageName = 'img_'.$this->Session->read('User.id');
            $uploaded = $this->JqImgcrop->uploadImage($this->request->data['User']['image'], '/img/upload/', $imageName);            
            $this->set('uploaded',$uploaded); 
        }
    }
    
    /* @ function for updating user picture */
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
                
                $subject = 'Soceana - Request for Forgot Password';
                
                $this->_sendMail('yourfriends.soceana@venturepact.com',$email_id,$subject,$message);
                
                echo '<div id="fp_message">Please check your email for reseting of password</div>';                
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
                                $this->Session->setFlash(__('Your password have been reseted successfully'));
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
    
    function getusers()
    {
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
}
?>