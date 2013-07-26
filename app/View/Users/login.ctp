<?php echo $this->Html->script('jquery.validate');?>
<?php echo $this->Form->create('User',array('id'=>'login_form')); ?>
<p><?php echo $this->Form->input('email_id',array('type'=>'text','placeholder'=>"Email id",'label'=>false,'div'=>false,'id'=>'email_id'));?></p>
<p><?php echo $this->Form->input('password',array('type'=>'password','placeholder'=>"Password",'label'=>false,'div'=>false,'id'=>'pass'));?></p>
<p class='remember_me'>
    <label>
        <input type="checkbox" name="remember_me" id="remember_me">Remember me on this computer
    </label>    
</p>
<p class="forget-password"><a href="#" id="pop">Forget Password</a></p>
<p class="submit"><?php echo $this->Form->input('Login',array('id'=>'sbmt','type'=>'submit','value'=>"Login",'style'=>"margin-left:9px; margin-top:0px",'label'=>false,'div'=>false));?></p>
<?php echo $this->Form->end(); ?>
<script>
$().ready(function() {

	// validate signup form on keyup and submit
	$("#login_form").validate({
		rules: {
			"data[User][email_id]": {
				required: true,
				email: true
			},
			"data[User][password]": {
				required: true,
				minlength: 5
			},
			
		},
                messages:{
                    "data[User][email_id]": {
				required: 'Please enter your login id',
				email: 'Please provide a valid login id'
			},
			"data[User][password]": {
				required: 'Please provide a password',
				minlength: 'Your password must be at least 5 characters long'
			},
                }
		
	});
        
    });
</script>