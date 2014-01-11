<?php echo $this->Html->script('jquery.validate');?>
<script language="javascript" type="text/javascript">
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
<style>
@media only screen and (min-width : 320px) and (max-width : 479px) {
.signup_form_blue ul.left_margin label.error {
	left: 8px;
	top: 270px;
}
}
@media only screen and (min-width : 568px) and (max-width : 599px) {
.signup_form_blue ul.left_margin label.error {
	left: 5px;
	top: 305px;
}
}
ul.left_margin {
	position: relative;
	margin: 0 0 20px;
}
ul.left_margin label.error {
	color: #ff0000;
	position: absolute;
	margin-top: 5px;
	text-transform: none;
	top: 298px;
	width: auto;
	left: 0px;
}
</style>
<div class="top_heading">
  <h1>PERSONALIZE YOUR VOLUNTEERING EXPERIENCE</h1>
  <h3>Filter organizations based upon skill sets they are looking for, and contact them to do more good.</h3>
</div>
<div class="wrapper_left_section"> 
  
  <!--table-->
  <div class="vol_table">
    <div class="section">
	<?php echo $this->Form->create('User',array('id'=>'personalize'));?>
      <div class="signup_form_blue">
        <label name="name">SARCH SKILL SET :<br />
          <span>(choose maximum  3 )</span></label>
        <ul class="left_margin">
          <?php
			   $i = 1;
			   $k = 1;
               foreach($skill_sets as $skill_set):			    
			   			 ?>
          <li <?php if($k == 1) echo 'class="first"';?>>
            <input type="checkbox" id="a<?php echo $i;?>" name="data[SkillSet][SkillSet][]" value="<?php echo $skill_set['SkillSet']['id'];?>"
				<?php
                                if($this->request->is('post') || $this->request->is('put')){
				    if(isset($this->request->data['SkillSet']['SkillSet'])){
					if(in_array($skill_set['SkillSet']['id'], $this->request->data['SkillSet']['SkillSet'])) {
					   echo "checked='checked'";
				        } 
				    }
			        }
			        else{
				    if(isset($this->request->data['SkillSet'])){
					if(in_array($skill_set['SkillSet']['id'], $temp_skills)) {
					   echo "checked='checked'";
				        } 
				    }
			       }			        
                               ?>/>
            <label for="a<?php echo $i;?>" class="checkbox-label"><span><img alt="<?php echo $skill_set['SkillSet']['name'];?>" src="<?php echo $this->webroot;?>img/<?php echo $skill_set['SkillSet']['picture_url'];?>" /></span></label>
          </li>
          <?php
			    	if($k == 3) $k = 0;
			   		$k++;
                    $i++;
                    endforeach;
                    ?>
        </ul>
      </div>
      <div class="clr"></div>
      <div class="mt20"></div>
      <div class="signup_form">
        <label name="name">Country :</label>
        <?php echo $this->Form->input('country',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => array(1 =>'United States of America'),'id'=>'country'));?>
     </div>
      <div class="clr"></div>
      <div class="mt20"></div>
      <div class="signup_form">
        <label name="name">State : </label>
        <?php 
		 echo $this->Form->input('state',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => $states ,'empty' => 'Select State','default' => 'empty','id'=>'state'));?>
        <span id='state_select' style='float: right;'></span>
       </div>
      <div class="clr"></div>
      <div class="mt20"></div>
      <div class="signup_form" id='city_placeholder'>
        <label name="name">City :</label>
        <?php 
		echo $this->Form->input('city',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => array(),'empty' => 'Select City','default' => 'empty','id'=>'city'));?>
      </div>
      <div class="contact_form">
        <div class="submit_button1">
          <input type="submit" class="srch_btn" value="" />
        </div>
      </div>
   <?php echo $this->Form->end();?> 
      <script type='text/javascript' language='javascript'>
$().ready(function() {            
        // validate signup form on keyup and submit
        $("#personalize").validate({
            rules: {                                               
                        "data[SkillSet][SkillSet][]": {
                        required : true,
						maxlength:3
                        }                        
                    }
                    ,
                messages:{                             
                        "data[SkillSet][SkillSet][]": {
                            required : 'Please select atleast one skillset',
							maxlength: 'Please select maximum three skills'
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
    </div>
  </div>
</div>
<div class="wrapper_mid_border"></div>
<div class="wrapper_right_section">
  <div class="right_section_inner">
    <h1>SPONSORS</h1>
    <?php echo $this->Sponsor->load_advertisements(); ?> </div>
  <a href="javascript:void(0);" class="add_text">Advertise with Soceana</a>
  <div class="clr"></div>
</div>