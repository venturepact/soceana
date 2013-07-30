<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Soceana</title>
    <?php echo $this->Html->css('style');?>
    <?php echo $this->Html->script('jquery-1.6.1.min');?>
    <link rel="shortcut icon" href="<?php echo $this->webroot;?>img/favicon.ico"/>
</head>

<body>
<div id="main_page"> 
	<div id="wrap">
    	<div id="content_area">
       	  <div id="header_inner_pages">
            	<div class="logo_inner"><a href="<?php echo $this->webroot;?>"><img src="<?php echo $this->webroot;?>img/logo_inner.png" width="344" height="95" /></a></div>
       	  </div>
          <div class="mid_mid_outr">
          	<div class="mid_left">
                    <div class="search_bar">           	
               
            </div>
          	<!--<div class="search_bar">
            	<input name="search" type="text" class="input" id="search..." size="25"  onfocus="if(this.value=='Search...') this.value='';" onblur="if(this.value=='') this.value='Search...';" value="Search..."/>
               <input type="image" src="<?php echo $this->webroot;?>img/search_btn.jpg" name="button" id="button" value="submit" />
            </div>
            <div class="mid_left_nav">
            	<ul>
                <li>
                <a href="page5-profile_page.html"><img src="<?php echo $this->webroot;?>img/user_profile.png" width="18" height="18" /><p>USER PROFILE</p>
                </a></li>
            	</ul>
            </div>
            <div class="left_profile_nav">
              <div class="heading_gray"><a href="help.html">Help</a></div>
            </div>
            -->            
          </div>
          	<div class="profile_content_main">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content');?>
          </div>
          </div>
        </div>
    </div>
    <div id="inner_footer_main">
	<div id="inner_footer_wrap">
            <div id="inner_footer_content_area"> <div class="footer_link_inner">
                    <p><a href="#">Management</a></p>
                    <p><a href="#">Vision/Tenets</a></p>
                    <p><a href="#">FAQ</a></p>
                 <p><a href="#">Logout</a></p> 
                </div>
                <div class="inner_footer_logo">
                	<img src="<?php echo $this->webroot;?>img/soceana_white_logo.png" width="397" height="113" />
                </div>
               <div class="inner_footer_social"> 
                	<a href="https://www.facebook.com/" target="_blank"><img src="<?php echo $this->webroot;?>img/facebook_icon.png" style="border:none;" /></a>
                	<a href="https://twitter.com/" target="_blank"><img src="<?php echo $this->webroot;?>img/twitter_icon.png" style="border:none;" /></a>
                </div>     
            </div>
    </div>
</div>
</div>
</body>
</html>
