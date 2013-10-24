<?php echo $this->Form->create('User',array('id'=>'login_form2','action'=>'login','url'=>'#login_form2'));?>
<?php echo $this->Form->input('role',array('type'=>'hidden','value'=>'organizations|companies'));?>
<div class="user_name"><?php echo $this->Form->input('email_id',array('type'=>'text','placeholder'=>"Email Address",'label'=>false,'div'=>false,'id'=>'email_id','class'=>'text_style'));?></div>
<div class="clr"></div>
<div class="password"><?php echo $this->Form->input('password',array('type'=>'password','placeholder'=>"Password",'label'=>false,'div'=>false,'id'=>'pass','class'=>'text_style'));?></div>
                <div class="clr"></div>
                <div class="login_buttons">
                    <input type="submit" name="login" value=""  class="login_now cursor_grid" />
                    <input type="button" name="login" value="" class="sign_up cursor_grid" onclick="document.location.href='<?php echo $this->webroot;?>users/add/organizations';" />
                </div>
                <div class="clr"></div>
                <!--<div class="remember">
                     <input type="checkbox" id="c3" name="remeber" checked="checked" />
                     <label for="c3" class="checkbox-label"><span></span></label>
                     <label class="intern">Remember my password</label>
                    <a href="javascript:void(0);" class="forget_password pop">Forget Password?</a>
                </div>-->
		<div class="remember">
		     <input type="hidden" value="0" id="UserRememberMe_" name="data[User][rememberMe]">
             <input type="checkbox" id="c3" value="1" name="data[User][rememberMe]" />
             <label for="c3" class="checkbox-label"><span></span></label>
             <label class="intern">Remember Me</label>
                    <a href="javascript:void(0);" class="forget_password pop">Forgot Password?</a>
                </div>
                <div class="mb10">&nbsp;</div>
                <div class="clr"></div>
<?php echo $this->Form->end();?>
<script>
$().ready(function() {

//validation rule for valid email
    $.validator.addMethod("valid_email_id", function(value) {
        return value = value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);               
    }, 'Please enter a valid email id');
    
    
	// validate signup form on keyup and submit
	$("#login_form2").validate({
		rules: {
			"data[User][email_id]": {
				required: true,
				'valid_email_id': true
			},
			"data[User][password]": {
				required: true,
				minlength: 5,
                                maxlength:15
			},
			
		},
                messages:{
                    "data[User][email_id]": {
				required: 'Please enter your email address'				
			},
			"data[User][password]": {
				required: 'Please provide a password',
				 minlength: 'Your password must be at least 5 characters long',
                                maxlength:'Please enter maximum 15 characters'
			},
                }
		
	});
        
       // $('submit').unwrap();
        
    });
</script>
