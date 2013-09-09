<style>
    label.error{ color: #FF0000 !important;font-size: 12px !important;margin: -3px 0 5px 185px !important;text-align: left !important;text-transform: none !important;width: 100% !important;}
    ul label.error{left: -175px;position: absolute;top: 406px;width: 500px;}
    .vol_table .signup_form ul{position: relative;}
    #flashMessage{color: #FF0000;float: left;margin: 20px 0 0 236px;}
    </style>
<link type="text/css" href="<?php echo $this->webroot;?>js/datepicker/jquery.datepick.css" rel="stylesheet">
<?php echo $this->Html->script('jquery.validate');?>
<?php echo $this->Html->script('datepicker/jquery.datepick');?>
<script type="text/javascript">
$(function() {
    $('#job_date').datepick({dateFormat: 'yyyy-mm-dd',yearRange: "-80:+0", maxDate: '0'});
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
         <h1>LOG HOURS</h1>
          <h3>Enter your volunteer hours and other details to Soceana, and we contact your organizations to verify your hours.</h3>
            
           </div>     
       
     <div class="wrapper_left_section">
         
         
       <!--table-->
       <div class="vol_table">                        
           
         <div class="section">
            <?php echo $this->Form->create('LogHour',array('id'=>'add_loghour'));?>
               <div class="signup_form">
                 <label name="name">Organization Name</label>
                 <?php echo $this->Form->input('organization',array(
							       'type' => 'select',
							       'div' => false,
							       'label' => false,
							       'options' => $organizations,
							       'empty' => 'Select Organization',
							       'default' => 'empty',
							       'id' => 'organization',
							       'style'=>'float:left;margin: 0 0 11px;'
								   ,'class'=>'text_style'
							       ));?>
               <span id='org_select' style='float: left;'></span> 
	       </div>
	       
               <div id="organisation_email" class="signup_form">
		
	       </div>
	       
               <div class="signup_form" >
                 <label name="name">Full Name</label>
                 <?php echo $this->Form->input('full_name',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','readonly'=>'readonly','class'=>'text_style'));?>
                 </div>             
             
               <div class="signup_form">
                 <label name="name">Email</label>
                <?php echo $this->Form->input('email',array('type'=>'text','div'=>false,'label'=>false,'id' => 'email_id','maxlength'=>'50','readonly'=>'readonly','class'=>'text_style'));?>
               </div>
               <div class="signup_form">
                 <label name="name">Position</label>
                  <?php echo $this->Form->input('position',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'75','class'=>'text_style'));?>
               </div>
               <div class="signup_form">
                 <label name="name">Location:</label>
                  <?php echo $this->Form->input('location',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'100','class'=>'text_style'));?>
               </div>
               <div class="clr"></div>
               <div class="mt20"></div>
               <div class="map">
                 <img src="<?php echo $this->webroot;?>img/map.png" alt="map" />
               </div>
               <div class="clr"></div>
              
               <div class="signup_form">
                 <label name="name">Hours</label>
                 <?php echo $this->Form->input('hours',array('type'=>'text','div'=>false,'label'=>false,'id' => 'email_id','maxlength'=>'2','class'=>'text_style'));?>
               </div>
               <div class="clr"></div>
               <div class="signup_form">
                 <label name="name">Date</label>
                 <?php echo $this->Form->input('job_date',array('type'=>'text','div'=>false,'label'=>false,'placeholder'=>'YYYY-MM-DD','id'=>'job_date','class'=>'text_style'));?>
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
							       'default' => 'empty',	
								   'class'=>'text_style'						       
		 ));?>
               </div>
               
               
               <div class="clr"></div>
	       <div class="signup_form">
                 <label name="name">Additional</label>                 
		<?php echo $this->Form->input('additional_notes',array('type'=>'textarea','div'=>false,'label'=>false,'rows' => '5','cols'=>'45','class'=>'text_style'));?>
               </div>
               
               
               <div class="clr"></div>
               <div class="mt20"></div>
               <div class="signup_form">
                 <label name="name">VOLUNTEER TYPE:<br />
                   <span>(choose only one)</span></label>
                 <ul>
                   <?php
                            $i = 1;
			    $k = 0;
			  //  pr($service_types);die;
                            foreach($service_types as $service_type):?>
                            <li <?php if($k==0)echo 'class="first"';?>>
                            	<input type="checkbox" id="c<?php echo $i;?>" name="data[LogHour][service_type_id]" value="<?php echo $service_type['ServiceType']['id'];?>" />
                                <label for="c<?php echo $i;?>" class="checkbox-label"><span><img alt="<?php echo $service_type['ServiceType']['name'];?>" src="<?php echo $this->webroot;?>img/<?php echo $service_type['ServiceType']['picture_url'];?>" /></span></label>
                            </li>                            
                            <?php
                            $i++;
			    $k++;
			    if($k==3)$k=0;
                            endforeach;
                            ?>                            
                   <li>
                     <div class="grey">
                       <label>Other ( Please Describe )</label>
                       <textarea></textarea>
                       <div class="input">
                         <input type="button" name="cancel" class="cancel"/>
                         </div>
                       <div>
                         <input type="button" name="submit" class="submit2" />
                         </div>
                       </div>
                     </li>
                   </ul>
                 </div>
               <div class="clr"></div><div class="mt20"></div>
               <div class="signup_form">
                 <label name="name">ADD PHOTOS:<br />
                   <span>(choose only one)</span></label>
                 <ul>
                   <li class="first">
                     <span><img src="<?php echo $this->webroot;?>img/hands.png" /></span>
                     </li>
                   <li><span><img src="<?php echo $this->webroot;?>img/add.png" /></span>
                     </li>
                   <li><span><img src="<?php echo $this->webroot;?>img/add.png" /></span>
                     </li>
                   </ul>
                 </div>
               <div class="clr"></div>
               
               
               <div class="contact_form">
                 <div class="submit_button">
                   <input type="submit" class="submit_button3 cursor_grid" value='' />
                   <div class="clr"></div>
                   or <a href="#">Cancel</a>
                   </div>
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
                        "data[LogHour][organization]": {
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
			maxlength:1
                        },
			"data[LogHour][category_id]":{
			required:true,
			
			}			
                    }
                    ,
                messages:{
                        "data[LogHour][organization]": {
                            required: 'Please select organization',
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
			    maxlength:'Please select only one volunteer type'
                        },
			"data[LogHour][category_id]":{
			    required:'Please select category',	
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
           	  <div class="profile">
          		
          
          
          
          <div class="profile_top">                        
               <div class="table_head_dark">
                  <div class="t_col_1 right_border"><h6>CATEGORY</h6></div>
                    <div class="t_col_2 right_border"><h6>TYPE </h6></div>
                      <div class="t_col_3 right_border"><h6>VOLUNTEER</h6></div>
                        <div class="t_col_4"><h6>HRS.</h6></div>
                        
                   </div>
                     
    <div class="table_head_light">
                <div class="t_col_1 box_border"><span class="gray_text">Hospital</span></div>
                  <div class="t_col_2 box_border"><span class="gray_text">Emergency</span></div>
                    <div class="t_col_3 box_border"><span class="gray_text">Andrew </span></div>
                      <div class="t_col_4 box_border"><span class="gray_text">7</span></div>
                        
                 </div> 
     <div class="table_head_light">
               <div class="t_col_1 box_border"><span class="gray_text">Hospital</span></div>
                  <div class="t_col_2 box_border"><span class="gray_text">Emergency</span></div>
                    <div class="t_col_3 box_border"><span class="gray_text">Andrew </span></div>
                      <div class="t_col_4 box_border"><span class="gray_text">7</span></div>
                        
                 </div>   
        <div class="table_head_light">
               <div class="t_col_1 box_border"><span class="gray_text">Hospital</span></div>
                  <div class="t_col_2 box_border"><span class="gray_text">Emergency </span></div>
                    <div class="t_col_3 box_border"><span class="gray_text">Andrew </span></div>
                      <div class="t_col_4 box_border"><span class="gray_text">7</span></div>
                         
                 </div>  
       <div class="table_head_light">
               <div class="t_col_1 box_border"><span class="gray_text">Hospital</span></div>
                  <div class="t_col_2 box_border"><span class="gray_text">Emergency </span></div>
                    <div class="t_col_3 box_border"><span class="gray_text">Andrew </span></div>
                      <div class="t_col_4 box_border"><span class="gray_text">7</span></div>
                         
                 </div>                                                                                           
              
              
   
   
     </div>
          
          
          
                       
                       
             </div>
             <div class="clr"></div>
             <div class="mt50"></div>
             <h1>SPONSORS</h1>
               <div class="sponser_outer">
                  <div class="sponser_inner"><h7> Sed ultricies volutpat tempor. Cras non lacus at enim venenatis hendrerit. Morbi lacus arcu, luctus sollicitudin molestie vulputate, sagittis eget quam. Praesent eget massa purus. Mauris fermentum ante quis mauris pretium, eu interdum metus fringilla. Curabitur lacinia vulputate tincidunt.</h7></div>
                     <div class="tip"></div>
        <div class="add_section">
            <div class="section1">
                <div class="black_text">
                     THE CHILDREN’S HOSPITAL
OF PHILADELPHIA
                      </div>
                    <div class="black_text_thin">3401 Civic Center Blvd. Philadelphia PA
(215) 590-1000</div> 
<a href="#" class="orange_butt">VOLUNTEER THROUGH SOCEANA</a> 
                 </div>
              <div class="section2"><img src="images/ch_image.png" alt="" /></div>
              </div>   
                     
           
                   </div>
                   <div class="add_img_outer"><img src="images/volunteer.png" width="350" alt="" />
                  
                 </div>
                   
                 <div class="sponser_outer">
                   <div class="sponser_inner"><h7> Sed ultricies volutpat tempor. Cras non lacus at enim venenatis hendrerit. Morbi lacus arcu, luctus sollicitudin molestie vulputate, sagittis eget quam. Praesent eget massa purus. Mauris fermentum ante quis mauris pretium, eu interdum metus fringilla. Curabitur lacinia vulputate tincidunt.</h7></div>
                     <div class="tip"></div>
        <div class="add_section">
            <div class="section1">
                <div class="black_text">
                 MANNA ON MAIN STREET
                      </div>
                    <div class="black_text_thin">713 W. Main Street. Lansdale PA
(215) 855-5454</div> 
<a href="#" class="orange_butt">VOLUNTEER THROUGH SOCEANA</a> 
                 </div>
              <div class="section2"><img src="images/main_steel_img.png" alt="" /></div>
              </div>   
                     
           
                   </div>   
                     
             </div>
             <a href="#" class="add_text">Advertise with Soceana</a>
               
         <div class="clr"></div>
               
        </div>     