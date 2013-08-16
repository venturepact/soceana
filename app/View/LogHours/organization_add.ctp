<style>
.radio label.error {margin: 124px -13px 0;position: absolute;}
.td_hour label.error {float:left;}
label.error{width:auto !important;}
</style>
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
		var new_url = "<?php echo $this->webroot;?>" + "loghours/getVolunteerEmail/" + volunteer_id;
		$('#volunteer_select').html('<img src="<?php echo $this->webroot;?>img/loading.gif">');
		$.ajax({
			type: "POST",
			url: new_url,
			data: volunteer_id,
			success: function(data) {
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
          <?php echo $this->Form->input('position',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','maxlength'=>'70'));?></td>
      </tr>
      <tr>
        <td align="left">Location:</td>
        <td colspan="3" align="left"><label for="textfield3"></label>
          <?php echo $this->Form->input('location',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','maxlength'=>'100'));?></td>
      </tr>
      <tr>
        <td align="left">Hours:</td>
        <td align="left" class='td_hour'><?php echo $this->Form->input('hours',array('type'=>'text','div'=>false,'label'=>false,'class'=>'input','maxlength'=>'2'));?></td>
        <td align="left">Date:</td>
        <td align="left"><?php echo $this->Form->input('job_date',array('type'=>'text','div'=>false,'label'=>false,'class'=>'input','placeholder'=>'YYYY-MM-DD','id'=>'job_date'));?>
        </td>
      </tr>
       <tr>
	<td>Category</td>
	<td><?php echo $this->Form->input('category_id',array(
							       'type' => 'select',
							       'div' => false,
							       'label' => false,
							       'style' => 'width:250px;',
							       'options' => $categories,
							       'empty' => 'Select Category',
							       'default' => 'empty',							       
							       ));?>
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
        <td align="left"><a href='https://www.facebook.com/' target='_blank'><img src="<?php echo $this->webroot;?>img/fb.jpg" width="32" height="31" /></a> <a href='https://www.twitter.com/' target='_blank'><img src="<?php echo $this->webroot;?>img/twitter.jpg" width="32" height="31" /></a><a href='https://www.linkedin.com/' target='_blank'><img src="<?php echo $this->webroot;?>img/in.jpg" width="32" height="31" /></a></td>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="left">                  
          <?php echo $this->Form->input('Submit',array('id'=>'button2','type'=>'submit','value'=>"Submit",'label'=>false,'div'=>false,'class'=>'submit_bnt'));?>	 
        </td>
      </tr>
      <tr>
        <td colspan="4" align="left">&nbsp;</td>
      </tr>
  </table>
  </div>
  <?php echo $this->Form->end();?>
   <script type='text/javascript' language='javascript'>    
$().ready(function() {
    
    //validation rule for only alphabets
    $.validator.addMethod("alpha", function(value) {
        return value == value.match(/^[a-zA-Z]*$/);    
    }, 'Please enter only alphabets for this field');    
    
    
        // validate signup form on keyup and submit
        $("#add_loghour").validate({
            rules: {
                        "data[LogHour][user_id]": {
                          required: true,                         
                        },
                        "data[LogHour][position]": {
                          required: true,
                          'alpha':true,
                          minlength:2,
                          maxlength:75
                         },
                         "data[LogHour][location]": {
                          required: true,                         
                          minlength:2,
                          maxlength:100
                         },                         
                         "data[LogHour][hours]": {
                         required: true,
                         digits: true,
			 range: [1 , 23]
                         },
                        "data[LogHour][job_date]": {
			required: true,
			dateISO:true
                        },
                        "data[LogHour][service_type_id]": {
                        required: true,
                        },
			"data[LogHour][category_id]":{
			required:true,	
			}
                    },
                messages:{
                        "data[LogHour][user_id]": {
                            required: 'Please select user',
			},                         
	                "data[LogHour][position]": {
                            required: 'Please enter your position',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 75 characters'
                         },                         
                         "data[User][location]": {
                            required: 'Please enter your location',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 100 characters'
                         },                         
                        "data[LogHour][hours]": {
                            required: 'Please enter your hours',
			    digits:'Please enter digits for hours'
                        },
			"data[LogHour][job_date]": {
                            required: 'Please enter your job date',
			    dateISO:'Please enter a valid date'
			   
                        },
                        "data[LogHour][service_type_id]": {
                            required: 'Please select atleast one volunteer type',
                        },
			"data[LogHour][category_id]":{
			    required:'Please select category',		
			}
                }                                        
        });                    
});
</script>