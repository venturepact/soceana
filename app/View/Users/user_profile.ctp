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
	$('#dob').datepick({dateFormat: 'mm-dd-yyyy',yearRange: "-80:+0", maxDate: '0'});
	 $('#employer').change(function(){
	 $('#emp_select').html('<img src="<?php echo $this->webroot;?>img/loading.gif" id="emp_img">');
	 $('#emp_select').fadeIn();
		var emp_id = $('#employer').val();		
			if(emp_id == '0') {
				$('#emp_select').fadeOut();
				$('#emp_div').fadeIn().slow();			
			}
			else{
				$('#emp_select').fadeOut();
				$('#emp_div').fadeOut().slow();
				
			}
		
	});	
		
});

</script>
<div class="top_heading">
           <h1>PROFILE</h1>
            <h3>View your profile and update your information, privacy settings, and more.</h3>
            
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
                       <?php echo $this->Form->input('employer',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => $companies,'empty' => 'Select Company','default' => 'empty','id'=>'employer'));?>
                        <span id='emp_select' style='float: right;'></span> 
                  </div>
                  <div id='emp_div' class="signup_form" <?php if($this->request->data['User']['employer']==0)echo 'style="display:block;"';else echo 'style="display:none"';?>>
                      <div class="clr"></div>
                      <div class="mt20"></div>
                 		 <label name="name">Employer Name :</label>                        
                         <?php echo $this->Form->input('employer_name',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                  </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>
                  
                  <div class="signup_form">
                    	<label name="name">Address :</label>
                         <?php echo $this->Form->input('location',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                  </div>
                   <div class="clr"></div>
                  <div class="mt20"></div>   
                   <div class="signup_form">
                    	<label name="name">Country :</label>                        
                       <?php echo $this->Form->input('country',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => array(1 =>'United States of America'),'id'=>'country'));?>
                       
                  </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>   
                  <div class="signup_form">
                    	<label name="name">State :</label>                        
                       <?php 
					  echo $this->Form->input('state',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => $states ,'empty' => 'Select State','default' => 'empty','id'=>'state'));?>
                       <span id='state_select' style='float: right;'></span> 
                  </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>   
                  <div class="signup_form" id='city_placeholder'>
                    	<label name="name">City :</label>                        
                       <?php 
					  echo $this->Form->input('city',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => array() ,'empty' => 'Select City','default' => 'empty','id'=>'city'));?>
                        
                  </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>                               
                  <div class="signup_form">
                    	<label name="name">Gender:</label>			
                        <input type="radio" id="r0" name="data[User][gender]" value="M" <?php
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
                        <?php echo $this->Form->input('phone',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style','placeholder'=>'For eg.  917-555-5555'));?>
                  </div>
                   <div class="clr"></div>
                  <div class="mt20"></div>
                  <div class="signup_form">
                    	<label name="dob">Date of Birth:</label>
                       <?php echo $this->Form->input('birth_date',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style','placeholder'=>'MM-DD-YYYY','id'=>'dob','readonly'=>'readonly'));?>
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
           <script src="http://jquery.bassistance.de/validate/additional-methods.js"></script>
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
	
	//validation rule for only alphabets value.match(phoneno)#sthash.DMSRm91G.dpuf
   /* $.validator.addMethod("valid_phone", function(value) {
        return value == value.match(/^\(?\d{3}\)? ?-? ?\d{3} ?-? ?\d{4}$/);    
    }, 'Please enter a valid phone no for eg. 917-555-5555'); */   
	           
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
						 "data[User][employer]": {
                         required: true,						 
                         }, 
						 "data[User][location]": {                         
                          'alpha':true,
                          minlength:2,
                          maxlength:60
                         },
						  "data[User][phone]": {					                        
						 	phoneUS: true                 	                
                         },					                     
                        "data[ServiceType][ServiceType][]": {
                        required: true,
                        },
						 "data[User][birth_date]": {
							required: true,							
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
						 "data[User][employer]": {
                         required: 'Please select your employer',						 
                         }, 
						 "data[User][location]": {
                            required: 'Please enter your location',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 60 characters'
                         },
						 "data[User][phone]": {					                        
						 	phoneUS: 'Please enter a valid phone number like 917-555-5555'                 	                
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
		<img src="<?php echo $this->webroot;?>img/upload/<?php echo $this->request->data['User']['thumb_image'].'?='.uniqid();?>"  id='prof_image' />
		<?php
		}
		else{
		    ?>
		<img src="<?php echo $this->webroot;?>img/no_image.png" />
		<?php
		}
		?>
                 <?php
	  	if(strlen($this->request->data['User']['thumb_image']) > 0 ){
		    ?>
                    <a href="<?php echo $this->webroot;?>users/reposition_pic" class="repostive">REPOSITION PIC</a>
                    <?php
		}
		?>
                    <a href="<?php echo $this->webroot;?>users/user_pic" class="uploads">UPLOAD</a>
                    
                </div>
          		<div class="clr" id='u_status'></div>
               <div class="tip_up"></div>
               <div class="sponser_inner">
              <span class="sponsors_text"><textarea name="comment" wrap="physical" rows="5" cols="32" onkeyup="limiter();" onkeypress="limiter();" onfocus="limiter();" onblur=limiter(); id="comment"><?php echo $this->Session->read('User.status_message');?></textarea></span>
               <div class="clr"></div>
               <div class="mt20"></div>
               <span>You have <strong><div id='limit'>0</div> Characters</strong> <br />remaining</span><span id='status_loading'></span>
               <input type='button' class="submit" id='status_sbmt' />               
               </div>
                       
                       
               </div>
             <div class="clr"></div>
             <div class="mt50"></div>
               <h1>SPONSORS</h1>
             <?php echo $this->Sponsor->load_advertisements(); ?>                    
               </div>
               <a href="javascript:void(0);" class="add_text">Advertise with Soceana</a>
               
           <div class="clr"></div>
               
           </div>
<script type="text/javascript">
//Edit the counter/limiter value as your wish
var count = "140";   
function limiter(){
var tex = $('#comment').val();
var len = tex.length;
if(len > count){
        tex = tex.substring(0,count);
        $('#comment').val(tex);
        return false;
}
$('#comment').val(tex);
$('#limit').text(count-len);
}
$(document).ready(function(){
    var total = '140';
    var tex = $('#comment').val();
    var len = tex.length;
    $('#limit').text(total - len);  
});
$('#status_sbmt').click(function(){
     $("#status_loading").html('<img src="<?php echo $this->webroot;?>img/loading.gif" style="margin:-2% 3%;">');
     $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'users/update_status',
                   data:{status:$('#comment').val()},
                   success: function(data) {
                        if(data == '1' ){
			    document.location.href = '<?php echo $this->webroot;?>';
			}			    
                   }
            });       
});
</script>