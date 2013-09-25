<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Soceana</title>
 <?php echo $this->Html->css('style');?>
 <?php echo $this->Html->css('responsive');?>
 <?php echo $this->Html->script('jquery-1.6.1.min');?>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
 <script src="http://malsup.github.com/jquery.form.js"></script>
<link rel="shortcut icon" href="<?php echo $this->webroot;?>img/favicon.ico"/>
<?php
/* @ check if the role of current logged in user if user is not logged in
*/
if($this->Session->read('User.role')==''){
?>
<style>
	#main_section{margin-top: 60px !important;}
</style>
<?php
}
?>
</head>
<body>
<!--Header Section Start -->
<?php echo $this->element('header');?>
<!--Header Section End-->
<!--Main Section Start-->  
<div id="main_section">
	<div id="left_nav_section"><div class="tab_outer"></div></div>
	<div id="wrapper">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content');?>
	</div></div>
<?php echo $this->element('footer');?>
<script type="text/javascript">
   var _usersnapconfig = {
       apiKey: '6365b0be-a9d7-4f13-a288-c7ec7afe03fd',
       valign: 'bottom',
       halign: 'right',
       tools: ["pen", "highlight", "note"],
       lang: 'en',
       commentBox: true,
       emailBox: true
   }; 
   (function() {
       var s = document.createElement('script');
       s.type = 'text/javascript';
       s.async = true;
       s.src = '//api.usersnap.com/usersnap.js';
       var x = document.getElementsByTagName('head')[0];
       x.appendChild(s);
   })();
</script>
</body>
</html>
