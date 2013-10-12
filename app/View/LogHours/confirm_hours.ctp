<link type="text/css" href="<?php echo $this->webroot;?>js/datepicker/jquery.datepick.css" rel="stylesheet">
<?php echo $this->Html->script('jquery.validate');?>
<?php echo $this->Html->script('datepicker/jquery.datepick');?>
<script type="text/javascript">
$(function() {
   // $('#job_date').datepick({dateFormat: 'yyyy-mm-dd',yearRange: "-80:+0", maxDate: '0'});
    $('#organization').change(function(){
	
	var organization_id = $('#organization').val();
	if (organization_id == '') {
		$('#organisation_email').html('');
		$('#organization').focus();
		alert('Please select organization first');
		
	}
	else{
		var new_url = "<?php echo $this->webroot;?>" + "loghours/getOrganizationEmail/" + organization_id;
		$('#org_select').html('<img src="<?php echo $this->webroot;?>img/loading.gif">');	
		$.ajax({
			type: "POST",
			url: new_url,
			data: organization_id,
			success: function(data) {//alert('here');
				$('#organisation_email').html(data);
				$('#org_select').html('');
		}
		});	
	}
    });	
});
</script>

<div class="top_heading">
           <h1>VERIFY HOURS</h1>
            <h3>View the hours submitted by volunteers and accept/reject them so they may be Soceana Certified.</h3>
            
             </div>
       
       
       <div class="wrapper_left_section">
           
        <h1>REVIEW VOLUNTEER CLAIM</h1>
 <!--table-->
    <div class="vol_table">                        
    
    <div class="section">
    
            	 <?php echo $this->Form->create('LogHour',array('id'=>'verify_loghour'));?>
                	<div class="signup_form">
                    	<label name="name">Email</label>
                        <?php echo $this->Form->input('email',array('type'=>'text','div'=>false,'label'=>false,'readonly'=>'readonly','class'=>'text_style'));?>
                    </div>
                   <div class="clr"></div>
                    <div class="signup_form">
                    	<label name="name">Full NAME</label>
                        <?php echo $this->Form->input('full_name',array('type'=>'text','div'=>false,'label'=>false,'readonly'=>'readonly','class'=>'text_style'));?>
                    </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>
                  <div class="signup_form">
                    	<label name="name">VOLUNTEER POSITION:</label>
                        <?php echo $this->Form->input('position',array('type'=>'text','div'=>false,'label'=>false,'readonly'=>'readonly','class'=>'text_style'));?>
                  </div>
                  <div class="clr"></div>
                  <div class="signup_form">
                    	<label name="name">ORGANIZATION:</label>
                        <?php echo $this->Form->input('organization',array('type'=>'text','div'=>false,'label'=>false,'readonly'=>'readonly','class'=>'text_style'));?>
                  </div>
                  <div class="signup_form">
                    	<label name="name">Location:</label>
                        <?php echo $this->Form->input('location',array('type'=>'text','div'=>false,'label'=>false,'readonly'=>'readonly','class'=>'text_style'));?>
                  </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>
                  <div class="map">
                    	<img src="<?php echo $this->webroot;?>img/map.png" alt="map" />
                  </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>
                  
                  <div class="signup_form">
                    	<label name="name">HOURS VOLUNTEERED:</label>
                        <?php echo $this->Form->input('hours',array('type'=>'text','div'=>false,'label'=>false,'readonly'=>'readonly','class'=>'text_style'));?>
                  </div>
                  <div class="clr"></div>
                  <div class="mt20"></div>
                  <div class="signup_form">
                    	<label name="name">DATE:</label>
                         <?php echo $this->Form->input('job_date',array('type'=>'text','div'=>false,'label'=>false,'placeholder'=>'YYYY-MM-DD','id'=>'job_date','class'=>'text_style','readonly'=>'readonly'));?>
                  </div>
                  <div class="clr"></div>
               <div class="signup_form">
                 <label name="name">Category</label>                 
		 <?php echo $this->Form->input('category_id',array(
							       'type' => 'select',
							       'div' => false,
							       'label' => false,
							       'options' => $categories,
							       'empty' => 'Select Category',							      
							       'class'=>'text_style',
								   'disabled'=>'disabled'						       
		 ));?>
               </div>
                  
                  
                   <div class="clr"></div>
                   <div class="mt20"></div>
                   <div class="signup_form_blue">
                    	<label name="name" class="label_size">VOLUNTEER TYPE:<br />
                        </label>
                        <ul>
                            <?php
                            $i = 1;
			    $k = 0;
			  //  pr($service_types);die;
                            foreach($service_types as $service_type):?>
                            <li <?php if($k==0)echo 'class="first"';?>>
                            	<input type="checkbox" id="c<?php echo $i;?>" name="data[LogHour][service_type_id]" value="<?php echo $service_type['ServiceType']['id'];?>" <?php  if($this->request->data['LogHour']['service_type_id'] == $service_type['ServiceType']['id']) echo 'checked="checked"';?> disabled="disabled" />
                                <label for="c<?php echo $i;?>" class="checkbox-label"><span><img alt="<?php echo $service_type['ServiceType']['name'];?>" src="<?php echo $this->webroot;?>img/<?php echo $service_type['ServiceType']['picture_url'];?>" /></span></label>
                            </li>                            
                            <?php
                            $i++;
			    $k++;
			    if($k==3)$k=0;
                            endforeach;
                            ?> 
                            <li class="last">
                            	<div class="grey">
                                	<label>Other ( Please Describe )</label>
                                	<textarea readonly="readonly"></textarea>
                                    <div class="input">
                                    <input type="button" name="cancel" class="cancel"/>
                                    </div>
                                    <div class="input_second_butt"  >
                                    <input type="button" name="submit" class="submit" />
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="clr"></div>
                    <div class="signup_form">
                    	<label name="name" class="label_size">PHOTOS:
                       </label>
                        <ul>
                      <?php
					    
					    if(sizeof($log_images) > 0){
							$j = 0;						
							foreach($log_images as $log_image){			
								?>
                                <li <?php if($j==0)echo 'class="first"';?>><span><img src="<?php echo $this->webroot;?>img/log_hours/<?php echo $log_image['LogHourImage']['picture_url'];?>" width="90" height="90" /></span>
                            </li>
                                <?php	
								$j++;							
							}	
							$extra = 3 - sizeof($log_images);
							for($i=1;$i<=$extra;$i++){
								?>
                                 <li><span><img src="<?php echo $this->webroot;?>img/add.png" /></span>
                                <?php								
							}
						}else{
							?>
                        	<li class="first">
                            	<span><img src="<?php echo $this->webroot;?>img/add.png" /></span>
                            </li>
                            <li><span><img src="<?php echo $this->webroot;?>img/add.png" /></span>
                            </li>
                            <li><span><img src="<?php echo $this->webroot;?>img/add.png" /></span>
                            </li>
                            <?php
						}
						?>
                        </ul>
                    </div>
                    <div class="clr"></div>
                    
                    
                    <div class="contact_form1">
                    	<div class="submit_button1 w35">
                        <?php
                        if($this->request->data['LogHour']['status'] == 0)
                        {
                        ?>
                        <a href="<?php echo $this->webroot;?>loghours/approve_hours/<?php echo $this->request->data['LogHour']['id'];?>" class="green_b" id='approve_hours'>CONFIRM HOURS<img src="<?php echo $this->webroot;?>img/butt_arrow.png"  alt="" class="butt_icon" /></a>
                        <a href="<?php echo $this->webroot;?>loghours/reject_hours/<?php echo $this->request->data['LogHour']['id'];?>" class="red_b" id='reject_hours'>REJECT</a>
                        <?php    
                        }
                        ?>                  
			<div class="clr"></div>
                        <div class="gray_link"><a href="<?php echo $this->webroot;?>loghours/review_hours" >or Go Back</a></div>
                        </div>
                        
                    </div>
                    
                <?php echo $this->Form->end();?>
            </div>         
    </div>          
           </div>
                    
            <div class="wrapper_mid_border"></div>
              
       <div class="wrapper_right_section">
          
          <div class="right_section_inner">  
             <h1>SPONSORS</h1>
             <?php echo $this->Sponsor->load_advertisements(); ?>
          </div>

               <a href="#" class="add_text">Advertise with Soceana</a>
               
           <div class="clr"></div>
               
           </div>
<script>
$(function() {
    $('#approve_hours').click(function() {
        return confirm('Are you sure you want to confim hours');
    });
	$('#reject_hours').click(function() {
        return confirm('Are you sure you want to reject hours');
    });
});
</script>