<style>
    label.error{ color: #FF0000 !important;font-size: 12px !important;margin: -3px 0 5px 185px !important;text-align: left !important;text-transform: none !important;width: 100% !important;}
    ul#type label.error{color: #FF0000 !important;left:0px !important;position: absolute !important;text-transform: none !important;top: 935px !important;width: 100% !important;}
	ul#skill_set_select label.error{color: #FF0000 !important;left:0px !important;position: absolute !important;text-transform: none !important;top: 1325px !important;width: 100% !important;}
    #flashMessage{color: #FF0000;float: left;margin: 20px 0 0 236px;}
    .profile_top img{border: 2px solid #E7E7E7;margin-bottom: 10px;}    
</style>
<?php echo $this->Html->script('jquery.validate');?>
<style>
    label.error{ color: #FF0000;font-size: 12px;margin: -3px 0 5px 190px;text-align: left;text-transform: none;width: 100%;}
    ul label.error{color: #FF0000 !important;left: -378px !important;position: absolute !important;text-transform: none !important;top: 831px !important;width: 100% !important;}
    #flashMessage{color: #FF0000;float: left;margin: 20px 0 0 236px;}
</style>
<div class="top_heading">
         <h1>ORGANIZATION PROFILE</h1>
          <h3>View your profile and update your information, privacy settings, and more.</h3>
            
           </div>       
     <div class="wrapper_left_section">
         
         <div class="left_top_section_p">
               <div class="main_text">                  
                   <p>COMPLETE YOUR PROFILE</p></div>
                      <div class="news_text">
                        <span>You profile is 75% complete add your<strong> Location, Company Size & Location</strong> #</span>               
                           </div>                                          
               </div>
       <!--table-->
       <div class="vol_table">                        
           
         <div class="section">
            <?php echo $this->Form->create('User',array('id'=>'organization_profile_update','name'=>'org_profile'));?>              
               <div class="signup_form">
                    <label name="name">Email</label>
                    <?php echo $this->Form->input('email_id',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                    <img src="<?php echo $this->webroot;?>img/glob_icon.png" alt="" class="glob" />
                </div>
               <div class="mt20"></div>
               <div class="signup_form">
                   	<label name="name">FIRST NAME</label>
                        <?php echo $this->Form->input('first_name',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                       <img src="<?php echo $this->webroot;?>img/glob_icon.png" alt="" class="glob" />
               </div>
               <div class="mt20"></div>
               <div class="signup_form">
               		<label name="name">LAST NAME</label>
                       <?php echo $this->Form->input('last_name',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                       <img src="<?php echo $this->webroot;?>img/glob_icon.png" alt="" class="glob" />
               </div>
               <div class="mt20"></div>
               <div class="signup_form">
                 <label name="name">COMPANY NAME</label>
                 <?php echo $this->Form->input('organization_name',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                 <img src="<?php echo $this->webroot;?>img/glob_icon.png" alt="" class="glob" />
               </div>               
               <div class="mt20"></div>
               <div class="signup_form">
                 <label name="name">Location</label>
                 <?php echo $this->Form->input('location',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                 <img src="<?php echo $this->webroot;?>img/glob_icon.png" alt="" class="glob" />
                 </div>
               <div class="mt20"></div>
               <div class="signup_form">
                 <label name="name">Size</label>
                  <?php echo $this->Form->input('size',array(
								   'type'=>'select',
								   'div'=>false,
								   'label'=>false,
							       'class'=>'text_style',
								   'options'=>array(
										    '9'=>'Below 10',
										    '10'=>'10 +',
										    '50'=>'50 +',
										    '100'=>'100 +',
										    '1000'=>'1000+'
										    ),
								  
			));?><img src="<?php echo $this->webroot;?>img/glob_icon.png" alt="" class="glob" />
               </div>
               <div class="signup_form">
                 <label name="name">Phone #</label>
                <?php echo $this->Form->input('phone',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style','placeholder'=>'For eg.  917-555-5555'));?>
                <img src="<?php echo $this->webroot;?>img/glob_icon.png" alt="" class="glob" />
               </div>
               <div class="signup_form">
                 <label name="name">Mission and Vision</label>
                 <?php echo $this->Form->input('mission',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_style'));?>
                 <img src="<?php echo $this->webroot;?>img/glob_icon.png" alt="" class="glob" />
               </div>
               
               <div class="clr"></div>
               <div class="mt20"></div>
               <div class="signup_form">
                 <label name="name">Additional</label>
                  <?php echo $this->Form->input('additional_notes'
				  ,array('type'=>'textarea','div'=>false,'label'=>false,'rows'=>10,'cols'=>30,'class'=>'text_style'));?>
                  
               </div>             
               <div class="clr"></div>
               <div class="mt20"></div>              
		 <div class="signup_form_blue">
                    	<label name="name">ORGANIZATION INTEREST <br />TYPE:<br />
                        <span>(for ogranizations that your compnay seeks to partner with)</span></label>
                        <ul id='type'>
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
               <div class="contact_form">
                 <div class="submit_button" id='update_profile'>
                   <input type="submit" class="submit_button5 cursor_grid" value='' />
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
	
	
	//validation rule for only alphabets value.match(phoneno)#sthash.DMSRm91G.dpuf
    $.validator.addMethod("valid_phone", function(value) {
        return value == value.match(/^\(?\d{3}\)? ?-? ?\d{3} ?-? ?\d{4}$/);    
    }, 'Please enter a valid phone no'); 
	         
        // validate signup form on keyup and submit
        $("#organization_profile_update").validate({

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
						 "data[User][organization_name]": {
                         required: true,
                         minlength:2,
                         maxlength:60
                         },
						 "data[User][location]": {                         
                          'alpha':true,
                          minlength:2,
                          maxlength:60
                         },  
						 "data[User][phone]": {					                        
						 	'valid_phone':true                          	                
                         },                      
                        "data[ServiceType][ServiceType][]": {
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
						  "data[User][organization_name]": {
                            required: 'Please enter your company name',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 60 characters'
                         },
						 "data[User][location]": {
                            required: 'Please enter your location',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 60 characters'
                         },						      
                        "data[ServiceType][ServiceType][]": {
                            required: 'Please select atleast one organization interest type ',
                        },						
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
                	  <h1><?php echo strtoupper($this->Session->read('User.organization_name'));?></h1>
                       <div class="img_section"><?php
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
		?></div>
         <?php
	  	if(strlen($this->request->data['User']['thumb_image']) > 0 ){
		    ?>
                    <a href="<?php echo $this->webroot;?>users/reposition_pic" class="repostive_blue">REPOSITION PIC</a>
                    <?php
		}
		?>
                    <a href="<?php echo $this->webroot;?>users/user_pic" class="uploads_blue">UPLOAD</a>
                    
                </div>
          		<div class="clr"></div>
               <div class="tip_up"></div>
               <div class="sponser_inner">
               <span class="sponsors_text">Sed ultricies volutpat tempor. Cras non lacus at enim venenatis hendrerit. Morbi lacus arcu, luctus sollicitudin molestie vulputate, sagittis eget quam. Praesent eget massa purus. Mauris fermentum ante quis mauris pretium, eu interdum metus fringilla. Curabitur lacinia vulputate tincidunt.</span>
               <div class="clr"></div>
               <div class="mt20"></div>
               <span>You have <strong>0 Characters</strong> <br />remaining</span>
                <a href="#" class="uploads_submit">SUBMIT</a>
               
               </div>
                       
                       
             </div>
             <div class="clr"></div>
             <div class="mt50"></div>
             <h1>SPONSORS</h1>
            	 <?php echo $this->Sponsor->load_advertisements(); ?>
             </div>
             <a href="#" class="add_text">Advertise with Soceana</a>
               
         <div class="clr"></div>
               
</div>
     <script>      
     function validate(skill_value) {
      var skil_rate = 'skil_rate_' + skill_value;
	if(document.getElementById(skil_rate).style.display == 'block'){
	  document.getElementById(skil_rate).style.display = 'none';
	}
	else document.getElementById(skil_rate).style.display = 'block';
     }      
     </script>