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
<?php echo $this->Html->css('jquery.autocomplete');?>
<?php echo $this->Html->script('jquery.autocomplete');?>
</head>
<body>
<script>
function show(){
	$('#upper_box').toggle('show');
}
</script>
<!--Header Section Start -->
<?php echo $this->element('header');?>
<!--Header Section End-->
<!--Main Section Start-->   
<div id="main_section">
	<!--left section-->
	<div id="left_nav_section">
		<?php
		  /* @ check if the role of current logged in user is organzation or normal volunteer
		  *  @ we use that element according to required profile
		  */
		  if($this->Session->read('User.role')!=''){
		  if($this->Session->read('User.role') == 'organizations') echo $this->element('organization_left');
		  elseif($this->Session->read('User.role') == 'companies') echo $this->element('company_left');
		  else echo $this->element('user_left');
		  }else{ echo '&nbsp;';}
		?>
        </div>
	<!-- /left section-->
	<div id="wrapper">
		<?php echo $this->Session->flash(); ?>
   		<?php echo $this->fetch('content');?>
        <!-- messages div starts-->
        <?php echo $this->element('messages');?>
        <!-- / of messages div-->
	</div>         
	<div class="index"></div>
	
    <div id="right_img_section">
		<?php
		/* @ check if the role of current logged in user is organzation or normal volunteer
		*  @ we use that element according to required profile
		*/
		if($this->Session->read('User.role')!=''){
		if($this->Session->read('User.role') == 'organizations') echo $this->element('organization_right');
		elseif($this->Session->read('User.role') == 'companies') echo $this->element('company_right');
		else echo $this->element('user_right');
		}else{ echo '&nbsp;';}
		?>
	</div>
</div>
  <?php echo $this->element('footer');?>
<script type="text/javascript">
   var _usersnapconfig = {
       apiKey: '6365b0be-a9d7-4f13-a288-c7ec7afe03fd',
       valign: 'bottom',
       halign: 'left',
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
