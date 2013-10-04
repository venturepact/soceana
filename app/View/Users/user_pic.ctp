<style>
.submit{margin: 2px 190px;float: left;}
.contact_form{margin-top:65px;}
label.error{ color: #FF0000 !important;font-size: 12px !important;margin: -3px 0 5px 226px !important;text-align: left !important;text-transform: none !important;width: 100% !important;}
</style>
<?php echo $this->Html->script('jquery.validate');?>
<script src="http://jquery.bassistance.de/validate/additional-methods.js"></script>
<div class="container">
        	<div class="section">
				<h1>Profile Picture</h1>
                <p>Please upload the picture to be shown on profile page (Only JPG,PNG or GIF images Allowed and size should be below 2 MB)</p>
            </div>
            <div class="mt50"></div>
	    <div class="section">
<?php echo $this->Form->create('User', array('action' => 'user_pic2', "enctype" => "multipart/form-data",'id'=>'form2','name'=>'form1'));  ?>
    <div class="contact_form">
        <label name="name">Profile Image</label>
            <?php echo $this->Form->input('image',array("type" => "file",'div'=>false,'label'=>false,'id'=>'image-file'));?>
    </div>
    <div class="contact_form">
        <input type='submit' value='' class='submit' >
        <div class="clr"></div>
                        <div style="text-align:center;width:50%;">or <a href="<?php echo $this->webroot;?>users/user_profile">Cancel</a></div>
    </div>
<?php
    echo $this->Form->end();
?>
<script type='text/javascript' language='javascript'>    
$().ready(function() {   
     
	
        // validate signup form on keyup and submit
        $("#form2").validate({
            rules: {
                        "data[User][image]": {
                          required: true,  
						  extension: "png|jpe?g|gif"                       
                        },                       	
                    }
                    ,
                messages:{
                       "data[User][image]": {
                            required: 'Please select image to upload',
							extension:'Please select valid image, For eg. jpg / gif / png'
			                },                         	               
                },
            errorElement: 'label',
            errorClass: 'error help-block',
            errorPlacement: function(error, element){
                if(element.is('input[type="checkbox"]')){
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },                                        
        });                    
});
</script>
</div>
</div>
<script language='JavaScript'>
 $('#form2').bind('submit', function() {	
           // Get the file
		var file = $('input[type="file"]').get(0).files[0];
		// File size, in bytes
	    var size = file.size;

		if(size/1024/1024 > 2){
		    alert('Please upload picture below 2 MB');
			return false;
		}	
});

 </script>