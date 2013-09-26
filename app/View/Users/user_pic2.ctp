<style>
#save_thumb{background-color: #FF8000;border: 2px solid;border-radius: 7px 7px 7px 7px;color: #FFFFFF;height: 35px;margin: 20px 102px;width: 114px;}
</style>
<?php echo $this->Html->script('jquery.imgareaselect-0.4.2.min');
echo $this->Cropimage->createJavaScript($uploaded['imageWidth'],$uploaded['imageHeight'],151,151);  
?>
<div class="container">
        	<div class="section">
				<h1>Profile Picture</h1>
                <p>Please select the area of your image to be shown</p>
            </div>
            <div class="mt50"></div>
	    <div class="section">
<?php
echo $this->Form->create('User', array('action' => 'user_pic3',"enctype" => "multipart/form-data"));   
echo $this->Cropimage->createForm($uploaded["imagePath"], 151, 151);
echo $this->Form->submit('Crop Image', array("id"=>"save_thumb",'div'=>false,'label'=>false));
echo $this->Form->end();
?>
</div>
</div>

