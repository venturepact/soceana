<script type="text/javascript" src="<?php echo $this->webroot;?>Charts/FusionCharts.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>assets/prettify/prettify.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>assets/ui/js/json2.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>assets/ui/js/lib.js" ></script>
<?php echo $this->Html->css('jquery.autocomplete');?>
<?php echo $this->Html->script('jquery.autocomplete');?>
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
                      <span>You received a message from <strong>Karri Roman</strong> on Sunday, July 8th 2013.</span>
                        <span>Your latest volunteer position at the <strong>Hospital of University</strong> .</span>
                         </div>                                        
             </div>
   <div class="top_heading_second">
     <h1>SOCIAL TIDES CREATED</h1>
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
                <div class="t_col_1 right_border"><h6>CATEGORY</h6></div>
                  <div class="t_col_2 right_border"><h6>TYPE OF VOLUNTEERING</h6></div>
                    <div class="t_col_3 right_border"><h6>VOLUNTEER</h6></div>
                      <div class="t_col_4 right_border"><h6>HRS.</h6></div>
                        <div class="t_col_5 right_border"><h6>DATE</h6></div>
                          <div class="t_col_6 "><img src="<?php echo $this->webroot;?>img/logo_cert_white.png" /></div>
                 </div>
        <?php 
		foreach($loghours as $log_hour){
         ?>             
    <div class="table_head_light">
                <div class="t_col_1 box_border"><span class="gray_text"><?php echo $log_hour['Category']['category_name'];?></span></div>
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
       <?php echo $this->Paginator->prev(' << ', array(), null, array('class' => 'prev'));?>
       <?php echo $this->Paginator->next(' >> '  , array(), null, array('class' => 'next'));?>
        </div>
    </div>
    <div class="graph_section">
      <h1>ANALYTICS</h1>
      <div class="graph_text">TIME PLOT: TOTAL VOLUNTEER HOURS VS. OTHER BRANCHES.</div>
       <div class="graph_1_outer" id="chartdiv2">Chart will load here</div>
         <script type="text/javascript">
                        var data_string2 = '';                        
                                    $.ajax({
                                            type: "POST",
                                            url: '<?php echo $this->webroot;?>' + 'loghours/OrganizationChartData',
                                            data: '',
                                            success: function(data) {                                   
                                                displaychart2(data);                                     
                                            }
                                    });
                       function displaychart2(data_string2) {
                                   if (GALLERY_RENDERER && GALLERY_RENDERER.search(/javascript|flash/i)==0)  FusionCharts.setCurrentRenderer(GALLERY_RENDERER); 
                                   var chart2 = new FusionCharts("<?php echo $this->webroot;?>Charts/MSLine.swf", "ChartId", "560", "400", "0", "0");
                                   chart2.setXMLData( data_string2 );		   
                                   chart2.render("chartdiv2");                      
                       }             
		       </script>
         <div class="graph_main_section">
            <div class="left_side">
              <div class="graph_text1">TRENDS & STATISTICS</div>
                    <div class="graph_2_outer"><img src="<?php echo $this->webroot;?>img/graph_2.png" alt="graph" width="100%" height="100%" /></div>
              <div class="graph_text2">AGE DISTRIBUTION</div>
                           <div class="graph_3_outer" id="chartdiv">Chart will load here</div>
                           <script type="text/javascript">
                        var data_string = '';                        
                                    $.ajax({
                                            type: "POST",
                                            url: '<?php echo $this->webroot;?>' + 'loghours/OrganizationAgeChartData',
                                            data: '',
                                            success: function(data) {                                   
                                                displaychart(data);                                     
                                            }
                                    });
                       function displaychart(data_string) {
                                   if (GALLERY_RENDERER && GALLERY_RENDERER.search(/javascript|flash/i)==0)  FusionCharts.setCurrentRenderer(GALLERY_RENDERER); 
                                   var chart = new FusionCharts("<?php echo $this->webroot;?>Charts/Column2D.swf", "ChartId", "325", "250", "0", "0");
                                   chart.setXMLData( data_string );		   
                                   chart.render("chartdiv");                      
                       }             
		       </script>
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
            <div class="top_section"><h4>TOTAL HOURS VOLUNTEERED</h4></div>
              <div class="mid_section"><span class="large_font">115:21:24</span></div>
                 <div class="fields">
                    <div class="small_font_time"><span >DAYS</span><span class="space1"> HOURS</span> MINUTES</div>
                     </div>                      
             </div>
           <div class="right_section_inner">  
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
              <div class="section2"><img src="<?php echo $this->webroot;?>img/ch_image.png" width="100%" height="100%" alt="" /></div>
              </div>            
                   </div>
                   <div class="add_img_outer"><img src="<?php echo $this->webroot;?>img/volunteer.png" width="100%" height="100%" alt="" />                  
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
              <div class="section2"><img src="<?php echo $this->webroot;?>img/main_steel_img.png" width="100%" height="100%" alt="" /></div>
              </div>          
                   </div>                   
             </div>
             <a href="#" class="add_text">Advertise with Soceana</a></div>
<?php
}
else{
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
                      <span>You received a message from <strong>Karri Roman</strong> on Sunday, July 8th 2013.</span>
                        <span>Your latest volunteer position at the <strong>Hospital of University</strong> .</span>
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
       <?php echo $this->Paginator->prev(' << ', array(), null, array('class' => 'prev'));?>
       <?php echo $this->Paginator->next(' >> '  , array(), null, array('class' => 'next'));?>        
        </div>
    </div>
    <div class="graph_section">
      <h1>ANALYTICS</h1>
      <div class="graph_text">TIME PLOT: TOTAL VOLUNTEER HOURS VS. OTHER BRANCHES.</div>
       <div class="graph_1_outer" id="chartdiv2">Chart will load here</div>
       <script type="text/javascript">
             var data_string2 = '';                        
                         $.ajax({
                                 type: "POST",
                                 url: '<?php echo $this->webroot;?>' + 'loghours/volunteerChartData',
                                 data: '',
                                 success: function(data) {                                   
                                     displaychart2(data);                                     
                                 }
                         });
            function displaychart2(data_string2) {
                        if (GALLERY_RENDERER && GALLERY_RENDERER.search(/javascript|flash/i)==0)  FusionCharts.setCurrentRenderer(GALLERY_RENDERER); 
                        var chart2 = new FusionCharts("<?php echo $this->webroot;?>Charts/MSLine.swf", "ChartId", "560", "400", "0", "0");
		        chart2.setXMLData( data_string2 );		   
		        chart2.render("chartdiv2");                      
            }           
		</script>       
       <div class="clr"></div>
       <div class="mt50"></div>
       <div class="graph_main_section" id="chartdiv">Chart will load here</div>
       <script type="text/javascript">
                        var data_string = '';                        
                         $.ajax({
                                 type: "POST",
                                 url: '<?php echo $this->webroot;?>' + 'loghours/volunteerPieData',
                                 data: '',
                                 success: function(data) {                                   
                                     displaychart1(data);                                     
                                 }
                         });
                         function displaychart1(data_string) {
                            if (GALLERY_RENDERER && GALLERY_RENDERER.search(/javascript|flash/i)==0)  FusionCharts.setCurrentRenderer(GALLERY_RENDERER); 
                            var chart = new FusionCharts("<?php echo $this->webroot;?>Charts/Pie3D.swf", "ChartId", "560", "400", "0", "0");
                            chart.setXMLData(data_string);		   
                            chart.render('chartdiv');         
                         }                          
                     </script>
            </div>   
    </div>          
         </div>
         <div class="wrapper_mid_border"></div>
         <div class="wrapper_right_section">
        <div class="time_outer2">
            <div class="top_section"><h4>TOTAL HOURS VOLUNTEERED</h4></div>
              <div class="mid_section"><span class="large_font">115:21:24</span></div>
                 <div class="fields">
                    <div class="small_font_time"><span >DAYS</span><span class="space1"> HOURS</span> MINUTES</div>
                     </div>                      
             </div>
           <div class="right_section_inner">  
             <h1>SPONSORS</h1>
               <div class="sponser_outer">
                  <div class="sponser_inner"><h7> Sed ultricies volutpat tempor. Cras non lacus at enim venenatis hendrerit. Morbi lacus arcu, luctus sollicitudin molestie vulputate, sagittis eget quam. Praesent eget massa purus. Mauris fermentum ante quis mauris pretium, eu interdum metus fringilla. Curabitur lacinia vulputate tincidunt.</h7></div>
                     <div class="tip"></div>
        <div class="add_section">
            <div class="section1">
                <div class="black_text">
                     THE CHILDREN’S HOSPITAL OF PHILADELPHIA
                      </div>
                    <div class="black_text_thin">3401 Civic Center Blvd. Philadelphia PA
(215) 590-1000</div> 
<a href="#" class="orange_butt">VOLUNTEER THROUGH SOCEANA</a> 
                 </div>
              <div class="section2"><img src="<?php echo $this->webroot;?>img/ch_image.png" alt="" /></div>
              </div>           
                   </div>
                   <div class="add_img_outer"><img src="<?php echo $this->webroot;?>img/volunteer.png" width="350" alt="" />                
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
              <div class="section2"><img src="<?php echo $this->webroot;?>img/main_steel_img.png" alt="" /></div>
              </div>
              </div></div>
             <a href="#" class="add_text">Advertise with Soceana</a>               
         <div class="clr"></div>               
         </div>
<?php
}
?>
<!-- message box functionality-->
<div class="upper_box_wrapper">
       <div class="box_wrap_inner"><a href="#" onclick="show()"><img src="<?php echo $this->webroot;?>img/chat1.png" /> </a></div>
       <div class="upper_box" id="upper_box" style="display:none;">
         <div class="bott_margin"><img src="<?php echo $this->webroot;?>img/chat1.png" /></div>
         <div class="left_section_upper">
            <div class="icon_list">
               <ul>
               <li><a href="javascript:void(0);" onclick="show()" ><img src="<?php echo $this->webroot;?>img/icon5.png" alt="" border="0"  /></a></li>
                 <li><a href="javascript:void(0);" id='inbox'><img src="<?php echo $this->webroot;?>img/icon4.png" alt="" border="0"  /></a></li>
                   <li><a href="javascript:void(0);" id='compose'><img src="<?php echo $this->webroot;?>img/icon1.png" alt="" border="0"  /></a></li>
                   <li><a href="javascript:void(0);" id='delete'><img src="<?php echo $this->webroot;?>img/icon2.png" alt="" border="0"  /></a></li>
                    </ul>
                  </div>
             </div>
         <div class="right_section_upper">
         <div class="client_section">
         <div id='message_status'></div>         
         <div id='messages'>            
         </div>

         <div class="message_section" style="display:none;">
                    <!--compose section-->
      <div class="client_outer">        
          <div class="client_img_outer_f"><img src="<?php echo $this->webroot;?>img/client_img_outer_b.png" alt="" /></div>
             <div class="client_img_outer" id='compose_image'><img src="<?php echo $this->webroot;?>img/client_img_gray.png" alt="" /></div>
                  
                   <div class="client_detail">
                        <?php echo $this->Form->input('Message.name',array('type'=>'text','div'=>false,'label'=>false,'id' => 'compose_to','class'=>'compose_input1 ac_input'));?>
                        <?php echo $this->Form->input('Message.message_to',array('type'=>'hidden','id' => 'hidden_to'));?>
                       
                                                 
                        </div>
                        
                </div>
                 <!--Single Client Outer End--> 
                   <h3>New Message</h3>
                   <?php echo $this->Form->input('Message.message',array('type'=>'textarea','div'=>false,'label'=>false,'id' => 'compose_typed_message','cols'=>"1" ,'rows'=>"11"));?>
                   
                    <input type="button" value="Submit" class="submit_butt" id='message_button' />
                   
          
                   
           </div>
              <!--Message section End -->
               
             </div>        
             
             
       </div>
     </div>
     </div>
