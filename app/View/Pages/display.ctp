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
                          <select name="select" id="select">
                            <option value="10">10</option>
                          </select> 
                      Records Per Page</div>
                        <div class="records_perpage_right">
                        Search : 
                          <label for="textfield"></label>
                          <input type="text" name="textfield" id="textfield" />
                        </div>
                  </div>
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main_table">
                      <tr>
                        <td width="21%" class="category_heading"><a href="#">Category</a></td>
                        <td width="29%" align="center" class="sub_category_heading"><a href="#">Type of Volunteering</a></td>
                        <td width="28%" align="center" class="sub_category_heading"><a href="#">Volunteer</a></td>
                        <td width="9%" align="center" class="sub_category_heading"><a href="#">Hours</a></td>
                        <td width="13%" align="center" class="sub_category_heading"><a href="#">Date</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_gray"><a href="#">Hospital</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Emergency Room</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">HUP</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">7</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">5/27/2013</a></td>
                     </tr>
                      <tr>
                        <td align="center" class="tabel_grid_white"><a href="#">NGO</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Suicide Hotline</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Drug Prevention</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">4</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">5/20/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_gray"><a href="#">School</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Working with Intercity Youth</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Philadelphia</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">3</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">5/2/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_white"><a href="#">Community Service</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Manna on Main Street</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Manna on Main Street</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">2</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">4/13/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_gray"><a href="#">Hospital</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Doctor Shadowing</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">VA </a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">5</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">4/12/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_white"><a href="#">Community Service</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Cleaning up Clark Park</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Bureau of Community Affairs</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">5</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">3/27/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_gray"><a href="#">Community Service</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">5K Run or Dye</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Philly Run or Dye</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">6.5</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">3/25/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_white"><a href="#">Hospital</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Emergency Room</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">HUP</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">2</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">2/20/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_gray"><a href="#">Hospital</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Filing</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">HUP</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">3</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">1/31/2013</a></td>
                      </tr>
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
                          <p class="dark_gray">Showing 1 to 10 of 57 entries</p>
                      </div>
                      <div class="pagination_right">
                        <section class="container" id="pagination">
                            <nav class="pagination" id="pagination">
                              <a href="#" class="prev">< Previous</a>
                              <a href="#">1</a>
                              <a href="#">2</a>
                              <a href="#">3</a>
                              <span>4</span>
                              <a href="#">5</a>
                              <a href="#" class="next">Next ></a>
                            </nav>
                            </section>
                        </div>
                  </div>
                  <h5>SOCIAL TIDES CREATED - ANALYTICS</h5>
                  <div class="work_graph"><span class="work_graph"><img src="<?php echo $this->webroot;?>img/work_graph3.1.jpg" width="700" height="385" /></span></div>
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
                          <select name="select" id="select">
                            <option value="10">10</option>
                          </select> 
                      Records Per Page</div>
                        <div class="records_perpage_right">
                        Search : 
                          <label for="textfield"></label>
                          <input type="text" name="textfield" id="textfield" />
                        </div>
                  </div>
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main_table">
                      <tr>
                        <td width="21%" class="category_heading"><a href="#">Category</a></td>
                        <td width="29%" align="center" class="sub_category_heading"><a href="#">Type of Volunteering</a></td>
                        <td width="28%" align="center" class="sub_category_heading"><a href="#">Organization</a></td>
                        <td width="9%" align="center" class="sub_category_heading"><a href="#">Hours</a></td>
                        <td width="13%" align="center" class="sub_category_heading"><a href="#">Date</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_gray"><a href="#">Hospital</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Emergency Room</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">HUP</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">7</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">5/27/2013</a></td>
                     </tr>
                      <tr>
                        <td align="center" class="tabel_grid_white"><a href="#">NGO</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Suicide Hotline</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Drug Prevention Organization</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">4</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">5/20/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_gray"><a href="#">School</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Working with Intercity Youth</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Philadelphia School</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">3</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">5/2/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_white"><a href="#">Community Service</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Manna on Main Street</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Manna on Main Street</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">2</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">4/13/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_gray"><a href="#">Hospital</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Doctor Shadowing</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">VA Hospital</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">5</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">4/12/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_white"><a href="#">Community Service</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Cleaning up Clark Park</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Bureau of Community Affairs</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">5</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">3/27/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_gray"><a href="#">Community Service</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">5K Run or Dye</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Philly Run or Dye</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">6.5</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">3/25/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_white"><a href="#">Hospital</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">Emergency Room</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">HUP</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">2</a></td>
                        <td align="center" class="tabel_grid_white"><a href="#">2/20/2013</a></td>
                      </tr>
                      <tr>
                        <td align="center" class="tabel_grid_gray"><a href="#">Hospital</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">Filing</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">HUP</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">3</a></td>
                        <td align="center" class="tabel_grid_gray"><a href="#">1/31/2013</a></td>
                      </tr>
                      <tr>
                        <td colspan="5" align="center" class="social_good"><a href="#">Add New Social Good</a></td>
                      </tr>
                    </table>
                    <div class="pagination_main">
                        <div class="pagination_left">
                          <p class="dark_gray">Showing 1 to 10 of 57 entries</p>
                      </div>
                      <div class="pagination_right">
                        <section class="container" id="pagination">
                            <nav class="pagination" id="pagination">
                              <a href="#" class="prev">< Previous</a>
                              <a href="#">1</a>
                              <a href="#">2</a>
                              <a href="#">3</a>
                              <span>4</span>
                              <a href="#">5</a>
                              <a href="#" class="next">Next ></a>
                            </nav>
                            </section>
                        </div>
                  </div>
                  <h5>SOCIAL TIDES CREATED - ANALYTICS</h5>
                  <div class="work_graph">
                    <img src="<?php echo $this->webroot;?>img/work_graph.jpg" width="512" height="255" />
                  </div>
                  <div class="work_graph2">
                  <img src="<?php echo $this->webroot;?>img/work_graph3.png" width="700" height="385" />
                  </div>
                </div>  
              </div>
    <?php      
    }
?>