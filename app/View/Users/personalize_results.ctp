<?php echo $this->Html->script('jquery.validate');?>
<style>
ul.left_margin{position:relative;margin: 0 0 20px;}
ul.left_margin label.error{color:#ff0000;position:absolute;margin-top:5px; text-transform:none;top:298px;width:auto;left:0px;}
</style>
 <!--Upper Box-->
	
          <!--Upper Box End-->
       <div class="top_heading">
         <h1>PERSONALIZE YOUR VOLUNTEERING EXPERIENCE</h1>
          <h3>Filter organizations based upon skill sets they are looking for, and contact them to do more good.</h3>
            
           </div>
       
       
     <div class="wrapper_left_section">
         
         
         
       <!--table-->
       <div class="vol_table">                        
           
         <div class="section">
              <?php echo $this->Form->create('User',array('id'=>'personalize','action'=>'personalize'));?>     
               <div class="signup_form_blue">
                 <label name="name">SARCH SKILL SET :<br />
                   <span>(choose maximum  3 )</span></label>
                 <ul class="left_margin">
                   <?php
			//pr($temp_skills);die;
                            $i = 1;
			    $k = 1;
                foreach($skill_sets as $skill_set):						    
			   			 ?>
                        	<li <?php if($k == 1) echo 'class="first"';?>>
                            	<input type="checkbox" id="a<?php echo $i;?>" name="data[SkillSet][SkillSet][]" value="<?php echo $skill_set['SkillSet']['id'];?>"
				<?php
				//pr($skill_set);die;
				
                 if(in_array($skill_set['SkillSet']['id'], $skillset)){
					echo "checked='checked'";
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
                
               <div class="result_section">
                 <h1>RESULTS</h1>
                 <?php
				 //pr($skillset_results);
				 if(sizeof($skillset_results) > 0){					 
				 foreach($skillset_results as $sk_result){
				 ?>
                 <!--Result Single Outer -->
                 <div class="result_outer">
                   <div class="r_left_section">
                     <div class="r_inner_section">
                       <h3><?php echo $sk_result['User']['organization_name'];?></h3>
                      <h5><?php echo $sk_result['User']['location'];?><br /><br />
                       <?php echo $sk_result['User']['email_id'];?> </h5></div>
                     
                     <a href="javascript:void(0);" class="long_blue_b" onclick="load_message_to('<?php echo $sk_result['User']['id'];?>')">SEND A MESSAGE THROUGH SOCEANA <img src="<?php echo $this->webroot;?>img/b_butt_arrow.png"  alt="" class="butt_icon" /></a>
                     
                     
                     </div>
                   
                   <div class="r_right_section">
                     <div class="img_wrapp">
           			          <img src="<?php 
			if($sk_result['User']['thumb_image']==''){
				echo $this->webroot.'img/no_image.png';
		   	}else{
				echo $this->webroot.'img/upload/'.$sk_result['User']['thumb_image'];			
		    }
		     ?>" alt="<?php echo $sk_result['User']['organization_name'];?>" class="personalie_result_image" ></div>
                     <div class="star_view_outer">
                     <?php
					 foreach($sk_result['SkillSet']as $sk_set){
						 if(in_array($sk_set['id'],$skillset)){						 
					 ?>
                     <h6><?php echo $sk_set['name'];?></h6>
                       <div class="star_outer">
						   <?php
//						   echo ;						   
                           for($i=1;$i<=5;$i++){  
							   if($i<=$sk_set['UserSkillSet']['rate']){                             
							   ?>
							   <img src="<?php echo $this->webroot;?>img/yellow_star.png" alt=""  />                          
							   <?php
						   		}
								else{
								?>
							   <img src="<?php echo $this->webroot;?>img/white_star.png" alt=""  />                          
							   <?php
								}
					   		} 
							?></div>
                       <?php }
					 }
					 ?>
                     </div>
                     </div> 
                   </div>
                   <!--Result Single Outer End -->
                   <?php
				 	}
				 }else{
				 echo '<div align="center" style="color:#ff0000">No records found</div>'; 
				 }
				   ?>
                   <div class="table_footer_white1">
                   <div class="next_preview_butt1">
                    <?php echo $this->Paginator->counter('Showing {:start} to {:end} of {:count} entries');?>,<br/>
                 <div style="float:right;">    	<?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev'));?>
       			<?php echo $this->Paginator->next(' > '  , array(), null, array('class' => 'next'));?>
                       </div>
                    </div>
                 </div>                                                                                   
               </div> 
               <div align="center">
            	<a href="<?php echo $this->webroot;?>users/personalize">Back</a>
            </div> 
               
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
     <script type='text/javascript' language='javascript'>
      function load_message_to(id){  
	  if($("#upper_box").css("display","none")) {
	    $("#upper_box").css("display","block");
	  }
	  $('.message_section').show();
	  $('#messages').hide();
	  $('#hidden_to').val(id);
	  $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'users/getdetails',
                   data:{ user_id:id},
                   success: function(data){                        
			var obj = jQuery.parseJSON(data);
			$('#compose_to').val(obj.name.trim());
			$('#compose_to').attr("disabled", true);
			$('#compose_image').html('<img src='+ obj.image + ' width="69" height="69">');   
                   }
            });	   
      }
     </script>