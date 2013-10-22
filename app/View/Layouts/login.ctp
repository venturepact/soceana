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
 <script type="text/javascript">

$(document).ready(function(){
	
	$('.bxslider').bxSlider({
                 mode: 'horizontal',
                 slideMargin: 3,
                 auto:true
   });             
  
//open popup
$(".pop").click(function(){
$(".popup_outer").fadeIn(1000);
  positionPopup();
  
});

//close popup
$("#close").click(function(){
	$(".popup_outer").fadeOut(500);
});
});

//position the popup at the center of the page
function positionPopup(){
  if(!$(".popup_outer").is(':visible')){
    return;
  }
   
   /* position of scroll of screen from top to 500px*/
   $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
	/* 
  $(".popup_outer").css({
      //left: ($(window).width() - $('#overlay_form').width()) / 2,
      //top: ($(window).width() - $('#overlay_form').width()) / 7,
      //position:'absolute'
  });
  */
}
</script>
<script type="text/javascript">
$(function() {  
    $('#forgot_submit').click(function(){
	$('#forgot_message').html('<img src="<?php echo $this->webroot;?>img/loading.gif">');	
	var forgot_email_id = $('#forgot_email_id').val();
	
	if (forgot_email_id == '') {
		$('#forgot_message').html('Please enter your email id first');	
	}
	else{
	    
	    var reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	    if (reg.test(forgot_email_id) == false) 
	    {
		$('#forgot_message').html('Please enter a valid email id');
	    }
	    else{
		var new_url = "<?php echo $this->webroot;?>" + "users/forgot_password/" + forgot_email_id;
		
		$.ajax({
			type: "POST",
			url: new_url,
			data: forgot_email_id,
			success: function(data) {//alert('here');
				$('#forgot_email_id').val("");
				$('#forgot_message').html(data);
				$('#fp_message').fadeOut(10000);				
			}
		});		
	    }	
	    	
	}
    });	
});
</script>
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
        <!-- forgot password popup box-->
        <div class="popup_outer">
                        <form id="overlay_form">
                            <h2 class="popup_heading">Forgot Password</h2>
                            <p class="popup_text">
				That's Okey! Everone Forgets<br />
				Just tell us the email address you used to create your account and we'll send you a new one!
				<div id='forgot_message'></div>
			    </p>
                            <label class="popup_text lb_email">Email: </label>
			    <?php echo $this->Form->input('User.email_id',array('type'=>'text','div'=>false,'label'=>false,'class'=>'text_outer_border','id' => 'forgot_email_id','maxlength'=>'50'));?>
                            <!--<input type="text" name="username" style="width:435px;"/>--><br /><br />
                            <img src="<?php echo $this->webroot;?>img/password_reset.png" id="forgot_submit" class='cursor_grid'/><br /><br />
                            <p><a href="#" style="color:#666" ></a></p>
                            <a href="javascript:void(0);" id="close" class="popup_text">Close</a>
                        </form>
                        </div>
         <!-- /forgot password popup box ends here-->
         <!-- slider div -->
		<!--Testimonials Start-->
	<script src="<?php echo $this->webroot;?>rotating-testimonial/jquery.bxslider.min.js" type="text/javascript"></script>
	
	<div>
		<ul class="bxslider">
			<li>
				<blockquote>Be The Change You Wish To See In The World <img src="<?php echo $this->webroot;?>img/open-quote1.png" width="37" height="41" alt="" />
				<p style="text-align:right;margin-right:20px;">- Mahatma Gandhi</p>	
				</blockquote>
				</li>
		    <li>
             	<blockquote>One is not born into the world to do everything but to do something.<img src="<?php echo $this->webroot;?>img/open-quote1.png" width="37" height="41" alt="" />
				<p style="text-align:right;margin-right:20px;">- Henry David Thoreau</p>
				</blockquote>
			</li>	
              <li>
             	<blockquote>In a gentle way you can shake the world<img src="<?php echo $this->webroot;?>img/open-quote1.png" width="37" height="41" alt="" />
				<p style="text-align:right;margin-right:20px;">- Mahatma Gandhi</p>
				</blockquote>
			</li>
            <li>
             	<blockquote >Go into the world and do well. But more importantly, go into the world and do good.<img src="<?php echo $this->webroot;?>img/open-quote1.png" width="37" height="41" alt="" />
				<p style="text-align:right;margin-right:20px;">-  Minor Myers</p>
				</blockquote>
			</li>
            
             <li>
             	<blockquote>The least movement is of importance to all nature. The entire ocean is affected by a pebble.<img src="<?php echo $this->webroot;?>img/open-quote1.png" width="37" height="41" alt="" />
				<p style="text-align:right;margin-right:20px;">-  Blaise Pascal </p>
				</blockquote>
			</li>
            
             <li>
             	<blockquote>Every drop in the ocean counts.<img src="<?php echo $this->webroot;?>img/open-quote1.png" width="37" height="41" alt="" />
				<p style="text-align:right;margin-right:20px;">-  Yoko Ono</p>
				</blockquote>
			</li>
            
              <li>
             	<blockquote>We can choose to be affected by the world or we can choose to affect the world.<img src="<?php echo $this->webroot;?>img/open-quote1.png" width="37" height="41" alt="" />
				<p style="text-align:right;margin-right:20px;">-   Heidi Wills</p>
				</blockquote>
			</li>
            	
		</ul>
	</div>
	<!--Testimonials End-->
        <!--/ slider div-->
        
        <section class="mt50">
        	<div class="section_login_left">
            	<h1>ORGANIZATIONS &amp COMPANIES</h1>
                <p>Companies and organizations that are seeking help in volunteer programs can utilize Soceana as a standardized platform to communicate with individuals who are keen to do social good. We keep a database of the hours and types of volunteering that users do; all your organization has to do is ensure their validity and they are Soceana-verified.</p>
            </div>
            
            <div class="section_login_right">
            <div><h2>ORG/COMPANY Login</h2></div>
            <div class="clr"></div>
            <div class="mt20">
		<?php echo $this->element('organization_login');?>
            </div>
            </div>
        </section>
        
	</div></div>
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
<?php print $this->Session->flash("flash", array("element" => "alert"));?>