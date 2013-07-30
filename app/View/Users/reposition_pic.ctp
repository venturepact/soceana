<div style='background-color: #E7E7E7;margin: 6px 0;padding: 5px;'><h2>Profile Picture</h2>Please select the area of your image to be shown </div>
<?php echo $this->Html->script('jquery.imgareaselect-0.4.2.min');
echo $this->Cropimage->createJavaScript($uploaded['imageWidth'],$uploaded['imageHeight'],151,151);  
?>
<div style='background-color: #E7E7E7;margin: 6px 0;padding: 5px;'>
<?php   
    echo $this->Form->create('User', array('action' => 'user_pic3',"enctype" => "multipart/form-data"));    
    echo $this->Cropimage->createForm($uploaded["imagePath"], 151, 151);
    echo $this->Form->submit('Crop Image', array("id"=>"save_thumb",'style'=>'margin:10px;'));
    echo $this->Form->end();
?>
</div>