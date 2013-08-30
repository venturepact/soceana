<style>
.submit{margin: 2px 190px;float: left;}
</style>
<div class="container">
        	<div class="section">
				<h1>Profile Picture</h1>
                <p>Please upload the picture to be shown on profile page (Only JPG,PNG or GIF images Allowed)</p>
            </div>
            <div class="mt50"></div>
	    <div class="section">
<?php echo $this->Form->create('User', array('action' => 'user_pic2', "enctype" => "multipart/form-data"));  ?>
    <div class="contact_form">
        <label name="name">Profile Image</label>
            <?php echo $this->Form->input('image',array("type" => "file",'div'=>false,'label'=>false));?>
    </div>
    <div class="contact_form">
        <input type='submit' value='' class='submit'>
    </div>
<?php
    echo $this->Form->end();
?>
</div>
