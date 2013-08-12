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
        $this->Auth->allow('add');
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
        $this->layout = 'signup';
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
}
?>