<!-- /end of message box functionality-->
<script>
// delete function of message box
$('#delete').click(function(){
     $('#message_status').html('<div id="info" style="background-color:#FFFFFF;float: left;height: 27px;position: fixed;width: 299px;z-index: 500000;"><img src="<?php echo $this->webroot;?>img/loading.gif">&nbsp;Deleting messages</div>');	
     var matches = [];
     $(".inbox_message:checked").each(function() {
          matches.push(this.value);
     });
     if(matches.length == 0){
        $('#info').html( 'Please select a message to delete');    
     }
     else{
           if(matches.length == 1) {
              var text_message = '1 Message';
           }else text_message = matches.length + ' Messages';
            
           $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/messages_delete',
                   data: {
                        ids: matches,                       
                    },
                   success: function(data) {                        
                        $.ajax({
                                    type: "POST",
                                    url: '<?php echo $this->webroot;?>' + 'pages/messages',
                                    data:'',
                                    success: function(data) {
                                         $('#messages').html(data);                                        
                                    }
                        });
                        
                        $('#info').text( text_message + ' deleted successfully');
                   }
            }); 
     }
     $('#info').fadeOut(10000);     
});
// compose message submit function
$('#message_button').click(function(){
$('#message_status').html('<div id="info" style="background-color:#FFFFFF;float: left;height: 27px;position: fixed;width: 299px;z-index: 500000;"><img src="<?php echo $this->webroot;?>img/loading.gif">&nbsp;Message Sent Successfully</div>');	
  $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/send_message',
                   data:{
                        message_to:$('#hidden_to').val(),
                        message:$('#compose_typed_message').val()
                        },
                   success: function(data) {
                        $('#compose_image').html('<img src="<?php echo $this->webroot;?>img/client_img_gray.png" alt="" />');
                        $('#hidden_to').val('');
                        $('#compose_to').val('');                        
                        $('#compose_typed_message').val('');
                        
                   }
 });
  $('#info').fadeOut(10000);
  $('.message_section').hide();
  $('#messages').show();
});


