<div class="search_bar">
   	<input name="search" type="text" class="input" id="search..." size="25"  onfocus="if(this.value=='Search...') this.value='';" onBlur="if(this.value=='') this.value='Search...';" value="Search..."/>
   <input type="image" src="<?php echo $this->webroot;?>img/search_btn.jpg" name="button" id="button" value="submit" />
  </div>
          <div class="mid_left_nav">
           	  <ul>
                <li>
                <a href="<?php echo $this->webroot;?>users/user_profile"><img src="<?php echo $this->webroot;?>img/user_profile.png" width="18" height="18" /><p>Volunteer Profile</p></a>
                <span><a href="<?php echo $this->webroot;?>users/change_password">Change your password</a></span>
                </li>
                <li><a href="#" class="mid_left_nav_fade"><img src="<?php echo $this->webroot;?>img/volunteer.png" width="18" height="18" /><p>Volunteer</p></a></li>
                <li><a href="<?php echo $this->webroot;?>loghours/add"><img src="<?php echo $this->webroot;?>img/log_hours.png" width="18" height="18" /><p>Log Hours</p></a></li>
           	  </ul>
          </div>
          <div class="left_profile_nav">
           	  <div class="heading_gray"><a href="#">Help</a></div>
	</div>
	   <div class="left_profile_nav">
            <div class="heading_gray"><a href="<?php echo $this->webroot;?>users/logout">Logout</a></div>
         </div>