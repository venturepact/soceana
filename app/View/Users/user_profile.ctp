<style>
    label.error{ color: #FF0000 !important;font-size: 12px !important;margin: -3px 0 5px 185px !important;text-align: left !important;text-transform: none !important;width: 100% !important;}
    ul label.error{color: #FF0000 !important;left: -186px !important;position: absolute !important;text-transform: none !important;top: 405px !important;width: 100% !important;}
    #flashMessage{color: #FF0000;float: left;margin: 20px 0 0 236px;}
    .profile_top img{border: 2px solid #E7E7E7;margin-bottom: 10px;}    
    </style>
<link type="text/css" href="<?php echo $this->webroot;?>js/datepicker/jquery.datepick.css" rel="stylesheet">
<?php echo $this->Html->script('jquery.validate');?>
<?php echo $this->Html->script('datepicker/jquery.datepick');?>
<script type="text/javascript">
$(function() {
	$('#dob').datepick({dateFormat: 'yyyy-mm-dd',yearRange: "-80:+0", maxDate: '0'});	
});
</script>
<div class="top_heading">
           <h1>PROFILE</h1>
            <h3>View your profile and update your information,privacy settings, and more.</h3>
            
             </div>
       
       
       <div class="wrapper_left_section">
           
        
 <!--table-->
    <div class="vol_table">                        
    
    <div class="section">
            	<?php echo $this->Form->create('User',array('id'=>'user_profile_update'));?>
                	<div class="signup_form">
                    	<label name="name">Email</label>
                         <?php echo $this->Form->input('email_id',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'text_style'));?>
                    </div>                  
                    <div class="mt20"></div>
                    <div class="signup_form">
                    	<label name="name">FIRST NAME</label>
                        <?php echo $this->Form->input('first_name',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                    </div>
                   <div class="signup_form">
                    	<label name="name">LAST NAME</label>
                       <?php echo $this->Form->input('last_name',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                    </div>
                  
                  <div class="mt20"></div>
                  <div class="signup_form">
                    	<label name="name">Employer:</label>
                       <?php echo $this->Form->input('employer',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                  </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>
                  
                  <div class="signup_form">
                    	<label name="name">Location:</label>
                         <?php echo $this->Form->input('location',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                  </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>                  
                  <div class="signup_form">
                    	<label name="name">Gender:</label>			
                        <input type="radio" id="r0" name="data[User][gender]" value="M" <?php
				//pr($this->request->data);
                                //echo $this->request->data['User']['gender'];
				 if(isset($this->request->data['User']['gender'])){				   
                                     if($this->request->data['User']['gender'] == 'M') {
                                        echo "checked='checked'";
                                    } 
                                }
                               ?> />
			<label for="r0" class="radio-label"><span>Male</span></label>
                        
                        <input type="radio" id="r1" name="data[User][gender]" value="F" <?php
                                if(isset($this->request->data['User']['gender'])){
                                     if($this->request->data['User']['gender'] == 'F') {
                                        echo "checked='checked'";
                                    } 
                                }
                               ?> />
                        <label for="r1" class="radio-label"><span>Female</span></label>
                  </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>
                  <div class="signup_form">
                    	<label name="name">Phone number:</label>
                        <?php echo $this->Form->input('phone',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                  </div>
                   <div class="clr"></div>
                  <div class="mt20"></div>
                  <div class="signup_form">
                    	<label name="dob">Date of Birth:</label>
                       <?php echo $this->Form->input('birth_date',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style','placeholder'=>'YYYY-MM-DD','id'=>'dob','readonly'=>'readonly'));?>
                  </div>
                  
                   <div class="clr"></div>
                   <div class="mt20"></div>
                   <div class="signup_form">
                    	<label name="name">VOLUNTEER TYPE:<br />
                        <span>(choose as many as you like)</span></label>
                        <ul>
                            <?php
                            $i = 1;
			    $k = 1;
                            foreach($service_types as $service_type):			    
			    ?>
                            <li <?php if($k == 1) echo 'class="first"';?>>
                                <input type="checkbox" id="c<?php echo $i;?>" name="data[ServiceType][ServiceType][]" value="<?php echo $service_type['ServiceType']['id'];?>" <?php
                                if($this->request->is('post') || $this->request->is('put')){
				    if(isset($this->request->data['ServiceType']['ServiceType'])){
					if(in_array($service_type['ServiceType']['id'], $this->request->data['ServiceType']['ServiceType'])) {
					   echo "checked='checked'";
				        } 
				    }
			        }
			        else{
				    if(isset($this->request->data['ServiceType'])){
					if(in_array($service_type['ServiceType']['id'], $temp_types)) {
					   echo "checked='checked'";
				        } 
				    }
			       }			        
                               ?>/>
                                <label for="c<?php echo $i;?>" class="checkbox-label"><span><img alt="<?php echo $service_type['ServiceType']['name'];?>" src="<?php echo $this->webroot;?>img/<?php echo $service_type['ServiceType']['picture_url'];?>" /></span></label>
                            </li>                            
                            <?php
			    if($k == 3) $k = 0;
			    $k++;
                            $i++;
                            endforeach;
                            ?>
                            <li>
                            	<div class="grey">
                                	<label>Other ( Please Describe )</label>
                                	<textarea readonly="readonly"></textarea>
                                    <div class="input">
                                    <input type="button" name="cancel" class="cancel"/>
                                    </div>
                                    <div>
                                    <input type="button" name="submit" class="submit2"  />
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="clr"></div>
                    <div class="contact_form" style='margin: 20px !important;'>
                    	<div class="submit_button">
                        <input type="submit" class="submit_button3 cursor_grid" value='' />
						<div class="clr"></div>
                        or <a href="<?php echo $this->webroot;?>">Cancel</a>
                        </div>
                    </div>
                    
              <?php echo $this->Form->end();?>
	       <script type='text/javascript' language='javascript'>
$().ready(function() { 

 //validation rule for only alphabets
    $.validator.addMethod("alpha", function(value) {
        return value == value.match(/^[a-z A-Z]*$/);    
    }, 'Please enter only alphabets for this field');
	
	
	 //validation rule for valid email
    $.validator.addMethod("valid_email_id", function(value) {
        return value = value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);               
    }, 'Please enter a valid email id'); 
	           
        // validate signup form on keyup and submit
        $("#user_profile_update").validate({

            rules: {
                        "data[User][email_id]": {
                         required: true,
                         'valid_email_id':true
                        },
                        "data[User][first_name]": {
                         required: true,
						 'alpha':true,
						  minlength:2,
                          maxlength:50
                         },
                         "data[User][last_name]": {
                         required: true,
						 'alpha':true,
						  minlength:2,
                          maxlength:50
                         },   
						 "data[User][location]": {                         
                          'alpha':true,
                          minlength:2,
                          maxlength:60
                         },
						  "data[User][phone]": {                         
						 	number:true,
                          	min:1                      
                         },						                     
                        "data[ServiceType][ServiceType][]": {
                        required: true,
                        },
						 "data[User][birth_date]": {
							required: true,
							dateISO:true
                        },
                        
                    }
                    ,
                messages:{
						  "data[User][email_id]": {
						    	required: 'Please enter your email id',			  			  
						 },                         
	               		 "data[User][first_name]": {
                            required: 'Please enter your first name',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 50 characters'
                         },
                         "data[User][last_name]": {
                            required: 'Please enter your last name',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 50 characters'
                         },  
						 "data[User][location]": {
                            required: 'Please enter your location',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 60 characters'
                         },   
						 "data[User][phone]": {                         
						 	number:'Please enter valid phone number',
                          	min:'Please enter valid phone number'                     
                         },        
                        "data[ServiceType][ServiceType][]": {
                            required: 'Please select atleast one volunteer type',
                        }
		 },
	    errorElement: 'label',
            errorClass: 'error help-block',
            errorPlacement: function(error, element){
                if(element.is('input[type="checkbox"]')){
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
        });                    
});
</script>
            </div>         
    </div>          
           </div>
                    
            <div class="wrapper_mid_border"></div>
              
       <div class="wrapper_right_section">
          
             <div class="right_section_inner">  
             	<div class="profile">
          		<div class="profile_top">
                 <h1><?php echo strtoupper($this->Session->read('User.first_name').' '.$this->Session->read('User.last_name'));?></h1>
                	 <?php
	  	if(strlen($this->request->data['User']['thumb_image']) > 0 ){
		    ?>
		<img src="<?php echo $this->webroot;?>img/upload/<?php echo $this->request->data['User']['thumb_image'];?>"  id='prof_image' />
		<?php
		}
		else{
		    ?>
		<img src="<?php echo $this->webroot;?>img/no_image.png" />
		<?php
		}
		?>
                    <a href="<?php echo $this->webroot;?>users/reposition_pic" class="repostive">REPOSITION PIC</a>
                    <a href="<?php echo $this->webroot;?>users/user_pic" class="uploads">UPLOAD</a>
                    
                </div>
          		<div class="clr"></div>
               <div class="tip_up"></div>
               <div class="sponser_inner">
              <span class="sponsors_text">Sed ultricies volutpat tempor. Cras non lacus at enim venenatis hendrerit. Morbi lacus arcu, luctus sollicitudin molestie vulputate, sagittis eget quam. Praesent eget massa purus. Mauris fermentum ante quis mauris pretium, eu interdum metus fringilla. Curabitur lacinia vulputate tincidunt.</span>
               <div class="clr"></div>
               <div class="mt20"></div>
               <span>You have <strong>0 Characters</strong> <br />remaining</span>
               <div class="submit"></div>
               
               </div>
                       
                       
               </div>
             <div class="clr"></div>
             <div class="mt50"></div>
               <h1>SPONSORS</h1>
                 <div class="sponser_outer">
                    <div class="sponser_inner"><span class="sponsors_text"> Sed ultricies volutpat tempor. Cras non lacus at enim venenatis hendrerit. Morbi lacus arcu, luctus sollicitudin molestie vulputate, sagittis eget quam. Praesent eget massa purus. Mauris fermentum ante quis mauris pretium, eu interdum metus fringilla. Curabitur lacinia vulputate tincidunt.</span></div>
                       <div class="tip"></div>
        <div class="add_section">
            <div class="section1">
                <div class="black_text">
                     THE CHILDREN’S HOSPITAL
OF PHILADELPHIA
                      </div>
                    <div class="black_text_thin">3401 Civic Center Blvd. Philadelphia PA
(215) 590-1000</div> 
<a href="#" class="orange_butt">VOLUNTEER THROUGH SOCEANA</a> 
                 </div>
              <div class="section2"><img src="<?php echo $this->webroot;?>img/ch_image.png" alt="" /></div>
              </div>   
                     
           
                     </div>
                     <div class="add_img_outer"><img src="<?php echo $this->webroot;?>img/volunteer.png" width="350" alt="" />
                  
                   </div>
                   
                   <div class="sponser_outer">
                    <div class="sponser_inner"><span class="sponsors_text"> Sed ultricies volutpat tempor. Cras non lacus at enim venenatis hendrerit. Morbi lacus arcu, luctus sollicitudin molestie vulputate, sagittis eget quam. Praesent eget massa purus. Mauris fermentum ante quis mauris pretium, eu interdum metus fringilla. Curabitur lacinia vulputate tincidunt.</span></div>
                       <div class="tip"></div>
        <div class="add_section">
            <div class="section1">
                <div class="black_text">
                 MANNA ON MAIN STREET
                      </div>
                    <div class="black_text_thin">713 W. Main Street. Lansdale PA
(215) 855-5454</div> 
<a href="#" class="orange_butt">VOLUNTEER THROUGH SOCEANA</a> 
                 </div>
              <div class="section2"><img src="<?php echo $this->webroot;?>img/main_steel_img.png" alt="" /></div>
              </div>   
                     
           
                     </div>   
                     
               </div>
               <a href="#" class="add_text">Advertise with Soceana</a>
               
           <div class="clr"></div>
               
           </div>