//reply message section
function reply(id) {
    $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/message_reply',
                   data:{id:id},
                   success: function(data) {
                        $('#messages').html(data);                                        
                   },
                   
                   
                   
 }) 
  $('.message_section').hide();
  $('#messages').show();
  $(document).ajaxComplete(function(){
	 // $("#messages").scrollTop($("#messages").height());
	 	//alert($("#messages").height());
	//$("#messages").scrollTop('300');
  	$(".client_section, #messages").animate({scrollTop: $("#messages").height()}, 300);	
	//$('#messages').animate({ scrollTo: 500; });
	//alert($("#messages").scrollTop());
	
  });
        
        
}

//loading inbox messages automatically
$(document).ready(function(){
     $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/messages',
                   data:'',
                   success: function(data) {
                        $('#messages').html(data);                                        
                   }
            });       
});

//loading inbox messages on click event
$('#inbox').click(function(){
  //$('#message_status').html('<div id="info" style="background-color:#FFFFFF;float: left;height: 27px;position: fixed;width: 299px;z-index: 500000;"><img src="<?php echo $this->webroot;?>img/loading.gif">&nbsp;Loading Messages</div>');	
  $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/messages',
                   data:'',
                   success: function(data) {
                        $('#messages').html(data);                                        
                   }
 });
  //$('#info').fadeOut(10000);
  $('.message_section').hide();
  $('#messages').show();
});

