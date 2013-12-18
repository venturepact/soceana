<?php
/*
* @ Soceana Project 
* @ Log Hours Controller class
* @ Created on : 19th July 2013
* @ Created by : Inderjit Singh
*/
class LogHoursController extends AppController {
    
	public $helpers = array('Sponsor');
	
    /* @ function to add log hour for Volunteer */
    public function add(){
         $this->loadModel('ServiceType');
         $this->loadModel('Category');
		 $this->loadModel('State');
         if($this->request->is('post')){
            
            $this->request->data['LogHour']['user_id'] = $this->Session->read('User.id');
			// for conversion of normal date to mysql date          
            $this->request->data['LogHour']['job_date'] = date('Y-m-d',strtotime(str_replace('-', '/', $this->request->data['LogHour']['job_date'])));
	    $this->request->data['LogHour']['hours'] = $this->request->data['LogHour']['hours'] .':'.$this->request->data['LogHour']['minutes'];
		  
		  if($this->request->data['User']['city']){
			  $this->request->data['LogHour']['city'] = $this->request->data['User']['city'];
			  unset($this->request->data['User']['city']);
		  }
		  
		  
			
            if($this->LogHour->save($this->request->data)){
                $this->loadModel('LogHourImage');
                $id = $this->LogHour->id;
				if(isset($this->request->data['LogHourImage']['id'])){
                foreach($this->request->data['LogHourImage']['id'] as $image_id){
                    $data['LogHourImage']['id'] = $image_id;
                    $data['LogHourImage']['log_hour_id'] = $id;
                    $data['LogHourImage']['temp_session'] = '';
                    $this->LogHourImage->save($data);
                	}
				}
            }                        
            $this->Session->setFlash('Log hours have been saved successfully');
            $this->redirect('/');            
            }else{
			$this->loadModel('User');
			$this->loadModel('LogHourImage');
            $conditions = array('role'=>'organizations');            
            $this->set('organizations',$this->User->find('list',array('conditions'=>$conditions,'fields'=>array('id','organization_name'))));
			
			//getting temporary images and removing temp images and their database record
			$temp_images = $this->LogHourImage->find('all',array(
														'conditions' => array('temp_session'=> $this->Session->read('User.id')),
														'fields'=> array('id','picture_url')
													 ));
			if(sizeof($temp_images) > 0){
				foreach($temp_images as $log_image){				
					$this->_remove_images($log_image['LogHourImage']['picture_url']);
					$this->LogHourImage->delete($log_image['LogHourImage']['id']);
				}
			}
														
            $this->request->data['LogHour']['full_name'] = $this->Session->read('User.first_name') . ' '. $this->Session->read('User.last_name');
            $this->request->data['LogHour']['email'] = $this->Session->read('User.email_id');
            $this->request->data['LogHour']['location'] = $this->Session->read('User.location');
            }
           
        $this->set('service_types',$this->ServiceType->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));
        $this->set('categories',$this->Category->find('list',array('order'=>'id','fields'=>array('id','category_name'))));      
		$this->set('states',$this->State->find('list',array('order'=>'id','fields'=>array('id','state_name'))));
    }
	
	public function _remove_images($image_name){
		$upload_dir = WWW_ROOT.str_replace("/", DS, '/img/log_hours/');
        $upload_path = $upload_dir.DS.$image_name;
		unlink($upload_path);
		return true;	
	}
    
    public function add_images(){
        $this->layout = '';
        $upload_dir = WWW_ROOT.str_replace("/", DS, '/img/log_hours/');
        $upload_path = $upload_dir.DS;
        $i = 0;
        $temp = array();       
        $this->loadModel('LogHourImage');
        $data = array();
        foreach ($_FILES["images"]["error"] as $key => $error) {
            if ($error == 0) {
                $name = $_FILES["images"]["name"][$key];
                $file_ext = substr($name, strrpos($name, ".") + 1);
                $new_name = time()."_".$this->Session->read('User.id')."_$key.".$file_ext;
                if(move_uploaded_file( $_FILES["images"]["tmp_name"][$key], $upload_path.$new_name)){
					chmod ($upload_path.$new_name , 0777);
                    if(isset($_REQUEST['caption_'.$key]))
                    $caption = $_REQUEST['caption_'.$key];
                    else $caption = '';
                       
                        $data['LogHourImage']['picture_url'] =  $new_name;
                        $data['LogHourImage']['temp_session'] =  $this->Session->read('User.id');
                        $data['LogHourImage']['caption'] =  $caption;
                        if($this->LogHourImage->save($data)){
                        $id = $this->LogHourImage->id;
                        unset($this->LogHourImage->id);
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
    /*public function organization_add(){
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
        $this->set('service_types',$this->ServiceType->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));
        $this->set('categories',$this->Category->find('list',array('order'=>'id','fields'=>array('id','category_name'))));      
    } */   
    
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
        $temp[0][0] = 'Categories';
        $temp[0][1] = 'Total Hours';
	$this->loadModel('Category');
	$category = $this->Category->find('all');
	//pr($category);die;
	$k = 1;
	foreach($category as $cat){
		$temp[$k][0] = $cat['Category']['category_name'];
		$data_array = $this->LogHour->find('all',array('fields'=>'hours',
                                                   'conditions'=>array(
                                                                     'user_id' => $this->Session->read('User.id'),
                                                                     'category_id' => $cat['Category']['id'],
                                                                     'LogHour.status' => 1,
                                                                     
                                                   )));
		
		if(count($data_array) == 0){
                    $temp[$k][1] = 0;
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
				//$mins_c = $mins / 60;
				//$hrs = $hrs + $mins_c;
				$mins = array_sum($min_array);				
				$mins_c = floor($mins / 60);
				$mins_m = $mins % 60 ;			
				$hrs = ( $hrs + $mins_c ).'.'.$mins_m;	
			}
                        $temp[$k][1] = $hrs;
			unset($hr_array);unset($min_array);
                }
		$k++;
	}       
       
        return $temp ;             
        $this->autoRender = false;
    }  
   
    
    public function volunteerChartData(){
        $this->layout = '';
        $this->loadModel('Category'); 
        $temp[0][0] = 'Months';     
         
        $cateories = $this->Category->find('all',array('order'=>'id'));
       
        $i = 1;
        foreach($cateories as $category){
            $temp[0][$i]= $category['Category']['category_name'];
            $i++;
        }      
        
        $k = 1;
        //$c = 0;
        for($i=5;$i>=0;$i--){
            $array = $this->_get_Month($i);
            $temp[$k][0] = $this->_getMonthName($array[0]);           
            
            $z = 1;
	    
	    $lg_hr_count = 0;
		
	    $lg_min_count = 0;
	    
            foreach($cateories as $category){            
           
                $data_array = $this->LogHour->find('all',array('fields'=>'hours',
                                                   'conditions'=>array(
                                                                     'user_id' => $this->Session->read('User.id'),
                                                                     'category_id' => $category['Category']['id'],
                                                                     'LogHour.status' => 1,
                                                                     'month(job_date)' => $array[0],
                                                                     'year(job_date)' => $array[1]
                                                   )));
		
                if(count($data_array) == 0){
                    $temp[$k][$z] = 0;
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
				$mins_c = floor($mins / 60);
				$mins_m = $mins % 60 ;		
				
				
				$hrs = ( $hrs + $mins_c ).'.'.$mins_m;				
				//echo $hrs.'<br/>';
			}
                        $temp[$k][$z] = $hrs;
			unset($hr_array);unset($min_array);
                }             
           
              $z++; 
            }
            $k++;
            
        }        
        return $temp;
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

    public function OrganizationChartData(){
      $this->layout = '';      
        $temp[0][0] = 'Months';     
        $temp[0][1] = 'Hours';       
        $k = 1;
        //$c = 0;
        for($i=5;$i>=0;$i--){
            $array = $this->_get_Month($i);
            $temp[$k][0] = $this->_getMonthName($array[0]);
            
                $data_array = $this->LogHour->find('all',array('fields'=>'hours',
                                                   'conditions'=>array(
                                                                     'organization' => $this->Session->read('User.id'),                                                                  
                                                                     'LogHour.status' => 1,
                                                                     'month(job_date)' => $array[0],
                                                                     'year(job_date)' => $array[1]
                                                   )));
		
		if(count($data_array) == 0)
		{
		        $temp[$k][1] = 0;
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
			//$mins_c = $mins / 60;
			//$hrs = $hrs + $mins_c;
				$mins_c = floor($mins / 60);
				$mins_m = $mins % 60 ;			
				$hrs = ( $hrs + $mins_c ).'.'.$mins_m;	
			}
			$temp[$k][1] = $hrs;
			unset($hr_array);unset($min_array);
		}
		$k++;               
	       
                }
                   
       
        return $temp;
        $this->autoRender = false;     
    }
        

	public function CompanyChartData(){
		  $this->layout = '';      
			$temp[0][0] = 'Months';     
			$temp[0][1] = 'Hours';       
			$k = 1;
			//$c = 0;
			for($i=5;$i>=0;$i--){
				$array = $this->_get_Month($i);
				$temp[$k][0] = $this->_getMonthName($array[0]);
					
					$this->LogHour->bindModel(
								array('belongsTo' => array(
										'User' =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'user_id'),
									),
								),false
							);
				
					$data_array = $this->LogHour->find('all',array('fields'=>'hours',
													   'conditions'=>array(
														'User.employer' => $this->Session->read('User.id'),                                            
														'LogHour.status' => 1,
														'month(job_date)' => $array[0],
														'year(job_date)' => $array[1]
													   )));
					if(count($data_array) == 0){
					    $temp[$k][1] = 0;
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
							//$mins_c = $mins / 60;
							//$hrs = $hrs + $mins_c;
							$mins_c = floor($mins / 60);
							$mins_m = $mins % 60 ;			
							$hrs = ( $hrs + $mins_c ).'.'.$mins_m;	
						}
						$temp[$k][1] = $hrs;
						unset($hr_array);unset($min_array);
					}
					$k++;
					/*if($data_array[0]['count_of_hours']==null){
						$temp[$k][1] = 0;
					}
					else{
						 $temp[$k][1] = $data_array[0]['count_of_hours'];
					}
					$k++;  */
		}
					   
		   
			return $temp;
			$this->autoRender = false;     
	}
    
     
    function OrganizationAgeChartData(){        
        
        $this->layout = '';
        $temp[0][0] = 'Age';     
        $temp[0][1] = 'Hours'; 
        $array = array( 0 => array('label'=>'0-12' ,'from'=>$this->_getDate(12),'to'=> $this->_getDate(0) ),
                        1 => array('label'=>'13-17','from'=>$this->_getDate(17),'to'=> $this->_getDate(13)),
                        2 => array('label'=>'18-24','from'=>$this->_getDate(24),'to'=> $this->_getDate(18)),
                        3 => array('label'=>'25-44','from'=>$this->_getDate(44),'to'=> $this->_getDate(25)),
                        4 => array('label'=>'45-65','from'=>$this->_getDate(65),'to'=> $this->_getDate(45)),
                        5 => array('label'=>'65+'  ,'from'=>$this->_getDate(100),'to'=> $this->_getDate(65)),
                       );
       
       
        $k = 1;
        foreach($array as $arr){
        $temp[$k][0] = $arr['label'];
        $data_array = $this->LogHour->find('all',array(				
				'fields'      => 'hours',
				'conditions'  => array("birth_date between '".$arr['from']."' and '".$arr['to']."'",
                                                       'LogHour.status'=> 1,
                                                       'organization' => $this->Session->read('User.id'))
			));
                
		if(count($data_array) == 0){
			$temp[$k][1] = 0;
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
				//$mins_c = $mins / 60;
				//$hrs = $hrs + $mins_c;
				$mins_c = floor($mins / 60);
				$mins_m = $mins % 60 ;			
				$hrs = ( $hrs + $mins_c ).'.'.$mins_m;	
			}
			$temp[$k][1] = $hrs;
			unset($hr_array);unset($min_array);
		}
		$k++;
        }
        return $temp;
        $this->autoRender = false;
    } 
     
    /* @ function to get the date from last years */
    function _getDate($years){
        return date('Y-m-d', strtotime("-$years years")); 
    }
    
    /* @ function to show the review hours section grid showing the complete data  */
    function review_hours(){
		
        if($this->request->is('post')){
            $this->Session->write('page_limit',$this->request->data['Pages']['limit']);  
		}
	
	
		
		if($this->Session->read('page_limit') != null){
			$limit = $this->Session->read('page_limit');			
		}
		else $limit = 5;	
		
		
			// check for current page with page limit that record exits to show page or not
		if(isset($this->params['named']['page']) && $this->params['named']['page'] >= 2){
			 //echo $this->params['named']['page'];
				$this->loadModel('LogHour');
				
				$start_count =  $limit * ($this->params['named']['page'] - 1) + 1 ;
				
			    $count = $this->LogHour->find('count',array('conditions'=>array('organization'=>$this->Session->read('User.id'))));			
				
				if($start_count > $count){
					
					$this->redirect('/log_hours/review_hours');
				}
			 
			}
		   
		if($this->Session->read('User.role') == 'organizations'){
			$this->set('loghours',$this->_organizationGridData($limit));	
		}
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
    
    /* @ function to show individual log hour data in the form for view/update of status */
    public function confirm_hours($id = null)
    {
        if($id == null ){
            $this->redirect(array('action' => 'review_hours'));
        }
        
        $this->LogHour->bindModel(
                                array('belongsTo' => array(
		                        'Category'    =>  array('className' => 'Category','joinTable' => 'categories','foreignKey' => 'category_id','fields'=>array('category_name')),
                    	                'ServiceType' =>  array('className' => 'ServiceType','joinTable' => 'service_types','foreignKey' => 'service_type_id','fields'=>array('name')),
					'User'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'user_id','fields'=>array('first_name','last_name','email_id')),
                                        'Organization'        =>  array('className' => 'User','joinTable' => 'users','foreignKey' => 'organization','fields'=>array('organization_name')),
                                        )
                                    ),false
	);
        $record = $this->LogHour->find('first',array('conditions'=>array('LogHour.id'=>$id)));
        
        $this->request->data['LogHour']['id'] = $record['LogHour']['id'];
        $this->request->data['LogHour']['email'] = $record['User']['email_id'];
        $this->request->data['LogHour']['full_name'] = $record['User']['first_name'] . ' '. $record['User']['last_name'];
        $this->request->data['LogHour']['position'] = $record['LogHour']['position'];
        $this->request->data['LogHour']['organization'] = $record['Organization']['organization_name'];
        $this->request->data['LogHour']['location'] = $record['LogHour']['location'];
        $this->request->data['LogHour']['hours'] = $record['LogHour']['hours'];
        $this->request->data['LogHour']['job_date'] = date("m-d-Y", strtotime($record['LogHour']['job_date']));
        $this->request->data['LogHour']['service_type_id'] = $record['LogHour']['service_type_id'];
        $this->request->data['LogHour']['status'] = $record['LogHour']['status'];
        $this->request->data['LogHour']['category_id'] = $record['LogHour']['category_id'];
		if( $record['LogHour']['state'] != 0 ){
			$this->request->data['LogHour']['state'] = $record['LogHour']['state'];
			$this->loadModel('City');
			$this->set('cities',$this->City->find('list',array('order'      => 'city_name',
											    				   'fields'     => array('id','city_name'),
									                               'conditions' => array('state_id' => $this->request->data['LogHour']['state']),						     
									   )
				));
			if( $record['LogHour']['city'] != 0 ){	
				$this->request->data['LogHour']['city'] = $record['LogHour']['city'];
			}
		}
		else{
			$this->set('cities',array());
		}
		
        $this->loadModel('ServiceType');
		$this->loadModel('Category');		
		$this->loadModel('LogHourImage');
		$this->loadModel('State');
		
		//getting temporary images and removing temp images and their database record
		$this->set('log_images', $this->LogHourImage->find('all',array(
														'conditions' => array('log_hour_id'=> $id),
														'fields'=> array('picture_url')
													 )));
		$this->set('categories',$this->Category->find('list',array('order'=>'id','fields'=>array('id','category_name'))));	
        $this->set('service_types',$this->ServiceType->find('all',array('order'=>'id','fields'=>array('id','name','picture_url'))));        $this->set('states',$this->State->find('list',array('order'=>'id','fields'=>array('id','state_name'))));
        
    }
    
    /* @ function to approve hours data */
    public function approve_hours($id = null)
    {
        if($id == null ){
            $this->redirect(array('action' => 'review_hours'));
        }
        
        $data['LogHour']['id'] = $id;
        $data['LogHour']['status'] = 1;
        $this->LogHour->save($data);
        $this->Session->setFlash('Log hours confirmed successfully');
        $this->redirect(array('action' => 'review_hours'));       
    }
    
    /* @ function to reject hours data */
    public function reject_hours($id = null)
    {
        if($id == null ){
            $this->redirect(array('action' => 'review_hours'));
        }
        
        $data['LogHour']['id'] = $id;
        $data['LogHour']['status'] = 2;
        $this->LogHour->save($data);
        $this->Session->setFlash('Log hours rejected successfully');
        $this->redirect(array('action' => 'review_hours'));       
    }
    
}