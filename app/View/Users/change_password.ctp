<?php echo $this->Html->script('jquery.validate');?>
<style>
.submit{margin: 2px 190px;float: left;}
label.error{color: #FF0000;float: none;font-size: 12px;margin-left: 5px;text-transform: none;width: 100%;}
</style>
<div class="container">
        	<div class="section">
				<h1>Change Password</h1>
                <p>Change Password for keeping the security of your account</p>
            </div>
			<div class="mt50"></div>
			<div class="section">
            	<?php echo $this->Form->create('User',array('id'=>'change_pwd'));?>
                	<div class="contact_form">
                    	<label name="name">Current Password</label>
                         <?php echo $this->Form->input('old_password',array('type'=>'password','div'=>false,'label'=>false,'class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">New Password</label>
                      <?php echo $this->Form->input('password',array('type'=>'password','div'=>false,'label'=>false,'id'=>'pwd','class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">Confirm Password</label>
                         <?php echo $this->Form->input('confirm_password',array('type'=>'password','div'=>false,'label'=>false,'class'=>'text_style'));?>
                    </div>                  
                     <div class="contact_form">
                    	<input type="submit" class="submit" value='' />
                    </div>
                    
                  <?php echo $this->Form->end();?>
            </div>
</div>
  <script type='text/javascript' language='javascript'>
$().ready(function() {            
        // validate signup form on keyup and submit
        $("#change_pwd").validate({

            rules: {
                       "data[User][old_password]": {
                            required: true,
                            minlength: 5,
			    maxlength:15
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
                        
                    }
                    ,
                messages:{
                        "data[User][old_password]": {
                            required: 'Please enter current password',
			     minlength: 'Your password must be at least 5 characters long',
                            maxlength:'Please enter maximum 15 characters'
			},                         
	                "data[User][password]": {
                            required: 'Please enter new password',
                            minlength: 'Your password must be at least 5 characters long',
                            maxlength:'Please enter maximum 15 characters'
                        },
                         "data[User][confirm_password]": {
                            required: 'Please enter confirm password',
                            minlength: 'Your password must be at least 5 characters long',
                            maxlength:'Please enter maximum 15 characters',
                            equalTo: 'Please enter the same password for confirmation'
                        },                        
            }                                        
        });                    
});
</script>