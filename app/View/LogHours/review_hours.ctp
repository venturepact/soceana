<!--Upper Box End-->
         <div class="top_heading">
           <h1>VERIFY HOURS</h1>
            <h3>View the hours submitted by volunteers and accept/reject them so they may be Soceana Certified.</h3>
            
             </div>
       
       
       <div class="wrapper_left_section">
           
         <h1>REVIEW HOURS</h1>
 <!--table-->
 <div class="table_head">
          <div class="list"> <?php echo $this->Form->create('Pages');?>
                          <?php
                          if($this->Session->read('page_limit') != null){
                                    $limit = $this->Session->read('page_limit');			
                            }
                          else $limit = 5;
                          echo $this->Form->input('limit',array(
							       'type' => 'select',
							       'div' => false,
							       'label' => false,							       
							       'options' => array('5'=>'5','10'=>'10','15'=>'15','20'=>'20','25'=>'25','30'=>'30'),
							       'default' => $limit,
							       'id' => 'select',
                                                               'onChange'=>'this.form.submit();'
							       ));?>
                         
                        <?php echo $this->Form->end();?> 
              </div>   
                       
                <div class="record" ><h5>records per page</h5></div>
               </div>
    <div class="vol_table">                        
    
    <div class="vol_table">                        
               <div class="table_head_dark">
                  <div class="t_col_1 right_border"><h6>CATEGORY</h6></div>
                    <div class="t_col_2 right_border">
                      <h6>TYPE OF VOLUNTEER</h6></div>
                      <div class="t_col_3 right_border"><h6>VOLUNTEER</h6></div>
                        <div class="t_col_4 right_border"><h6>HRS.</h6></div>
                          <div class="t_col_5"><h6>DATE</h6></div>
                          <div class="t_col_6"><img src="<?php echo $this->webroot;?>img/logo_cert_white.png" /></div>
          </div>
    <?php
      //  pr($loghours);
	foreach($loghours as $log_hour){
    ?>                
    <div class="table_head_light">
        <div class="t_col_1 box_border cursor_grid" onclick="document.location.href='<?php echo $this->webroot;?>loghours/confirm_hours/<?php echo $log_hour['LogHour']['id'];?>';"><span class="gray_text"><?php echo $log_hour['Category']['category_name'];?></span></div>
        <div class="t_col_2 box_border cursor_grid" onclick="document.location.href='<?php echo $this->webroot;?>loghours/confirm_hours/<?php echo $log_hour['LogHour']['id'];?>';"><span class="gray_text"><?php echo $log_hour['ServiceType']['name'];?></span></div>
        <div class="t_col_3 box_border cursor_grid" onclick="document.location.href='<?php echo $this->webroot;?>loghours/confirm_hours/<?php echo $log_hour['LogHour']['id'];?>';"><span class="gray_text"><?php echo $log_hour['User']['first_name'].' '.$log_hour['User']['last_name'];?></span></div>
        <div class="t_col_4 box_border cursor_grid" onclick="document.location.href='<?php echo $this->webroot;?>loghours/confirm_hours/<?php echo $log_hour['LogHour']['id'];?>';"><span class="gray_text"><?php echo $log_hour['LogHour']['hours'];?></span></div>
        <div class="t_col_5 box_border cursor_grid" onclick="document.location.href='<?php echo $this->webroot;?>loghours/confirm_hours/<?php echo $log_hour['LogHour']['id'];?>';"><span class="gray_text"><?php echo date("m-d-Y", strtotime($log_hour['LogHour']['job_date']));?></span></div>
        <div class="t_col_6 box_border_right cursor_grid" onclick="document.location.href='<?php echo $this->webroot;?>loghours/confirm_hours/<?php echo $log_hour['LogHour']['id'];?>';">
            <?php
            switch($log_hour['LogHour']['status']){
               
               case 0:
                  $icon = 'img/logo_cert.png';
                  $title = 'Pending for Approval';
                break;
                
                case 1:
                  $icon = 'img/green_icon.png';
                  $title = 'Approved Hours';
                break;
            
                case 2:
                  $icon = 'img/orange_icon.png';
                  $title = 'Rejected Hours';
                break;                                 
            
            }                           
            ?>
            <img width="22" src="<?php echo $this->webroot.$icon;?>" title='<?php echo $title;?>'></div>
    </div>
    <?php
     }
    ?>     
   <div class="table_footer_white">
     <div class="gray_text1"><?php echo $this->Paginator->counter('Showing {:start} to {:end} of {:count} entries');?></div>
       <div class="next_preview_butt">
            <?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev'));?>
            <?php echo $this->Paginator->next(' > '  , array(), null, array('class' => 'next'));?>
          </div>
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

               <a href="#" class="add_text">Advertise with Soceana</a>
               
           <div class="clr"></div>
               
</div>   