<!DOCTYPE html>
<html>
<head>
    <title>
	<?php echo $title_for_layout;?>
    </title>
    <link rel="shortcut icon" href="<?php echo $this->webroot;?>img/favicon.ico"/>
    <?php echo $this->Html->css('style');?>
    <?php echo $this->Html->script('jquery-1.6.1.min');?>
    <?php echo $this->Html->script('responsiveslides.min');?>
    <script type="text/javascript">

$(document).ready(function(){
//open popup
$("#pop").click(function(){
  $("#overlay_form").fadeIn(1000);
  positionPopup();
});

//close popup
$("#close").click(function(){
	$("#overlay_form").fadeOut(500);
});
});

//position the popup at the center of the page
function positionPopup(){
  if(!$("#overlay_form").is(':visible')){
    return;
  } 
  $("#overlay_form").css({
      left: ($(window).width() - $('#overlay_form').width()) / 2,
      top: ($(window).width() - $('#overlay_form').width()) / 7,
      position:'absolute'
  });
}
    // You can also use "$(window).load(function() {"
    $(function () {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        maxwidth: 800,
        speed: 400
      });
	  
      // Slideshow 4
     

    });
//maintain the popup at center of the page when browser resized
$(window).bind('resize',positionPopup);
$('a[href=#top]').click(function(){
     $("html, body").animate({ scrollTop: 0 }, "slow");
	return false;
});
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
<body class="login_page">
<div id="main_page"> 
	<div id="wrap">
    	<div id="content_area">
            <div class="logo"><img src="<?php echo $this->webroot;?>img/logo.png"/></div>
            <div class="login_main">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
            	<div class="login_left">
                	<div class="login">
                            <?php echo $this->fetch('content');?>
                  	</div>
                      
                       <br />
                       <div class="popup">
                        <form id="overlay_form" style="display:none">
                            <h2 class="popup_heading">Forget Password</h2>
                            <p class="popup_text">
				That's Okey! Everone Forgets<br />
				Just tell us the email address you used to create your account and we'll send you a new one!
				<div id='forgot_message' style="float:left;width:100%;color:#ff0000;margin:5px 1px"></div>
			    </p>
                            <label class="popup_text">Email: </label>
			    <?php echo $this->Form->input('User.email_id',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:435px;','id' => 'forgot_email_id','maxlength'=>'50'));?>
                            <!--<input type="text" name="username" style="width:435px;"/>--><br /><br />
                            <img src="<?php echo $this->webroot;?>img/password_reset.png" id="forgot_submit" /><br /><br />
                            <p><a href="#" style="color:#666" ></a></p>
                            <a href="javascript:void(0);" id="close" class="popup_text">Close</a>
                        </form>
                        </div>
              	</div>
                <div class="login_right"><h1>or scroll <span><a href='#down'>down</a></span> to sign up</h1></div>
            </div>
            
            
            <div class="separators"><img src="<?php echo $this->webroot;?>img/separators.png" width="998" height="105" /></div>
            <div class="category_text" id='down'>select your category to sign up</div>
            <div class="graph_bg">
            	<div class="graph_text">
                    <div class="rslides" id="slider1">
                    <div style="padding-top:45px; padding-left:18px;">
                    To See In The World
                    Be The 
                    Change You Wish <br />
                    To See In The World <br />
                    <h2>-Mahatma Gandhi-</h2>
                    </div>
                    
                      
                    <div style="padding-top:45px; padding-left:25px;">
                    In a gentle way <br />
                    you can shake the world <br />
                    <h2>-Mahatma Gandhi-</h2>
                    </div>
                    
                    </div>
                    
                </div>
                <div class="com_box_blue">
                	<p>
                    	<a href="#top">Current<br />
				   		Volunteers
                        </a>
                    	<a class="com_box_anchor" href="#top"></a>
                    </p>
                </div>
                <div class="com_box_green">
                	<p>
                    	<a href="<?php echo $this->webroot;?>users/add/organizations">New <br />Organizations</a>
                    	<a class="com_box_anchorgreen" href="<?php echo $this->webroot;?>users/add/organisations/"></a>
                    </p>
                </div>
                <div class="com_box_orange">
                	<p>
                    	<a href="<?php echo $this->webroot;?>users/add/user">New<br />
				   		Volunteers</a>
                        <a class="com_box_anchororange" href="<?php echo $this->webroot;?>users/add/user"></a>
                    </p>
                    </a>
                   
                </div>
            </div>
             	
      </div>
    </div>
</div>
<div id="footer_main">
	<div id="footer_wrap">
    	<div class="footer_shd">
        	<div class="footer_link">
                <p>&copy; 2013 Soceana</p>
                <p><a href="<?php echo $this->webroot;?>pages/management">Management</a></p> 
                <p><a href="<?php echo $this->webroot;?>pages/vision">Vision/Tenets</a></p>
                <p><a href="<?php echo $this->webroot;?>pages/faq">FAQ</a></p> 
            </div>
        </div>
        <div id="footer_content_area">
            <img src="<?php echo $this->webroot;?>img/soceana_white_logo.png" width="397" height="113" />
            
        </div>
    </div>
</div>
</body>
</html>