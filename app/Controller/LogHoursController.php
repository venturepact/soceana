<?php
/*
* @ Soceana Project 
* @ Log Hours Controller class
* @ Created on : 19th July 2013
* @ Created by : Inderjit Singh
*/
class LogHoursController extends AppController {
    
    public function add(){
         $this->loadModel('ServiceType');    
         if($this->request->is('post')){
            
            $this->request->data['LogHour']['user_id'] = $this->Session->read('User.id');
            $this->LogHour->save($this->request->data);
            
            //email code pending
            $this->Session->setFlash('Log hours have been saved successfully');
            $this->redirect('/');
            
            }else{
            $this->loadModel('User');
            $conditions = array('role'=>'organizations');
            $this->set('organizations',$this->User->find('list',array('conditions'=>$conditions,'fields'=>array('id','organization_name'))));
            $this->request->data['LogHour']['full_name'] = $this->Session->read('User.first_name') . ' '. $this->Session->read('User.last_name');
            $this->request->data['LogHour']['email'] = $this->Session->read('User.email_id');
            $this->request->data['LogHour']['location'] = $this->Session->read('User.location');
            }
        $this->set('service_type',$this->ServiceType->find('list',array('order'=>'id')));      
    }

    public function index() {
            $this->LogHour->find('all',array());
    }
    public function organization_index() {
            $this->LogHour->find('all',array());
    }
    
    public function getOrganizationEmail($id = null){
        $this->layout = 'ajax';
        $this->loadModel('User');
        $conditions = array('id'=>$id);
        $fields = array('email_id');
        $this->User->recursive = 0;
        $user = $this->User->find('first',array('conditions'=>$conditions,'fields'=>$fields));
        $this->request->data['LogHour']['organization_email'] = $user['User']['email_id'];
    }
    
    public function organization_add(){
         $this->loadModel('ServiceType');    
         if($this->request->is('post')){
            $this->request->data['LogHour']['organization'] = $this->Session->read('User.id');
            $this->request->data['LogHour']['status'] = 1;
            $this->LogHour->save($this->request->data);
            //email code pending
            $this->Session->setFlash('Log hours have been saved successfully');
            $this->redirect('/');
            }else{
                //function to get the array of volunteer names with ids of volunteers
                $this->set('users',$this->_getFullName());           
            }
        $this->set('service_type',$this->ServiceType->find('list',array('order'=>'id')));      
    }
    public function _getFullName(){
        $this->loadModel('User');
        $conditions = array('role'=>'user');
        $this->User->recursive = 0;
        $users = $this->User->find('all',array('conditions'=>$conditions,'fields'=>array('id','first_name','last_name')));
        $temp = array();
        foreach($users  as $user){
            $temp[$user['User']['id']] = $user['User']['first_name'].' '.$user['User']['last_name'];
        }
        return $temp;
    }
    
    public function getVolunteerEmail($id = null){
        $this->layout = 'ajax';
        $this->loadModel('User');
        $conditions = array('id'=>$id);
        $fields = array('email_id');
        $this->User->recursive = 0;
        $user = $this->User->find('first',array('conditions'=>$conditions,'fields'=>$fields));
        $this->request->data['LogHour']['volunteer_email'] = $user['User']['email_id'];
    }
    
    public function volunteerPieData(){        
        $this->layout = '';        
        $array = $this->LogHour->query('select distinct(l.category_id)as cat_id ,c.category_name,(select sum(hours) from log_hours where category_id = cat_id and user_id = '.$this->Session->read('User.id').' and status = 1)as total_hours from log_hours l,categories c where l.user_id = '.$this->Session->read('User.id').' and c.id = l.category_id and l.status = 1');
        $string = '<chart caption="Log Hours for different Categories" palette="2" animation="1" numberSuffix=" Hrs." formatNumberScale="0" pieSliceDepth="30" startingAngle="200">';
        
        foreach($array as $arr){
            $string.= '<set label="'.$arr['c']['category_name'].'" value="'.$arr['0']['total_hours'].'" isSliced="0" />';
        }
        $string.='<styles><definition><style type="font" name="CaptionFont" size="15" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>';
        //$string = "'".$string."'";
        echo $string;       
        $this->autoRender = false;
    }
    
}