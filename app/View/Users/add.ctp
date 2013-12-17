<?php echo $this->Html->script('jquery.validate');?>
<?php
 if($type == 'organizations') {
?>
<style>
    label.error{ color: #FF0000;font-size: 12px;margin: -3px 0 5px 190px;text-align: left;text-transform: none;width: 100%;}
    ul label.error{left:-189px !important;position: absolute !important;top: 202px !important;color: #FF0000 !important;}
	#flashMessage{color: #FF0000;float: left;margin: 20px 0 0 236px;}
    </style>
<div class="container">
<?php echo $this->Form->create('User',array('id'=>'user_signup'));?>
<?php echo $this->Form->input('role',array('type'=>'hidden','value'=>$type));?>
        	<div class="section">
				<h1>REGISTER YOUR ORGANIZATION WITH SOCEANA</h1>
                <p>Soceana offers organizations with features to connect with portential volunteers and to network with their specific region. Registering an organization with Soceana is a cinch, and will always be free.</p>
                <?php echo $this->Session->flash(); ?>
            </div>
			<div class="mt50"></div>
			<div class="section">            	
                	<div class="contact_form">
                    	<label name="name">Email</label>
                        <?php echo $this->Form->input('email_id',array('type'=>'text','div'=>false,'label'=>false,'id' => 'email_id','maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">CONFIRM Email</label>
                        <?php echo $this->Form->input('confirm_email',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">FIRST NAME</label>
                       <?php echo $this->Form->input('first_name',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">LAST NAME</label>
                         <?php echo $this->Form->input('last_name',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">ORGANIZATION NAME</label>
                        <?php echo $this->Form->input('organization_name',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'60','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">POSITION</label>
                        <?php echo $this->Form->input('position',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'60','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">PASSWORD:</label>
                        <?php echo $this->Form->input('password',array('type'=>'password','div'=>false,'label'=>false,'id'=>'pwd','maxlength'=>'15','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">CONFIRM PASSWORD:</label>
                        <?php echo $this->Form->input('confirm_password',
						array('type'=>'password','div'=>false,'label'=>false,'maxlength'=>'15','class'=>'text_style'));?>
                    </div>
                    <div class="clr"></div>
                    <div class="signup_form">
                    	<label name="name">ORGANIZATION TYPE:<br />
                        <span>(choose as many as you like)</span></label>
                        <ul>
                        	<?php
                            $i = 1;
                            foreach($service_types as $service_type):?>
                            <li <?php if($i == 1 || $i == 7)echo 'class="first"';?>>
                            	<input type="checkbox" id="c<?php echo $i;?>" name="data[ServiceType][ServiceType][]" value="<?php echo $service_type['ServiceType']['id'];?>" />
                                <label for="c<?php echo $i;?>" class="checkbox-label"><span><img alt="<?php echo $service_type['ServiceType']['name'];?>" src="<?php echo $this->webroot;?>img/<?php echo $service_type['ServiceType']['picture_url'];?>" /></span></label>
                            </li>                            
                            <?php
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
                                    <input type="button" name="submit" class="submit" />
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="clr"></div>
                    <div class="contact_form">
                    	<div class="submit_button">
                        <input type="submit" class="join_button cursor_grid" value='' />
						<div class="clr"></div>
                        <a href="<?php echo $this->webroot;?>">or Go Back</a>
                        </div>
                    </div>                  
               
            </div>            
            <div class="mt50"></div>           
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
        $("#user_signup").validate({
            rules: {
                        "data[User][email_id]": {
                         required: true,                        
                         'valid_email_id':true
                        },
                        "data[User][confirm_email]": {
                         required: true,
                         'valid_email_id':true,                         
                         equalTo:"#email_id"
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
                         "data[User][position]": {
                         'alpha':true,
                         required: true,
                         minlength:2,
                         maxlength:60
                         }, 
                         "data[User][password]": {
                         required: true,
                         minlength: 5,
                         maxlength:15
                         },
                        "data[User][confirm_password]": {
                        required: true,
                        minlength: 5,
                        maxlength:15,
                        equalTo: "#pwd"                                            
                        },
                        "data[ServiceType][ServiceType][]": {
                        required: true,
                        },
                    },
            messages:{
                    "data[User][email_id]": {
                            required: 'Please enter your email id',			  
			},
                         "data[User][confirm_email]": {
                            required: 'Please enter your confirm email id',                            
                            equalTo:"Please enter the same email for confirmation"
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
                          minlength:'Please enter atleast 2 characters',
                          maxlength:'Please enter maximum 60 characters'
                         },
                         "data[User][organization_name]": {
                            required: 'Please enter your organization name',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 60 characters'
                         },
                         "data[User][position]": {
                            required: 'Please enter your position in your organization',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 60 characters'
                         }, 
                         "data[User][password]": {
                            required: 'Please enter your password',
                            minlength: 'Your password must be at least 5 characters long',
                            maxlength:'Please enter maximum 15 characters'
                         },
                        "data[User][confirm_password]": {
                            required: 'Please enter your confirm password',
                            minlength: 'Your password must be at least 5 characters long',
                            equalTo: "Please enter the same password for confirmation",
                            maxlength:'Please enter maximum 15 characters'
                        },
                        "data[ServiceType][ServiceType][]": {
                            required: 'Please select atleast one organization type ',
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
<?php
 }
 elseif($type == 'companies') {
?>
<style>
    label.error{ color: #FF0000;font-size: 12px;margin: -3px 0 5px 190px;text-align: left;text-transform: none;width: 100%;}
    ul label.error{left:-189px !important;position: absolute !important;top: 202px !important;color: #FF0000 !important;}
	#flashMessage{color: #FF0000;float: left;margin: 20px 0 0 236px;}
    </style>
<div class="container">
<?php echo $this->Form->create('User',array('id'=>'user_signup'));?>
<?php echo $this->Form->input('role',array('type'=>'hidden','value'=>$type));?>
        	<div class="section">
				<h1>REGISTER YOUR BUSINESS WITH SOCEANA</h1>
                <p>Soceana offers businesses the opportunity to utilize the thousands of volunteers that are actively engaging and making a difference every day on our platform.Business and companies have the unique ability to partner with nonprofits to make an impact on their community - and to a much a greater scale utilizing Soceana's functionality.</p>
                <?php echo $this->Session->flash(); ?>
            </div>
			<div class="mt50"></div>
			<div class="section">            	
                	<div class="contact_form">
                    	<label name="name">Email</label>
                        <?php echo $this->Form->input('email_id',array('type'=>'text','div'=>false,'label'=>false,'id' => 'email_id','maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">CONFIRM Email</label>
                        <?php echo $this->Form->input('confirm_email',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">FIRST NAME</label>
                       <?php echo $this->Form->input('first_name',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">LAST NAME</label>
                         <?php echo $this->Form->input('last_name',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">COMPANY NAME</label>
                        <?php echo $this->Form->input('organization_name',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'60','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">INDIVIDUAL POSITION</label>
                        <?php echo $this->Form->input('position',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'60','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">PASSWORD:</label>
                        <?php echo $this->Form->input('password',array('type'=>'password','div'=>false,'label'=>false,'id'=>'pwd','maxlength'=>'15','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">CONFIRM PASSWORD:</label>
                        <?php echo $this->Form->input('confirm_password',
						array('type'=>'password','div'=>false,'label'=>false,'maxlength'=>'15','class'=>'text_style'));?>
                    </div>
                    <div class="clr"></div>
                    <div class="signup_form">
                    	<label name="name">ORGANIZATION INTEREST <br />TYPE:<br />
                        <span>(for ogranizations that your compnay seeks to partner with)</span></label>
                        <ul>
                        	<?php
                            $i = 1;
                            foreach($service_types as $service_type):?>
                            <li <?php if($i == 1 || $i == 7)echo 'class="first"';?>>
                            	<input type="checkbox" id="c<?php echo $i;?>" name="data[ServiceType][ServiceType][]" value="<?php echo $service_type['ServiceType']['id'];?>" />
                                <label for="c<?php echo $i;?>" class="checkbox-label"><span><img alt="<?php echo $service_type['ServiceType']['name'];?>" src="<?php echo $this->webroot;?>img/<?php echo $service_type['ServiceType']['picture_url'];?>" /></span></label>
                            </li>                            
                            <?php
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
                                    <input type="button" name="submit" class="submit" />
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="clr"></div>
                    <div class="contact_form">
                    	<div class="submit_button">
                        <input type="submit" class="join_button cursor_grid" value='' />
						<div class="clr"></div>
                        <a href="<?php echo $this->webroot;?>">or Go Back</a>
                        </div>
                    </div>                  
               
            </div>            
            <div class="mt50"></div>           
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
        $("#user_signup").validate({
            rules: {
                        "data[User][email_id]": {
                         required: true,                        
                         'valid_email_id':true
                        },
                        "data[User][confirm_email]": {
                         required: true,
                         'valid_email_id':true,                         
                         equalTo:"#email_id"
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
                         "data[User][position]": {
                         'alpha':true,
                         required: true,
                         minlength:2,
                         maxlength:60
                         }, 
                         "data[User][password]": {
                         required: true,
                         minlength: 5,
                         maxlength:15
                         },
                        "data[User][confirm_password]": {
                        required: true,
                        minlength: 5,
                        maxlength:15,
                        equalTo: "#pwd"                                            
                        },
                        "data[ServiceType][ServiceType][]": {
                        required: true,
                        },
                    },
            messages:{
                    "data[User][email_id]": {
                            required: 'Please enter your email id',			  
			},
                         "data[User][confirm_email]": {
                            required: 'Please enter your confirm email id',                            
                            equalTo:"Please enter the same email for confirmation"
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
                          minlength:'Please enter atleast 2 characters',
                          maxlength:'Please enter maximum 60 characters'
                         },
                         "data[User][organization_name]": {
                            required: 'Please enter your Company name',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 60 characters'
                         },
                         "data[User][position]": {
                            required: 'Please enter your position in your Company',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 60 characters'
                         }, 
                         "data[User][password]": {
                            required: 'Please enter your password',
                            minlength: 'Your password must be at least 5 characters long',
                            maxlength:'Please enter maximum 15 characters'
                         },
                        "data[User][confirm_password]": {
                            required: 'Please enter your confirm password',
                            minlength: 'Your password must be at least 5 characters long',
                            equalTo: "Please enter the same password for confirmation",
                            maxlength:'Please enter maximum 15 characters'
                        },
                        "data[ServiceType][ServiceType][]": {
                            required: 'Please select atleast one organization interest type ',
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
<?php
 }
 else{
?>
<script type="text/javascript">
$(function() {
	$('#state').change(function(){
	 $('#state_select').html('<img src="<?php echo $this->webroot;?>img/loading.gif" id="emp_img">');	 
		 $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/get_cities',
                   data:{
                        state_id : $('#state').val()                       
                        },
                   success: function(data) { 
	     				$('#city_placeholder').html(data);                  
				   		$('#state_select').html('');						                        
                   }
              });
	});
});
</script>
<style>ul li label.error{left:54px;position: absolute; top: 574px;width: 500px;}</style>
<style>
    label.error{ color: #FF0000;font-size: 12px;margin: -3px 0 5px 190px;text-align: left;text-transform: none;width: 100%;}
    ul label.error{left: -189px;position: absolute;top: 209px;width: 500px;}
    #flashMessage{color: #FF0000;float: left;margin: 20px 0 0 236px;}
    </style>
<div class="container">
<?php echo $this->Form->create('User',array('id'=>'user_signup'));?>
<?php echo $this->Form->input('role',array('type'=>'hidden','value'=>$type));?>
        	<div class="section">
				<h1>CREATE YOUR FREE SOCEANA ACCOUNT</h1>
                <p>Soceana allows you to connect with organizations around the nation so you can do good, wherever and whenever. Registering with Soceana takes under five minutes and is (and always will be) free.</p>                
            </div><?php echo $this->Session->flash(); ?>
			<div class="mt50"></div>
			<div class="section">            	 
                	<div class="contact_form">
                    	<label name="name">Email</label>
                         <?php echo $this->Form->input('email_id',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">FIRST NAME</label>
                         <?php echo $this->Form->input('first_name',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>                  
                    <div class="contact_form">
                    	<label name="name">LAST NAME</label>
                        <?php echo $this->Form->input('last_name',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">Address</label>
                        <?php echo $this->Form->input('location',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'60','class'=>'text_style'));?>
                    </div> 
                     <div class="contact_form">
                    	<label name="name">Country :</label>
        				<?php echo $this->Form->input('country',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => array(1 =>'United States of America'),'id'=>'country'));?>
                    </div> 
                     <div class="contact_form">
                    	 <label name="name">State : </label>
        				<?php echo $this->Form->input('state',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => $states ,'empty' => 'Select State','default' => 'empty','id'=>'state'));?>
                        <span id='state_select' style='margin-left:10px;'></span> 
                    </div> 
                     <div class="contact_form" id='city_placeholder'>
                    	 <label name="name">City :</label>
        <?php 
					  echo $this->Form->input('city',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => array() ,'empty' => 'Select City','default' => 'empty','id'=>'city'));?>
                    </div>                  
                   <div class="contact_form">
                    	<label name="name">PASSWORD:</label>
                         <?php echo $this->Form->input('password',array('type'=>'password','div'=>false,'label'=>false,'id'=>'pwd','maxlength'=>'15','class'=>'text_style'));?>
                    </div>
                   <div class="contact_form">
                    	<label name="name">CONFIRM PASSWORD:</label>
                        <?php echo $this->Form->input('confirm_password',
						array('type'=>'password','div'=>false,'label'=>false,'maxlength'=>'15','class'=>'text_style'));?>
                    </div>                 
                   <div class="clr"></div>
                   <div class="mt20"></div>
                   <div class="volunteer_signup_form">
                    	<label name="name">VOLUNTEER TYPE:<br />
                        <span>(choose as many as you like)</span></label>
                        <ul>
                            <?php
                            $i = 1;
                           // pr($this->request->data);
                            foreach($service_types as $service_type):?>
                            <li <?php if($i == 1 || $i == 7)echo 'class="first"';?>>
                                <input type="checkbox" id="c<?php echo $i;?>" name="data[ServiceType][ServiceType][]" value="<?php echo $service_type['ServiceType']['id'];?>" <?php
                                if(isset($this->request->data['ServiceType']['ServiceType'])){
                                     if(in_array($service_type['ServiceType']['id'], $this->request->data['ServiceType']['ServiceType'])) {
                                        echo "checked='checked'";
                                    } 
                                }
                               ?>/>
                                <label for="c<?php echo $i;?>" class="checkbox-label"><span><img alt="<?php echo $service_type['ServiceType']['name'];?>" src="<?php echo $this->webroot;?>img/<?php echo $service_type['ServiceType']['picture_url'];?>" /></span></label>
                            </li>                            
                            <?php
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
                                    <input type="button" name="submit" class="submit2" />
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div id='checkbox_error'></div>
                    </div>
                    <div class="clr"></div>
                    <div class="contact_form">
                    	<div class="submit_button">                        
                        <input type="submit" class="join_button2 cursor_grid" value='' />
						<div class="clr"></div>
                        <a href="<?php echo $this->webroot;?>">or Go Back</a>
                        </div>
                    </div>                   
            
            </div>            
            <div class="mt50"></div>           
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
        $("#user_signup").validate({
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
                          required:true,
                          minlength:2,
                          maxlength:60
                         },
						 "data[User][state]": {                         
                          required: true,
                         },
						 "data[User][city]": {                         
                         required: true,
                         },
                         "data[User][password]": {
                         required: true,
                         minlength: 5,
                         maxlength: 15
                         },
                        "data[User][confirm_password]": {
                        required: true,
                        minlength: 5,
                        maxlength:15,
                        equalTo: "#pwd"                                            
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
                         "data[User][password]": {
                            required: 'Please enter your password',
                            minlength: 'Your password must be at least 5 characters long',
                            maxlength:'Please enter maximum 15 characters'
                         },
                         "data[User][location]": {
                            required: 'Please enter your location',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 60 characters'
                         }, 
						  "data[User][state]": {
                            required: 'Please select your state'                         
                         },
						 "data[User][city]": {
                            required: 'Please enter your city'
                         },                        
                        "data[User][confirm_password]": {
                            required: 'Please enter your confirm password',
                            minlength: 'Your password must be at least 5 characters long',
                            maxlength:'Please enter maximum 15 characters',
                            equalTo: "Please enter the same password for confirmation",                                            
                        },
                        "data[ServiceType][ServiceType][]":{
                            required:'Please select atleast 1 volunteer type',
                        }
                },
            errorElement: 'label',
            errorClass: 'error help-block',
            errorPlacement: function(error, element){
                if(element.is('input[type="checkbox"]')){
                    error.insertAfter(element.parent().parent());
                } else {
                    error.insertAfter(element);
                }
            },
               
        });                    
});
</script>
<?php
 }
 ?>