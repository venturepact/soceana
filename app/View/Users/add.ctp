<?php echo $this->Html->script('jquery.validate');?>
<?php echo $this->Form->create('User',array('id'=>'user_signup'));?>
<?php echo $this->Form->input('role',array('type'=>'hidden','value'=>$type));?>
<div class="profile_content_left">    
        <div class="main_heading_gray">Sign Up for Soceana</div>
              <div class="sub_heading">
                <?php
                if($type == 'organizations') echo 'New Organization'; else echo 'New Volunteer';
                ?>
                </div>
            <?php
            if($type == 'organizations') {
               ?>
               <table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td align="left">&nbsp;</td>
                <td colspan="3" align="left">&nbsp;</td>
              </tr>
              <tr>
                    <td width="26%" align="left">Email:</td>
                    <td colspan="3" align="left"><label for="textfield"></label>
                        <?php echo $this->Form->input('email_id',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','id' => 'email_id'));?>
                    </td>
                </tr>
                <tr>
                    <td width="26%" align="left">Confirm Email:</td>
                    <td colspan="3" align="left"><label for="textfield"></label>
                        <?php echo $this->Form->input('confirm_email',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                </tr>
                <tr>
                    <td align="left">First Name:</td>
                    <td colspan="3" align="left"><label for="textfield2"></label>
                        <?php echo $this->Form->input('first_name',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left">Last Name:</td>
                    <td colspan="3" align="left"><label for="textfield2"></label>
                        <?php echo $this->Form->input('last_name',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left">Organization Name:</td>
                    <td colspan="3" align="left"><label for="textfield3"></label>
                        <?php echo $this->Form->input('organization_name',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                  </tr>
                    <tr>
                    <td align="left">Position:</td>
                    <td colspan="3" align="left"><label for="textfield3"></label>
                        <?php echo $this->Form->input('position',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left">Password:</td>
                    <td colspan="3" align="left">
                        <?php echo $this->Form->input('password',array('type'=>'password','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','id'=>'pwd'));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left">Confirm Password:</td>
                    <td colspan="3" align="left">
                        <?php echo $this->Form->input('confirm_password',array('type'=>'password','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">Organization Type</td>
                    <td colspan="3" align="left"><label for="textarea"></label>                     
                       <?php  echo $this->Form->input('ServiceType',array(
                            'type' => 'select',
                            'multiple' => 'checkbox',
                            'options' => $service_type,
                            'div'=>false,
                            'label'=>false
                        ));           
                    ?>
                   </td> 
                  </tr>
                  <tr>
                    <td align="left">&nbsp;</td>
                    <td width="26%" align="left">&nbsp;</td>
                    <td width="10%" align="left">&nbsp;</td>
                    <td width="38%" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left" style="padding-left:45px;">
                  <?php echo $this->Form->input('',array('id'=>'sbmt','type'=>'submit','label'=>false,'div'=>false,'class'=>'sign'));?>                    
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left">&nbsp;</td>
                  </tr>
              </table>
            <?php
            }
            else{
             ?>
           <table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td align="left">&nbsp;</td>
                <td colspan="3" align="left">&nbsp;</td>
              </tr>
              <tr>
                    <td width="26%" align="left">Email:</td>
                    <td colspan="3" align="left"><label for="textfield"></label>
                        <?php echo $this->Form->input('email_id',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                </tr>
                  <tr>
                    <td align="left">First Name:</td>
                    <td colspan="3" align="left"><label for="textfield2"></label>
                        <?php echo $this->Form->input('first_name',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left">Last Name:</td>
                    <td colspan="3" align="left"><label for="textfield2"></label>
                        <?php echo $this->Form->input('last_name',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left">Location:</td>
                    <td colspan="3" align="left"><label for="textfield3"></label>
                        <?php echo $this->Form->input('location',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left">Password:</td>
                    <td colspan="3" align="left">
                        <?php echo $this->Form->input('password',array('type'=>'password','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','id'=>'pwd'));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left">Confirm Password:</td>
                    <td colspan="3" align="left">
                        <?php echo $this->Form->input('confirm_password',array('type'=>'password','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">Volunteer Type</td>
                    <td colspan="3" align="left"><label for="textarea"></label>                     
                       <?php  echo $this->Form->input('ServiceType',array(
                            'type' => 'select',
                            'multiple' => 'checkbox',
                            'options' => $service_type,
                            'div'=>false,
                            'label'=>false
                        ));?>
                   </td>
                  </tr>
                  <tr>
                    <td align="left">&nbsp;</td>
                    <td width="26%" align="left">&nbsp;</td>
                    <td width="10%" align="left">&nbsp;</td>
                    <td width="38%" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left" style="padding-left:45px;">
                    <?php echo $this->Form->input('',array('id'=>'sbmt','type'=>'submit','label'=>false,'div'=>false,'class'=>'sign'));?>                    
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left">&nbsp;</td>
                  </tr>
              </table>

            <?php    
            }
            ?></div>
<?php echo $this->Form->end();?>
<?php
    if($type == 'organizations') {
?>
<script type='text/javascript' language='javascript'>
$().ready(function() {            
        // validate signup form on keyup and submit
        $("#user_signup").validate({

            rules: {
                        "data[User][email_id]": {
                         required: true,
                         email: true
                        },
                        "data[User][confirm_email]": {
                         required: true,
                         email: true,
                         equalTo:"#email_id"
                         },
                         "data[User][first_name]": {
                         required: true,
                         },
                         "data[User][last_name]": {
                         required: true,
                         },
                         "data[User][organization_name]": {
                         required: true,
                         },
                         "data[User][position]": {
                         required: true,
                         }, 
                         "data[User][password]": {
                         required: true,
                         minlength: 5
                         },
                        "data[User][confirm_password]": {
                        required: true,
                        minlength: 5,
                        equalTo: "#pwd"                                            
                        },
                        "data[ServiceType][ServiceType][]": {
                        required: true,
                        },
                    },
            messages:{
                    "data[User][email_id]": {
                            required: 'Please enter your email id',
			    email: 'Please provide a valid email id'
			},
                         "data[User][confirm_email]": {
                            required: 'Please enter your confirm email id',
                            email: 'Please enter a valid email id',
                            equalTo:"Please enter the same email for confirmation"
                         },
                        "data[User][first_name]": {
                            required: 'Please enter your first name',
                         },
                         "data[User][last_name]": {
                            required: 'Please enter your last name',
                         },
                         "data[User][organization_name]": {
                            required: 'Please enter your organization name',
                         },
                         "data[User][position]": {
                            required: 'Please enter your position in your organization',
                         }, 
                         "data[User][password]": {
                            required: 'Please enter your password',
                            minlength: 'Your password must be at least 5 characters long',
                         },
                        "data[User][confirm_password]": {
                            required: 'Please enter your confirm password',
                            minlength: 'Your password must be at least 5 characters long',
                            equalTo: "Please enter the same password for confirmation",                                            
                        },
                        "data[ServiceType][ServiceType][]": {
                            required: 'Please select atleast one organization type ',
                        }
            }  
                                   
        });                    
});
</script>
 <?php           
    }
    else
    {
  ?>
<script type='text/javascript' language='javascript'>
$().ready(function() {            
        // validate signup form on keyup and submit
        $("#user_signup").validate({

            rules: {
                        "data[User][email_id]": {
                         required: true,
                         email: true
                        },
                        "data[User][first_name]": {
                         required: true,
                         },
                         "data[User][last_name]": {
                         required: true,
                         },
                         "data[User][password]": {
                         required: true,
                         minlength: 5
                         },
                        "data[User][confirm_password]": {
                        required: true,
                        minlength: 5,
                        equalTo: "#pwd"                                            
                        },
                        "data[ServiceType][ServiceType][]": {
                        required: true,
                        }
                        
                    }
                    ,
                messages:{
                    "data[User][email_id]": {
                            required: 'Please enter your email id',
			    email: 'Please provide a valid email id'
			},                         
	                "data[User][first_name]": {
                            required: 'Please enter your first name',
                         },
                         "data[User][last_name]": {
                            required: 'Please enter your last name',
                         },                       
                         "data[User][password]": {
                            required: 'Please enter your password',
                            minlength: 'Your password must be at least 5 characters long',
                         },
                        "data[User][confirm_password]": {
                            required: 'Please enter your confirm password',
                            minlength: 'Your password must be at least 5 characters long',
                            equalTo: "Please enter the same password for confirmation",                                            
                        },
                        "data[ServiceType][ServiceType][]": {
                            required: 'Please select atleast one volunteer type',
                        }
            }                                        
        });                    
});
</script>
<?php
}
?>   
