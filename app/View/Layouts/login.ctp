<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout;?></title>
<link rel="shortcut icon" href="<?php echo $this->webroot;?>img/favicon.ico"/>
<?php echo $this->Html->css('style');?>
<?php echo $this->Html->css('responsive');?>
<?php echo $this->Html->script('jquery-1.6.1.min');?>
<?php echo $this->Html->script('responsiveslides.min');?>
<?php echo $this->Html->script('jquery.validate');?>
<style>
	#login_form label.error{margin: 0 50px;color: #FF0000;}	
	#login_form2 label.error{color: #FF0000;float: left;margin: 0 -1px -3px 35px;}
	#main_section{margin-top: 60px !important;}
</style>
</head>
<body>
<!--Header Section Start -->
<header>
    <div id="header">      
          <a href="<?php echo $this->webroot;?>" class="logo"><img src="<?php echo $this->webroot;?>img/logo.png" alt="Soceana Logo" /> </a> 
                    <div class="top_nav_outer">
                         <ul class="top_nav">
			    <li>&nbsp;</li>
			 </ul>
                     </div>
    </div>  
</header>
<!--Header Section End-->    

<!--Main Section Start-->   

<div id="main_section">

	<div id="left_nav_section"><div class="tab_outer"></div></div>
	<div id="wrapper">
		<div class="login_container">
        	<div class="top_section">
		    <div class="top_form">
                	<?php echo $this->fetch('content');?>
                    <div class="clr"></div>
                    <h3>Soceana is free, and always will be. </h3>
	            </div>
            </div>
            
            
        </div>
		<div class="login_slider">
        	<img alt="login box" src="<?php echo $this->webroot;?>img/img2.jpg" width="970" />
        </div>
        
        <section class="mt50">
        	<div class="section_login_left">
            	<h1>ORGANIZATIONS</h1>
                <p>Companies and organizations that are seeking help in volunteer programs can utilize Soceana as a standardized platform to communicate with individuals who are keen to do social good. We keep a database of the hours and types of volunteering that users do; all your organization has to do is ensure their validity and they are Soceana-verified.</p>
            </div>
            
            <div class="section_login_right">
            <div><h2>ORGANIZATIONS Login</h2></div>
            <div class="clr"></div>
            <div class="mt20">
		<?php echo $this->element('organization_login');?>
            </div>
            </div>
        </section>
        
	</div></div>
    <?php echo $this->element('footer');?>
</body>
</html>
<?php print $this->Session->flash("flash", array("element" => "alert"));?>