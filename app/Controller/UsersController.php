<?php
/*
* @ Soeana Project 
* @ Users Controller class
* @ created on : 19th July 2013
*/
class UsersController extends AppController{
    
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
    
    public function change_password(){
        
    }

}
?>