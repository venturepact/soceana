<style>
#save_thumb{border: 2px solid;border-radius: 7px 7px 7px 7px;color: #FFFFFF;height: 35px;margin: 20px 102px;width: 114px;}
.blue{background-color:#04699A;}
.orange{background-color: #FF8000;}
</style>
<?php echo $this->Html->script('jquery.imgareaselect-0.4.2.min');
echo $this->Cropimage->createJavaScript($uploaded['imageWidth'],$uploaded['imageHeight'],300,300);  
?>
<div class="container">
        	<div class="section">
				<h1>Profile Picture</h1>
                <p>Please select the area of your Main Selection image to be shown on the preview image.</p>
            </div>
            <div class="mt50"></div>
	    <div class="section">
<?php
echo $this->Form->create('User', array('action' => 'user_pic3',"enctype" => "multipart/form-data"));   
echo $this->Cropimage->createForm($uploaded["imagePath"], 300, 300);
if($this->Session->read('User.role')  == ('organizations' || 'companies')) $class = 'blue';else $class = 'orange';
echo $this->Form->submit('Crop Image', array("id"=>"save_thumb",'div'=>false,'label'=>false,'class'=>$class));?>
 <div class="clr"></div>
                        <div style="text-align:center;width:50%;">or  <?php
						if($this->Session->read('User.role')  == 'organizations'){?>
                         <a href="<?php echo $this->webroot;?>users/organization_profile">Cancel</a>
                        <?php }
						elseif($this->Session->read('User.role')  == 'companies'){?>
                         <a href="<?php echo $this->webroot;?>users/company_profile">Cancel</a>
                        <?php }else{?>
                        <a href="<?php echo $this->webroot;?>users/user_profile">Cancel</a>
                        <?php
						}
						?></div>
<?php echo $this->Form->end();
?>
</div>
</div>
