<div style='background-color: #E7E7E7;margin: 6px 0;padding: 5px;'><h2>Profile Picture</h2>Please upload the picture to be shown on profile page</div>
<?php echo $this->Form->create('User', array('action' => 'user_pic2', "enctype" => "multipart/form-data"));?>
<div style='background-color: #E7E7E7;margin: 6px 0;padding: 5px;'>
<?php
   // echo $form->input('name');
    echo $this->Form->input('image',array("type" => "file")); 
    echo $this->Form->end('Upload');
?></div>
