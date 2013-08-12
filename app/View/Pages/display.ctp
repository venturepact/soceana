<script type="text/javascript" src="<?php echo $this->webroot;?>Charts/FusionCharts.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>assets/prettify/prettify.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>assets/ui/js/json2.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>assets/ui/js/lib.js" ></script>
<?php
/* @ check if the role of current logged in user is organzation or normal volunteer
 *  @ set dashboard accordingly
 */
    if($this->Session->read('User.role') == 'organizations') {
    ?>
    <div class="mid_right">
                <div class="mid_sub_left">
                    <div class="main_heading">ORGANIZATION ANALYTICS</div>
                </div>
                <div class="mid_sub_right">
                    <div class="next_steps">
                        <h1>NEXT STEPS</h1>
                        <a href="#"><img src="<?php echo $this->webroot;?>img/75.png" width="94" height="95"/></a>
                        <p><a href="#">Complete your Profile<br />
                        You are 75% complete.</a></p>
                        <div class="next_steps_footer"><img src="<?php echo $this->webroot;?>img/next_step_footer.png" width="238" height="9" /></div>
                    </div>
                </div>
                <div class="tabel_content_main">
                  <div class="records_perpage_main">
                        <div class="records_perpage_left">
                          <label for="select"></label>
                         <?php echo $this->Form->create('Pages');?>
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
                        Records Per Page</div>
                        <!--<div class="records_perpage_right">
                        Search : 
                          <label for="textfield"></label>
                          <input type="text" name="textfield" id="textfield" />
                        </div>-->
                  </div>
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main_table">
                      <tr>
                        <td width="21%" class="category_heading"><a href="#">Category</a></td>
                        <td width="29%" align="center" class="sub_category_heading"><a href="#">Type of Volunteering</a></td>
                        <td width="28%" align="center" class="sub_category_heading"><a href="#">Volunteer</a></td>
                        <td width="9%" align="center" class="sub_category_heading"><a href="#">Hours</a></td>
                        <td width="13%" align="center" class="sub_category_heading"><a href="#">Date</a></td>
                      </tr>
                     <?php                      
                      $i = 0;                     
                      foreach($loghours as $log_hour){
                        ?>
                        <tr>
                        <td align="center" class="<?php if($i==0) echo 'tabel_grid_white';else echo 'tabel_grid_gray';?>"><a href="#"><?php echo $log_hour['Category']['category_name'];?></a></td>
                        <td align="center" class="<?php if($i==0) echo 'tabel_grid_white';else echo 'tabel_grid_gray';?>"><a href="#"><?php echo $log_hour['ServiceType']['name'];?></a></td>
                        <td align="center" class="<?php if($i==0) echo 'tabel_grid_white';else echo 'tabel_grid_gray';?>"><a href="#"><?php echo $log_hour['User']['first_name'].' '.$log_hour['User']['last_name'];?></a></td>
                        <td align="center" class="<?php if($i==0) echo 'tabel_grid_white';else echo 'tabel_grid_gray';?>"><a href="#"><?php echo $log_hour['LogHour']['hours'];?></a></td>
                        <td align="center" class="<?php if($i==0) echo 'tabel_grid_white';else echo 'tabel_grid_gray';?>"><a href="#"><?php echo $log_hour['LogHour']['job_date'];?></a></td>
                     </tr>
                        <?php
                        if($i == 1)$i=0;else $i=1;                        
                      }
                      ?>
                      <tr>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                      </tr>
                    </table>
                    <div class="pagination_main">
                        <div class="pagination_left">
                          <p class="dark_gray"><?php echo $this->Paginator->counter('Showing {:start} to {:end} of {:count} entries');?></p>
                      </div>
                      <div class="pagination_right">
                        <section class="container" id="pagination">
                            <nav class="pagination" id="pagination">
                               <?php echo $this->Paginator->prev(' << ' . __('previous'), array(), null, array('class' => ''));?>
                               <?php echo $this->Paginator->next( __('Next') .' >> '  , array(), null, array('class' => ''));?>
                            </nav>
                            </section>
                        </div>
                  </div>
                  <h5>SOCIAL TIDES CREATED - ANALYTICS</h5>
                   <div id="chartdiv2" align="center">Chart will load here</div>
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
                  
                  <div class="work_graph2">
                  <img src="<?php echo $this->webroot;?>img/work_graph4.jpg" width="700" height="344" /><br />
                  <br />
                  <img src="<?php echo $this->webroot;?>img/org_analytics_adv.jpg" width="669" height="130" /></div>
                </div>  
              </div>
    <?php
    }else{
    ?>
    <div class="mid_right">
                <div class="mid_sub_left">
                    <div class="main_heading">VOLUNTEER ANALYTICS</div>
                </div>
                <div class="mid_sub_right">
                    <div class="next_steps">
                        <h1>NEXT STEPS</h1>
                        <a href="#"><img src="<?php echo $this->webroot;?>img/75.png" width="94" height="95"/></a>
                        <p><a href="#">Complete your Profile<br />
                        You are 75% complete.</a></p>
                        <div class="next_steps_footer"><img src="<?php echo $this->webroot;?>img/next_step_footer.png" width="238" height="9" /></div>
                    </div>
                </div>
                <div class="tabel_content_main">
                  <div class="records_perpage_main">
                        <div class="records_perpage_left">
                          <label for="select"></label>
                          <?php echo $this->Form->create('Pages');?>
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
                      Records Per Page</div>
                        <!--<div class="records_perpage_right">
                        Search : 
                          <label for="textfield"></label>
                          <input type="text" name="textfield" id="textfield" />
                        </div>-->
                  </div>
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main_table">
                      <tr>
                        <td width="21%" class="category_heading"><a href="#">Category</a></td>
                        <td width="29%" align="center" class="sub_category_heading"><a href="#">Type of Volunteering</a></td>
                        <td width="28%" align="center" class="sub_category_heading"><a href="#">Organization</a></td>
                        <td width="9%" align="center" class="sub_category_heading"><a href="#">Hours</a></td>
                        <td width="13%" align="center" class="sub_category_heading"><a href="#">Date</a></td>
                      </tr>
                      <?php                      
                      $i = 0;
                      foreach($loghours as $log_hour){
                        ?>
                        <tr>
                        <td align="center" class="<?php if($i==0) echo 'tabel_grid_white';else echo 'tabel_grid_gray';?>"><a href="#"><?php echo $log_hour['Category']['category_name'];?></a></td>
                        <td align="center" class="<?php if($i==0) echo 'tabel_grid_white';else echo 'tabel_grid_gray';?>"><a href="#"><?php echo $log_hour['ServiceType']['name'];?></a></td>
                        <td align="center" class="<?php if($i==0) echo 'tabel_grid_white';else echo 'tabel_grid_gray';?>"><a href="#"><?php echo $log_hour['User']['organization_name'];?></a></td>
                        <td align="center" class="<?php if($i==0) echo 'tabel_grid_white';else echo 'tabel_grid_gray';?>"><a href="#"><?php echo $log_hour['LogHour']['hours'];?></a></td>
                        <td align="center" class="<?php if($i==0) echo 'tabel_grid_white';else echo 'tabel_grid_gray';?>"><a href="#"><?php echo $log_hour['LogHour']['job_date'];?></a></td>
                     </tr>
                        <?php
                        if($i == 1)$i=0;else $i=1;                        
                      }
                      ?>  
                      <tr>
                        <td colspan="5" align="center" class="social_good"><a href="#">Add New Social Good</a></td>
                      </tr>
                    </table>
                    <div class="pagination_main">
                        <div class="pagination_left">
                          <p class="dark_gray"><?php echo $this->Paginator->counter('Showing {:start} to {:end} of {:count} entries');?></p>
                      </div>
                      <div class="pagination_right">
                        <section class="container" id="pagination">
                            <nav class="pagination" id="pagination">
                               <?php echo $this->Paginator->prev(' << ' . __('previous'), array(), null, array('class' => ''));?>
                               <?php echo $this->Paginator->next( __('Next') .' >> '  , array(), null, array('class' => ''));?>
                            </nav>
                            </section>
                        </div>
                  </div>
                  <h5>SOCIAL TIDES CREATED - ANALYTICS</h5>                 
                    <div id="chartdiv" align="center">Chart will load here</div>
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
                    
                     <div id="chartdiv2" align="center">Chart will load here</div>
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
                </div>  
              </div>     
    <?php      
    }
?>