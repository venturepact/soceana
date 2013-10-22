<style>
.contact_form{margin-top:65px;}
label.error{ color: #FF0000 !important;font-size: 12px !important;margin: -3px 0 5px 226px !important;text-align: left !important;text-transform: none !important;width: 100% !important;}
#save_thumb{border: 2px solid;border-radius: 7px 7px 7px 7px;color: #FFFFFF;height: 35px;margin: 20px 270px;width: 114px;}
.blue{background-color:#04699A;}
.orange{background-color: #FF8000;}
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
    </div><?php
    if($this->Session->read('User.role')  == ('organizations' || 'companies')) $class = 'blue';else $class = 'orange';
echo $this->Form->submit('Upload Image', array("id"=>"save_thumb",'div'=>false,'label'=>false,'class'=>$class));?>
 

                        <div style="text-align:center;width:50%;padding-left: 62px;">or 
                        <?php
						if($this->Session->read('User.role')  == 'organizations'){?>
                         <a href="<?php echo $this->webroot;?>users/organization_profile">Cancel</a>
                        <?php }
						elseif($this->Session->read('User.role')  == 'companies'){?>
                         <a href="<?php echo $this->webroot;?>users/company_profile">Cancel</a>
                        <?php }else{?>
                        <a href="<?php echo $this->webroot;?>users/user_profile">Cancel</a>
                        <?php
						}
						?>
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