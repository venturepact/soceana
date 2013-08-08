<style>
    #change_pwd label.error{float:left;}
    #change_pwd input{outline: none;}
</style>
<?php echo $this->Html->script('jquery.validate');?>
<div class="profile_content_left">
    <div class="main_heading_gray">CHANGE PASSWORD</div>
	<?php echo $this->Form->create('User',array('id'=>'change_pwd'));?>
            <table width="100%" border="0" cellspacing="5" cellpadding="0">
                <tr>
                    <td width="15%" align="left">Current Password :</td>
                    <td colspan="3" align="left"><label for="textfield"></label>
                        <?php echo $this->Form->input('old_password',array('type'=>'password','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                </tr>
                <tr>
                    <td align="left">New Password :</td>
                    <td width="39%" align="left">
                        <?php echo $this->Form->input('password',array('type'=>'password','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','id'=>'pwd'));?>
                    </td>
                </tr>
                <tr>
                    <td align="left">Confirm Password :</td>
                    <td width="39%" align="left">
                        <?php echo $this->Form->input('confirm_password',array('type'=>'password','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="left">
			<?php echo $this->Form->input('Change Password',array('id'=>'button2','type'=>'submit','value'=>"Update",'label'=>false,'div'=>false,'class'=>'submit_bnt'));?>
		    </td>
                </tr>                 
              </table>
	    <?php echo $this->Form->end();?>
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
</div>