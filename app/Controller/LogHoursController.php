<?php
/*
* @ Soceana Project 
* @ Log Hours Controller class
* @ Created on : 19th July 2013
* @ Created by : Inderjit Singh
*/
class LogHoursController extends AppController {
    
    /* @ function to add log hour for Volunteer */
    public function add(){
         $this->loadModel('ServiceType');
         $this->loadModel('Category');
         if($this->request->is('post')){
            
            $this->request->data['LogHour']['user_id'] = $this->Session->read('User.id');
            $this->request->data['LogHour']['status'] = 1;
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
        $this->set('categories',$this->Category->find('list',array('order'=>'id','fields'=>array('id','category_name'))));      
    }


    /* @ function to return Organization email on choosing of a particular Organization */
    public function getOrganizationEmail($id = null){
        $this->layout = 'ajax';
        $this->loadModel('User');
        $conditions = array('id'=>$id);
        $fields = array('email_id');
        $this->User->recursive = 0;
        $user = $this->User->find('first',array('conditions'=>$conditions,'fields'=>$fields));
        $this->request->data['LogHour']['organization_email'] = $user['User']['email_id'];
    }
    
    
    /* @ function to add log hour for organization */
    public function organization_add(){
         $this->loadModel('ServiceType');
         $this->loadModel('Category');
         if($this->request->is('post')){
            $this->request->data['LogHour']['organization'] = $this->Session->read('User.id');
            $this->request->data['LogHour']['status'] = 1;
            $this->LogHour->save($this->request->data);
            //email code pending
            $this->Session->setFlash('Log hours have been saved successfully');
            $this->redirect('/');
            }else{
                //function to get the array of volunteer names with ids of Volunteers
                $this->set('users',$this->_getFullName());           
            }
        $this->set('service_type',$this->ServiceType->find('list',array('order'=>'id')));
        $this->set('categories',$this->Category->find('list',array('order'=>'id','fields'=>array('id','category_name'))));      
    }    
    
    /* @ function to get full name of the Volunteer for drop down of Organization */
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
    
    /* @ function to get Volunteer */
    public function getVolunteerEmail($id = null){
        $this->layout = 'ajax';
        $this->loadModel('User');
        $conditions = array('id'=>$id);
        $fields = array('email_id');
        $this->User->recursive = 0;
        $user = $this->User->find('first',array('conditions'=>$conditions,'fields'=>$fields));
        $this->request->data['LogHour']['volunteer_email'] = $user['User']['email_id'];
    }
    
    /* @ function to get Volunteer Pie chart data */
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
    
    /* @ function to get Volunteer Chart data */
    public function volunteerChartData(){
        $this->layout = '';
        $string = '<chart caption="Hourly Report" subcaption="" lineThickness="2" showValues="0" formatNumberScale="0" anchorRadius="5"   divLineAlpha="20" divLineColor="CC3300" divLineIsDashed="1" showAlternateHGridColor="1" alternateHGridColor="CC3300" shadowAlpha="40" labelStep="2" numvdivlines="10" chartRightMargin="35" bgColor="FFFFFF,CC3300" bgAngle="270" bgAlpha="10,10" alternateHGridAlpha="5"  legendPosition ="RIGHT ">';
        $string.= '<categories >';
        $k = 0;
        for($i=5;$i>=0;$i--){
            $array = $this->_get_Month($i);
            $month_name = $this->_getMonthName($array[0]);
            $string.= '<category label="'.$month_name.'" />';
            $temp[$k] = $array;
            $k++;
        }
        $string.='</categories>';
        $this->loadModel('Category');        
        $cateories = $this->Category->find('all');
       // pr($temp);
        foreach($cateories as $category){
            
            $string.='<dataset seriesName="'.$category['Category']['category_name'].'" color="'.$category['Category']['color_code'].'" anchorBorderColor="'.$category['Category']['color_code'].'" anchorBgColor="'.$category['Category']['color_code'].'">';
            foreach($temp as $tem){
                //echo $tem[0].'<br>';
                $data_array = $this->LogHour->find('first',array('fields'=>'sum(hours) as count_of_hours',
                                                   'conditions'=>array(
                                                                     'user_id' => $this->Session->read('User.id'),
                                                                     'category_id' => $category['Category']['id'],
                                                                     'status' => 1,
                                                                     'month(job_date)' => $tem[0],
                                                                     'year(job_date)' => $tem[1]
                                                   )));
                if($data_array[0]['count_of_hours']==null){
                    $string.='<set value="0" />';
                }
                else{
                     $string.='<set value="'.$data_array[0]['count_of_hours'].'" />';
                }                
            }
            $string.='</dataset>';
            
        }
        
        $string.='<styles><definition><style name="CaptionFont" type="font" size="12"/></definition><application><apply toObject="CAPTION" styles="CaptionFont" /><apply toObject="SUBCAPTION" styles="CaptionFont" /></application></styles></chart>';
        //pr($temp);
        echo $string;
        $this->autoRender = false;
    }
    
    /* @ function to get Month and Year */
    public function _get_Month($month_no){
        return explode('-',date('m-Y', strtotime("-$month_no months"))); 
    }
    
    /* @ function to get Month Name */
    public function _getMonthName($monthNum){        
        return date("F", mktime(0, 0, 0, $monthNum, 10));    
    }
    
    /* @ function to get Organization chart data */
    public function OrganizationChartData(){
      
        $this->layout = '';
        $string = '<chart caption="Hourly Report - '.$this->Session->read('User.organization_name').'" subcaption="" lineThickness="2" showValues="0" formatNumberScale="0" anchorRadius="5"   divLineAlpha="20" divLineColor="CC3300" divLineIsDashed="1" showAlternateHGridColor="1" alternateHGridColor="CC3300" shadowAlpha="40" labelStep="2" numvdivlines="10" chartRightMargin="35" bgColor="FFFFFF,CC3300" bgAngle="270" bgAlpha="10,10" alternateHGridAlpha="5"  legendPosition ="RIGHT ">';
        $string.= '<categories >';
        $k = 0;
        for($i=5;$i>=0;$i--){
            $array = $this->_get_Month($i);
            $month_name = $this->_getMonthName($array[0]);
            $string.= '<category label="'.$month_name.'" />';
            $temp[$k] = $array;
            $k++;
        }
        $string.='</categories>';   
      
            
            $string.='<dataset seriesName="'.$category['Category']['category_name'].'" color="F2796B" anchorBorderColor="F2796B" anchorBgColor="F2796B">';
            foreach($temp as $tem){
              
                $data_array = $this->LogHour->find('first',array('fields'=>'sum(hours) as count_of_hours',
                                                   'conditions'=>array(                                                                    
                                                                     'organization' => $this->Session->read('User.id'),
                                                                     'status' => 1,
                                                                     'month(job_date)' => $tem[0],
                                                                     'year(job_date)' => $tem[1]
                                                   )));
                if($data_array[0]['count_of_hours']==null){
                    $string.='<set value="0" />';
                }
                else{
                     $string.='<set value="'.$data_array[0]['count_of_hours'].'" />';
                }                
            }
            $string.='</dataset>';     
       
        
        $string.='<styles><definition><style name="CaptionFont" type="font" size="12"/></definition><application><apply toObject="CAPTION" styles="CaptionFont" /><apply toObject="SUBCAPTION" styles="CaptionFont" /></application></styles></chart>';
        
        echo $string;
        $this->autoRender = false;
    }
    
    /* @ function to get Organization chart data comparison of Age*/
    function OrganizationAgeChartData(){        
        
         $this->layout = '';
        
        $array = array( 0 => array('label'=>'0-12' ,'from'=>$this->_getDate(12),'to'=> $this->_getDate(0) ),
                        1 => array('label'=>'13-17','from'=>$this->_getDate(17),'to'=> $this->_getDate(13)),
                        2 => array('label'=>'18-24','from'=>$this->_getDate(24),'to'=> $this->_getDate(18)),
                        3 => array('label'=>'25-44','from'=>$this->_getDate(44),'to'=> $this->_getDate(25)),
                        4 => array('label'=>'45-65','from'=>$this->_getDate(65),'to'=> $this->_getDate(45)),
                        5 => array('label'=>'65+'  ,'from'=>$this->_getDate(100),'to'=> $this->_getDate(65)),
                       );
        
        $this->LogHour->bindModel(
			array('belongsTo' => array(					
					'User'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'user_id','fields'=>array('first_name','last_name'))
				)
			),false
		);
        $string ='<chart palette="2" caption="AGE DISTRIBUTION" xAxisName="AGE" yAxisName="HRS." labelDisplay="Rotate" showValues="0" decimals="0" formatNumberScale="0">';
        foreach($array as $arr){
        $loghours = $this->LogHour->find('first',array(				
				'fields'      => 'sum( LogHour.hours ) AS total_hours',
				'conditions'  => array("birth_date between '".$arr['from']."' and '".$arr['to']."'",
                                                       'status'=> 1,
                                                       'organization' => $this->Session->read('User.id'))
			));
        $string.='<set label="'.$arr['label'].'" value="'.$loghours[0]['total_hours'].'" />';
        }
        $string.='<styles><definition><style name="myAnim" type="animation" param="_yScale" start="0" duration="1"/></definition><application><apply toObject="VLINES" styles="myAnim" /></application></styles></chart>';
        echo $string;
        $this->autoRender = false;
    }
    
    /* @ function to get the date from last years */
    function _getDate($years){
        return date('Y-m-d', strtotime("-$years years")); 
    }    
}