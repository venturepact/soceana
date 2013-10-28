<style>
    label.error{ color: #FF0000 !important;font-size: 12px !important;margin: -3px 0 5px 185px !important;text-align: left !important;text-transform: none !important;width: 100% !important;}
    ul label.error{left: -175px;position: absolute;top: 406px;width: 500px;}
    .vol_table .signup_form ul{position: relative;}
    #flashMessage{color: #FF0000;float: left;margin: 20px 0 0 236px;}
	.form_input{float: left; width: 100%; margin-bottom: 10px;}
    .form_input label {
    float: left;
    font-size: 12px;
    text-transform: uppercase;
    width: 10%;
	}
    #response{color: #FF0000;margin:0 0 6px -31px;;text-align: center;}
</style>
<link type="text/css" href="<?php echo $this->webroot;?>js/datepicker/jquery.datepick.css" rel="stylesheet">
<?php echo $this->Html->script('jquery.validate');?>
<?php echo $this->Html->script('datepicker/jquery.datepick');?>
<script type="text/javascript">
$(function() {
    $('#job_date').datepick({dateFormat: 'mm-dd-yyyy',yearRange: "-80:+0", maxDate: '0'});
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
            <?php echo $this->Form->create('LogHour',array('id'=>'add_loghour','enctype'=>"multipart/form-data"));?>
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
                 <?php //echo $this->Form->input('hours',array('type'=>'text','div'=>false,'label'=>false,'id' => 'email_id','maxlength'=>'2','class'=>'text_style'));?>
		 <?php
		 for($i = 0;$i<24;$i++){
		    if($i<10){
			$hours["0$i"] = "0$i";
		    }
		    else $hours[$i] = $i;
		 }
		 
		 echo $this->Form->input('hours',array(
							       'type' => 'select',
							       'div' => false,
							       'label' => false,
							       'options' => $hours,
							       'empty' => 'Hours',
							       'default' => 'empty',	
							       'class'=>'text_style',
							       'style'=>'width:80px;'
		 ));?> - <?php
		 for($i = 0;$i<60;$i++){
		    if($i<10){
			$minutes["0$i"] = "0$i";
		    }
		    else $minutes[$i] = $i;
		 }
		 
		 echo $this->Form->input('minutes',array(
							       'type' => 'select',
							       'div' => false,
							       'label' => false,
							       'options' => $minutes,
							       'empty' => 'Minutes',
							       'default' => 'empty',	
							       'class'=>'text_style',
							       'style'=>'width:80px;'
		 ));?>
               </div>
               <div class="clr"></div>
               <div class="signup_form">
                 <label name="name">Date</label>
                 <?php echo $this->Form->input('job_date',array('type'=>'text','div'=>false,'label'=>false,'placeholder'=>'MM-DD-YYYY','id'=>'job_date','class'=>'text_style','readonly'=>'readonly'));?>
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
                       <textarea readonly="readonly"></textarea>
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
                 <label name="name">ADD PHOTOS:</label>
                 <ul>
                   <li class="first">
                     <span id='image_1'><img src="<?php echo $this->webroot;?>img/add.png" /></span>
                     </li>
                   <li><span id='image_2'><img src="<?php echo $this->webroot;?>img/add.png" /></span>
                     </li>
                   <li><span id='image_3'><img src="<?php echo $this->webroot;?>img/add.png" /></span>
                     </li>
                   </ul>
                 </div>
               <div class="clr"></div>
	       <div id='response'></div><div id='response2'></div>
	       <div class="add_hours" id='upl_pics'>
		<h3>Upload Photos</h3>
		<div class='form_input'>
			<label>File</label>
			<input type="file" name="images" id="images" />
		</div><div class='form_input'>
			<label>Caption</label>
			<textarea type="text" name="caption"  id="img_caption_0" class="capti caption_height" /></textarea>
            
		</div>
		<div class='form_input'>
			<label>File</label>
			<input type="file" name="images" id="images1" />
		</div><div class='form_input'>
			<label>Caption</label>
			<textarea type="text" name="caption" id="img_caption_1" class="capti caption_height"  /></textarea>
		</div>
		<div class='form_input'>
			<label>File</label>
			  <input type="file" name="images" id="images2" />
		</div><div class='form_input'>
			<label>Caption</label>
			<textarea type="type" name="caption" id="img_caption_2" class="capti caption_height" /></textarea>
		</div>
		<div class='form_input'><input type="button" id="btn" value="Upload Files" class="orange_butt"></div>
		
	       </div>
               
               
               <div class="contact_form">
                 <div class=" width_set submit_button ">		  
                   <input type="submit" class="submit_button3 cursor_grid" value='' />
                   <div class="clr"></div>
                   or <a href="<?php echo $this->webroot;?>">Cancel</a>
                   </div>
                 </div>
               
                <?php echo $this->Form->end();?>
		 <script type='text/javascript' language='javascript'>    
$().ready(function() {
    
    //validation rule for only alphabets
    $.validator.addMethod("alpha", function(value) {
        return value == value.match(/^[a-z A-Z]*$/);    
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
						  	'alpha':true,                        
	    	                 minlength:2,
    	                     maxlength:100
                         },                         
                         "data[LogHour][hours]": {
                         	required: true,                         	
                         },
			 "data[LogHour][minutes]": {
                         	required: true,                         	
                         },
                        "data[LogHour][job_date]": {
						 	required: true,
						 	//dateISO:true
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
                         "data[LogHour][location]": {
                            required: 'Please enter your location',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 100 characters'
                         },                         
                        "data[LogHour][hours]": {
                            required: 'Please select volunteer hours',			  
                        },
			"data[LogHour][minutes]": {
                            required: 'Please select volunteer minutes',			  
                        },
			"data[LogHour][job_date]": {
                            required: 'Please select volunteer date'		   
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
             <h1>SPONSORS</h1>
             <?php echo $this->Sponsor->load_advertisements(); ?>
         </div>

             <a href="javascript:void(0);" class="add_text">Advertise with Soceana</a>
               
         <div class="clr"></div>
               
        </div>
<script>
(function () {
	var input = [document.getElementById("images"),document.getElementById("images1"),document.getElementById("images2")],formdata = false,imgcount = 0, caption = '' ;

	if (window.FormData) {
  		formdata = new FormData();  		
	}
	
 	
	
	$('#btn').click(function(){
		$('#response').text('Uploading . . .'); 		
		
		var leng=input.length;
		
		for(l=0;l<leng;l++){
			
			var i = 0, len = input[l].files.length, img, reader, file;   		   
			for ( ; i < len; i++ ) {
				
				file = input[l].files[i];
		       if(file.name != ''){
					if (!!file.type.match(/image.*/)) {
						
						if (formdata) {
							formdata.append("images[]", file);
							imgcount++;
						}
					}
			   }
			}
		  caption = $('#img_caption_'+l).val();
		  formdata.append('caption_' + l,caption);
		}
		
	
		
	
		if (imgcount > 0) {
			$.ajax({
				url: '<?php echo $this->webroot;?>' + "loghours/add_images",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (res) {
					//
					var obj = jQuery.parseJSON(res);	
					for(var i =0; i<obj.length;i++){
					var url = '<?php echo $this->webroot;?>' + 'img/log_hours/' + obj[i].image;
					$('#image_'+ (i + 1)).html("<img src='" + url + "' width='90' height='90'>");
					$('#response2').append("<input type='hidden' name='data[LogHourImage][id][]' value='" +  obj[i].id + "'>");
					$('#upl_pics').remove();
					$('#response').text('Images successfully uploaded');
					}				
				}
			});
		}
		else{
			$('#response').text('No Images to upload');
		}
	});
	
}());

</script>