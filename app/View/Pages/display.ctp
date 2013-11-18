<script type="text/javascript" src="<?php echo $this->webroot;?>Charts/FusionCharts.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>assets/prettify/prettify.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>assets/ui/js/json2.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>assets/ui/js/lib.js" ></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>  
 <?php
			function get_info($hours){
				$minutes = $hours * 60;
				//
				// Assuming that your minutes value is $minutes
				//
				$temp['days'] = floor ($minutes / 1440);
				$temp['hours'] = floor (($minutes - $temp['days'] * 1440) / 60);
				$temp['minutes'] = $minutes - ($temp['days'] * 1440) - ($temp['hours'] * 60);
				//
				// Then you can output it like so...
				//
				//echo "{$minutes} min converts to {$d}d {$h}h {$m}m";
				return $temp;
			}			
			?>
<?php
/* @ check if the role of current logged in user is organzation or normal volunteer
 *  @ set dashboard accordingly
 */
if($this->Session->read('User.role') == 'organizations') {	
?>
<div class="top_heading">
   <h1>ANALYTICS DASHBOARD</h1>
   <h3>View metrics and data for the social good you have done through Soceana.</h3>            
</div>   
          
     <div class="wrapper_left_section">
         <div class="left_top_section">
             <div class="main_text">                  
                 <p>NEWS</p></div>
                    <div class="news_text">
                      <span>- You received a message from <strong>Karri Roman</strong> on Sunday</span><br/>
                        <span>- Your latest volunteer position at the <strong>Hospital of University</strong></span>
                         </div>                                        
             </div>
   <div class="top_heading_second">
     <h1>SOCIAL TIDES CHART</h1>
        </div>       
       <div class="table_head">
         <div class="list"><?php echo $this->Form->create('Pages');?>
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
 <!--table-->
 <div style="float:left; width:100%;">                        
             <div class="table_head_dark">
                <div class="t_col_1 right_border"><h6>COMPANY NAME</h6></div>
                  <div class="t_col_2 right_border"><h6>TYPE OF VOLUNTEERING</h6></div>
                    <div class="t_col_3 right_border"><h6>VOLUNTEER</h6></div>
                      <div class="t_col_4 right_border"><h6>HRS.</h6></div>
                        <div class="t_col_5 right_border"><h6>DATE</h6></div>
                          <div class="t_col_6 "><img src="<?php echo $this->webroot;?>img/logo_cert_white.png" /></div>
                 </div>
        <?php 
		//pr($loghours);
		foreach($loghours as $log_hour){
         ?>             
    <div class="table_head_light">
                <div class="t_col_1 box_border"><span class="gray_text"><?php echo $log_hour['emp_name'];?></span></div>
                  <div class="t_col_2 box_border"><span class="gray_text"><?php echo $log_hour['ServiceType']['name'];?></span></div>
                    <div class="t_col_3 box_border"><span class="gray_text"><?php echo $log_hour['User']['first_name'].' '.$log_hour['User']['last_name'];?></span></div>
                      <div class="t_col_4 box_border"><span class="gray_text"><?php echo $log_hour['LogHour']['hours'];?></span></div>
                        <div class="t_col_5 box_border"><span class="gray_text"><?php echo date("m-d-Y", strtotime($log_hour['LogHour']['job_date']));?></span></div>
                          <div class="t_col_6 box_border_right"><?php
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
   <div class="table_footer_white "  >
     <div class="gray_text1"><?php echo $this->Paginator->counter('Showing {:start} to {:end} of {:count} entries');?></div>
      <div class="next_preview_butt">
       <?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev'));?>
       <?php echo $this->Paginator->next(' > '  , array(), null, array('class' => 'next'));?>
        </div>
    </div>
    <div class="graph_section">
      <h1>ANALYTICS</h1>
      <div class="graph_text">TIME PLOT: TOTAL VOLUNTEER HOURS VS. OTHER BRANCHES.</div>
      <?php echo $this->element('org_linechart');?>
         <div class="graph_main_section">
            <div class="left_side">
              <div class="graph_text1">TRENDS & STATISTICS</div>
                    <div class="graph_2_outer"><img src="<?php echo $this->webroot;?>img/graph_2.png" alt="graph" width="100%" height="100%" /></div>
              <div class="graph_text2">AGE DISTRIBUTION</div>
                           <?php echo $this->element('org_barchart');?>
           </div>             
               <div class="right_side">
                 <div class="small_graph_text">Pageclicks from Advertisements</div>
                    <h1 style="color:#fa7e00; font-weight:bolder;">362</h1>
                       <div class="small_graph_text">Total Revenue from Soceana</div>
                           <h1 style="color:#fa7e00; font-weight:bolder;">$2,111.13</h1>
                   <div class="graph_text2">AD ENGAGEMENT</div>
                       <div class="graph_4_outer" ><img src="<?php echo $this->webroot;?>img/graph_4.png" width="100%" height="100%"  alt="Graph" /></div>
                         <div class="small_graph_text">Your advertisments have reached </div>
                    </div>
						  </div>           
      </div>   
    </div>          
         </div>                    
          <div class="wrapper_mid_border"></div>              
     <div class="wrapper_right_section">
        <div class="time_outer">
            <div class="top_section" ><h4>TOTAL HOURS VOLUNTEERED</h4></div> 
              <div class="right_plus" style="background:#0D8677"  ><a href="#" ><img src="<?php echo $this->webroot;?>img/icon-plus.png" border="0"></a></div>          
              <div class="mid_section"><span class="large_font"><?php if($total_hours!=NULL){
				$info = get_info($total_hours);
				echo $info['days'].':'.$info['hours'].':'.$info['minutes'];
			}
			else echo '0:0:0';?></span></div>
                 <div class="fields">
                    <div class="small_font_time"><span >DAYS</span><span class="space1"> HOURS</span> MINUTES</div>
                     </div>                      
             </div>
          <div class="right_section_inner">  
             <h1>SPONSORS</h1>
             <?php echo $this->Sponsor->load_advertisements(); ?>
           </div>

             <a href="#" class="add_text">Advertise with Soceana</a></div>
<?php
}
elseif($this->Session->read('User.role') == 'companies'){	
?>
<style type="text/css">
.table_text {
	color: #FFF; background:#999;
}
.border{ border:1px solid #FFF; border-right:none; border-top:none;}
.border1{ border:1px solid #FFF;}
.row_text{ background:#E1E1E1; color:#666;}
.row_text:hover{ background:#D3D3D3; color:#000; }
.container{min-height:0}
					
</style>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/highlight.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.accordion.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        //syntax highlighter
        hljs.tabReplace = '    ';
        hljs.initHighlightingOnLoad();

        $.fn.slideFadeToggle = function(speed, easing, callback) {
            return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
        };

        //accordion
        $('.accordion').accordion({
            defaultOpen: 'section1',
            cookieName: 'accordion_nav',
            speed: 'slow',
            animateOpen: function (elem, opts) { //replace the standard slideUp with custom function
                elem.next().stop(true, true).slideFadeToggle(opts.speed);
            },
            animateClose: function (elem, opts) { //replace the standard slideDown with custom function
                elem.next().stop(true, true).slideFadeToggle(opts.speed);
            }
        });

    });
</script>
<div class="top_heading">
   <h1>ANALYTICS DASHBOARD</h1>
   <h3>View metrics and data for the social good you have done through Soceana.</h3>            
</div>   
          
     <div class="wrapper_left_section">
         <div class="left_top_section">
             <div class="main_text">                  
                 <p>NEWS</p></div>
                    <div class="news_text">
                      <span>- You received a message from <strong>Karri Roman</strong> on Sunday</span><br/>
                        <span>- Your latest volunteer position at the <strong>Hospital of University</strong></span>
                         </div>                                        
             </div>
   <div class="top_heading_second">
     <h1>SOCIAL TIDES CHART</h1>
        </div>       
       <div class="table_head">
         <div class="list"><?php echo $this->Form->create('Pages');?>
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
 <!--table-->
 <div style="float:left; width:98%;">
 <?php // pr($loghours);
		foreach($loghours as $log_hour){
         ?> 
          <!-- panel -->
<div class="accordion" id="section1"><?php echo $log_hour['User']['first_name'].' '.$log_hour['User']['last_name'];?><p style=" margin-left:400px;  margin-top:-18px;"><?php echo $log_hour['total_hrs'];?> HRS</p><span></span></div>
<div class="container">
    <div class="content">
    
       <div style="width:100%;">
       <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr class="table_text">
    <td width="25%" height="25" align="center" class="border">CATEGORY</td>
    <td width="25%" height="25" align="center" class="border">TYPE OF VOLUNTEERING</td>
    <td width="25%" height="25" align="center" class="border">ORGANIZATION NAME</td>
    <td width="10%" height="25" align="center" class="border">HRS.</td>
    <td width="15%" height="25" align="center"class="border">DATE</td>
   
  </tr>
  <?php foreach($log_hour['lg_hour'] as $lg_hour)
  {
  ?>
  <tr class="row_text">
    <td height="25" align="center" class="border"><?php echo $lg_hour['Category']['category_name'];?></td>
    <td height="25" align="center" class="border"><?php echo $lg_hour['ServiceType']['name'];?></td>
    <td height="25" align="center" class="border"><?php echo $lg_hour['User']['organization_name'];?></td>
    <td height="25" align="center" class="border"><?php echo $lg_hour['LogHour']['hours'];?></td>
    <td height="25" align="center" class="border"><?php echo date("m-d-Y", strtotime($lg_hour['LogHour']['job_date']));?></td>   
  </tr>
 <?php
  }
  ?>
</table>

       
       
       </div>
    
    </div>
</div>
<?php
     }
    ?>
<!-- end panel -->
<!-- panel -->


          
          
         </div>
          <div class="table_footer_white"  >
     <div class="gray_text1"><?php echo $this->Paginator->counter('Showing {:start} to {:end} of {:count} entries');?></div>
      <div class="next_preview_butt">
       <?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev'));?>
       <?php echo $this->Paginator->next(' > '  , array(), null, array('class' => 'next'));?>
        </div>
    </div>
    <div class="graph_section">
      <h1>ANALYTICS</h1>
      <div class="graph_text">TIME PLOT: TOTAL EMPLOYEE HOURS VS. MONTHS</div>
      <?php echo $this->element('company_linechart');?>            
      </div>   
    
          </div>           
          <div class="wrapper_mid_border"></div>              
     <div class="wrapper_right_section">
        <div class="time_outer">
            <div class="top_section" ><h4>TOTAL HOURS VOLUNTEERED</h4></div> 
              <div class="right_plus" style="background:#0D8677"  ><a href="#" ><img src="<?php echo $this->webroot;?>img/icon-plus.png" border="0"></a></div>          
              <div class="mid_section"><span class="large_font"><?php if($total_hours!=NULL){
				$info = get_info($total_hours);
				echo $info['days'].':'.$info['hours'].':'.$info['minutes'];
			}
			else echo '0:0:0';?></span></div>
                 <div class="fields">
                    <div class="small_font_time"><span >DAYS</span><span class="space1"> HOURS</span> MINUTES</div>
                     </div>                      
             </div>
          <div class="right_section_inner">  
             <h1>SPONSORS</h1>
             <?php echo $this->Sponsor->load_advertisements(); ?>
           </div>

             <a href="javascript:void(0);" class="add_text">Advertise with Soceana</a></div>
<?php
}
else
{
	
?>
<div class="top_heading">
   <h1>ANALYTICS DASHBOARD</h1>
   <h3>View metrics and data for the social good you have done through Soceana.</h3>
</div>
<div class="wrapper_left_section">
        <div class="left_top_section">
             <div class="main_text">                  
                 <p>NEWS</p></div>
                    <div class="news_text">
                      <span>- You received a message from <strong>Karri Roman</strong> on Sunday</span><br/>
                        <span>- Your latest volunteer position at the <strong>Hospital of University</strong></span>
                         </div>
                </div>
   		<div class="top_heading_second">
     <h1>SOCIAL TIDES CREATED</h1>
        </div>       
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
 <!--table-->
 <div class="vol_table">                        
             <div class="table_head_dark">
                <div class="t_col_1 right_border"><h6>CATEGORY</h6></div>
                  <div class="t_col_2 right_border"><h6>VOLUNTEER TYPE</h6></div>
                    <div class="t_col_3 right_border"><h6>ORGANIZATION</h6></div>
                      <div class="t_col_4 right_border"><h6>HRS.</h6></div>
                        <div class="t_col_5"><h6>DATE</h6></div>
                        <div class="t_col_6"><img src="<?php echo $this->webroot;?>img/logo_cert_white.png" /></div>
                 </div>
     <?php                         
     foreach($loghours as $log_hour){
     ?>
    <div class="table_head_light">
         <div class="t_col_1 box_border"><span class="gray_text"><?php echo $log_hour['Category']['category_name'];?></span></div>
         <div class="t_col_2 box_border"><span class="gray_text"><?php echo $log_hour['ServiceType']['name'];?></span></div>
         <div class="t_col_3 box_border"><span class="gray_text"><?php echo $log_hour['User']['organization_name'];?></span></div>
         <div class="t_col_4 box_border"><span class="gray_text"><?php echo $log_hour['LogHour']['hours'];?></span></div>
         <div class="t_col_5 box_border"><span class="gray_text"><?php echo date("m-d-Y", strtotime($log_hour['LogHour']['job_date']));?></span></div>
         <div class="t_col_6 box_border_right">
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
            <img width="22" src="<?php echo $this->webroot.$icon;?>" title='<?php echo $title;?>'>            
         </div>
      </div> 
    <?php
   }
    ?>    
   <div class="table_footer_white "  >
     <div class="gray_text1"><?php echo $this->Paginator->counter('Showing {:start} to {:end} of {:count} entries');?></div>


      <div class="next_preview_butt">
       <?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev'));?>
       <?php echo $this->Paginator->next(' > '  , array(), null, array('class' => 'next'));?>        
        </div>
    </div>
    <div class="graph_section">
      <h1>ANALYTICS</h1>    
       <?php echo $this->element('vol_linechart');?>      
       <div class="clr"></div>
       <div class="mt50"></div>
       <?php echo $this->element('vol_piechart');?>      
       </div>   
    </div>          
         </div>
         <div class="wrapper_mid_border"></div>
         <div class="wrapper_right_section">
        <div class="time_outer2">
            <div class="top_section"><h4>TOTAL HOURS VOLUNTEERED</h4></div>
             <div class="right_plus" style="background:#9A4314; padding-top:0px;"><a href="<?php echo $this->webroot;?>loghours/add"><img src="<?php echo $this->webroot;?>img/icon-plus.png" border="0"></a>
                 </div>          
              <div class="mid_section"><span class="large_font"><?php if($total_hours!=NULL){
				$info = get_info($total_hours);
				echo $info['days'].':'.$info['hours'].':'.$info['minutes'];
			}
	      
			else echo '0:0:0';?></span></div>
                 <div class="fields">
                    <div class="small_font_time"><span >DAYS</span><span class="space1"> HOURS</span> MINUTES</div>
                     </div>                      
             </div>
           <div class="right_section_inner">  
             <h1>SPONSORS</h1>
             <?php echo $this->Sponsor->load_advertisements(); ?>
            </div>
              
             
             <a href="javascript:void(0);" class="add_text">Advertise with Soceana</a>               
         <div class="clr"></div>               
         </div>
<?php
}
?>