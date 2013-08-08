<link type="text/css" href="<?php echo $this->webroot;?>js/datepicker/jquery.datepick.css" rel="stylesheet">
<?php echo $this->Html->script('jquery.validate');?>
<?php echo $this->Html->script('datepicker/jquery.datepick');?>
<script type="text/javascript">
$(function() {
    $('#job_date').datepick({dateFormat: 'yyyy-mm-dd',yearRange: "-80:+0", maxDate: '0'});
    $('#volunteer').change(function(){
	var volunteer_id = $('#volunteer').val();
	if (volunteer_id == '') {
		$('#volunteer_email').html('');
		$('#volunteer').focus();
		alert('Please select volunteer first');		
	}
	else{
		$('#volunteer_select').html('<img src="<?php echo $this->webroot;?>img/loading.gif">');
		$.ajax({
			type: "POST",
			url: <?php echo $this->webroot;?> + 'loghours/getVolunteerEmail/' + volunteer_id,
			data: volunteer_id,
			success: function(data) {//alert('here');
				$('#volunteer_email').html(data);
				$('#volunteer_select').html('');
		}
		});	
	}
    });	
});
</script>
<style>
  .radio_list{padding: 15px 0;}
  .radio {width: 200px;float:left;margin:3px;}
  .radio label{margin:5px;}
</style>
<?php echo $this->Form->create('LogHour',array('id'=>'add_loghour'));?>
<div class="profile_content_left">
  <div class="main_heading_gray">hours log</div>
    <table width="100%" border="0" cellspacing="5" cellpadding="0">
      <tr>
	<td>Volunteer Name</td>
	<td><?php echo $this->Form->input('user_id',array(
							       'type' => 'select',
							       'div' => false,
							       'label' => false,
							       'style' => 'width:250px;',
							       'options' => $users,
							       'empty' => 'Select Volunteer',
							       'default' => 'empty',
							       'id' => 'volunteer'
							       ));?>
	</td>
	<td id='volunteer_select'></td>
      </tr>
      <tr>
	<td id='volunteer_email' colspan='4'></td>
      </tr>      
      <tr>
        <td align="left">Position:</td>
        <td colspan="3" align="left"><label for="textfield2"></label>
          <?php echo $this->Form->input('position',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','maxlength'=>'50'));?></td>
      </tr>
      <tr>
        <td align="left">Location:</td>
        <td colspan="3" align="left"><label for="textfield3"></label>
          <?php echo $this->Form->input('location',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','maxlength'=>'50'));?></td>
      </tr>
      <tr>
        <td align="left">Hours:</td>
        <td align="left"><?php echo $this->Form->input('hours',array('type'=>'text','div'=>false,'label'=>false,'class'=>'input','id' => 'email_id','maxlength'=>'50'));?></td>
        <td align="left">Date:</td>
        <td align="left"><?php echo $this->Form->input('job_date',array('type'=>'text','div'=>false,'label'=>false,'class'=>'input','placeholder'=>'YYYY-MM-DD','id'=>'job_date'));?>
        </td>
      </tr>
      <tr>
        <td align="left" valign="top" class='radio_list'>Volunteer Type:</td>
        <td colspan="3" align="left" class='radio_list'>
        <?php echo $this->Form->input('service_type_id',array(
                'type' => 'radio',
		'before' => '<div class="radio">',
		'after' => '</div>',		
		'separator'=>'</div><div class="radio">',
                'options' => $service_type,               
                'fieldset'=>false,
                'legend'=>false,               
                'div'=>false,                
        ));?></td>
      </tr>
      <tr>
        <td align="left">Additional<br />
        Notes</td>
        <td colspan="3" align="left"><label for="textarea"></label>
        <?php echo $this->Form->input('additional_notes',array('type'=>'textarea','div'=>false,'label'=>false,'rows' => '5','cols'=>'45'));?>
	</td>
      </tr>
      <tr>
        <td align="left">&nbsp;</td>
        <td width="37%" align="left">&nbsp;</td>
        <td width="10%" align="left">&nbsp;</td>
        <td width="38%" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td align="left">Share: </td>
        <td align="left"><img src="<?php echo $this->webroot;?>img/fb.jpg" width="32" height="31" /> <img src="<?php echo $this->webroot;?>img/twitter.jpg" width="32" height="31" /> <img src="<?php echo $this->webroot;?>img/in.jpg" width="32" height="31" /></td>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="left">                  
          <?php echo $this->Form->input('Submit',array('id'=>'button2','type'=>'submit','value'=>"Submit",'label'=>false,'div'=>false,'class'=>'submit_bnt'));?>
	  <!--<a href="page7.1- volunteer_invite_organization.html" id="various3"><img src="<?php echo $this->webroot;?>img/submit_btn.jpg" width="340" height="44" /></a>-->
        </td>
      </tr>
      <tr>
        <td colspan="4" align="left">&nbsp;</td>
      </tr>
  </table>
  </div>
  <?php echo $this->Form->end();?>      