$('#compose').click(function(){
   $('.message_section').show();
   $('#messages').hide();           
});





// auto complete code for compose message
            $(document).ready(function () {
                $('#message_status').hide()  // hide it initially
                .ajaxStart(function () {
                    //alert('started');
                    $('#message_status').show();
                })
                .ajaxStop(function () {
                    //alert('stoped');
                    $('#message_status').hide();
                });

            });
        

  function findValue(li) {
  	if( li == null ) return alert("No match!");

  	// if coming from an AJAX call, let's use the CityId as the value
  	if( !!li.extra ) var sValue = li.extra[0];

  	// otherwise, let's just display the value in the text box
  	else var sValue = li.selectValue;

  	//alert("The value you selected was: " + sValue);
	test(sValue);
  }

  function selectItem(li) {
    	findValue(li);	
  }

  function formatItem(row) {
    	return row[0] + " (id: " + row[1] + ")";		
  }

  function lookupAjax(){
  	var oSuggest = $("#compose_to")[0].autocompleter;
        oSuggest.findValue();
  	return false;
  }

  
  
    $("#compose_to").autocomplete(
      '<?php echo $this->webroot;?>' + 'users/getusers',
      {
  			delay:10,
  			minChars:2,
  			matchSubset:1,
  			matchContains:1,
  			cacheLength:10,
  			onItemSelect:selectItem,
  			onFindValue:findValue,
  			formatItem:formatItem,
  			autoFill:true,			
  		}
    );
	
	
	
	function test(id){		
	    $('#hidden_to').val(id);
            $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'users/getuser_image',
                   data:{ user_id:id},
                   success: function(data) {
                        $('#compose_image').html('<img src='+ data +' width="69" height="69"/>');                                        
                   }
            });
                
	}
// end of auto complete code for compose message
</script>
