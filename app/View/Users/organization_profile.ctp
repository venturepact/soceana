<?php echo $this->Html->script('jquery.validate');?>
          	<div class="profile_content_left">
           	  <div class="main_heading_gray">ORGANIZATION PROFILE</div>
		  <?php echo $this->Form->create('User',array('id'=>'organization_profile_update'));?>
                <table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td width="24%" align="left">Organization Name:</td>
                    <td colspan="3" align="left"><label for="textfield"></label>
                      <?php echo $this->Form->input('organization_name',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?></td>
                  </tr>
                  <tr>
                    <td align="left">Email:</td>
                    <td colspan="3" align="left"><label for="textfield2"></label>
                    <?php echo $this->Form->input('email_id',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">Organization Type:</td>
                    <td colspan="3" align="left">
		      <?php echo $this->Form->input('ServiceType',array(
                            'type' => 'select',
                            'multiple' => 'checkbox',
                            'options' => $service_type,
                            'div'=>false,
                            'label'=>false
                        ));?>
		    </td>
                  </tr>
                  <tr>
                    <td align="left">Location:</td>
                    <td colspan="3" align="left"><label for="textfield3"></label>
                      <?php echo $this->Form->input('location',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?></td>
                  </tr>
                  <tr>
                    <td align="left">Size:</td>
                    <td colspan="3" align="left">
		      <?php echo $this->Form->input('size',array(
								   'type'=>'select',
								   'div'=>false,
								   'label'=>false,
								   'options'=>array(
										    '9'=>'Below 10',
										    '10'=>'10 +',
										    '50'=>'50 +',
										    '100'=>'100 +',
										    '1000'=>'1000+'
										    ),
								   'style'=>'width:200px;'
			));?>
		     </td>
                  </tr>
                  <tr>
                    <td align="left">Phone #:</td>
                    <td colspan="3" align="left">
		      <?php echo $this->Form->input('phone',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?></td>
                  </tr>
                  <tr>
                    <td align="left">Mission and Vision:</td>
                    <td colspan="3" align="left"><label for="textfield5"></label>
                      <?php echo $this->Form->input('mission',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input'));?></td>
                  </tr>
                  <tr>
                    <td align="left">Additional<br />
                    Notes</td>
                    <td colspan="3" align="left"><label for="textarea"></label>
                    <?php echo $this->Form->input('additional_notes',array('type'=>'textarea','div'=>false,'label'=>false,'style'=>'height:auto !important;width:250px','class'=>'input','rows'=>10,'cols'=>30));?></td>
                  </tr>
                  <tr>
                    <td align="left">&nbsp;</td>
                    <td width="28%" align="left">&nbsp;</td>
                    <td width="10%" align="left">&nbsp;</td>
                    <td width="38%" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left">Connect:</td>
                    <td align="left"><img src="<?php echo $this->webroot;?>img/fb.jpg" width="32" height="31" /> <img src="<?php echo $this->webroot;?>img/twitter.jpg" width="32" height="31" /> <img src="<?php echo $this->webroot;?>img/in.jpg" width="32" height="31" /></td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left">
		      <?php echo $this->Form->input('Update',array('id'=>'button2','type'=>'submit','value'=>"Update",'label'=>false,'div'=>false,'class'=>'submit_bnt'));?>
		    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left">&nbsp;</td>
                  </tr>
              </table>
		 <?php echo $this->Form->end();?>
	    <script type='text/javascript' language='javascript'>
$().ready(function() {            
        // validate signup form on keyup and submit
        $("#user_profile_update").validate({

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
                        "data[ServiceType][ServiceType][]": {
                            required: 'Please select atleast one volunteer type',
                        }
            }                                        
        });                    
});
</script>
            </div>
           <div class="profile_content_right">
	    <?php
	  	if(strlen($this->request->data['User']['thumb_image']) > 0 ){
		    ?>
		<img src="<?php echo $this->webroot;?>img/upload/<?php echo $this->request->data['User']['thumb_image'];?>" width="171" height="170" id='prof_image' />
		<?php
		}
		else{
		    ?>
		<img src="<?php echo $this->webroot;?>img/organization_pic_large.jpg" width="171" height="170" />
		<?php
		}
		?>
   	    	  
             <p><a href="<?php echo $this->webroot;?>users/reposition_pic">Reposition</a><br />
              <span><a href='<?php echo $this->webroot;?>users/user_pic'>Change your profile image</a></span></p>
             	 <h3>About:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3><h4><a href="#">Edit</a></h4>
                 <div class="about_me">
                 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</div>
            </div>
          