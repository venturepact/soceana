<?php
// checking the controller and action for displaying of gallery
//if($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'display'){	
?>
	<div class="tab_outer_right">
                <div class="right_text_tab tab_font"><?php echo $this->Session->read('User.organization_name');?></div>
                <div class="red_cross_outer">
		    
		     <img src="<?php if($this->Session->read('User.thumb_image')==''){
			echo $this->webroot.'img/no_image.png';			
		     }else{
			echo $this->webroot.'img/upload/'.$this->Session->read('User.thumb_image').'?='.uniqid();
		     }
		     ?>" alt="<?php echo $this->Session->read('User.organization_name');?>"  class="profile_image"  /></div>
                <div class="right_text_tab"><span class="status_text" style='text-transform:none;'><?php
		if(strlen($this->Session->read('User.status_message')) > 0)
		{
		     if(strlen($this->Session->read('User.status_message'))>50){
			echo substr($this->Session->read('User.status_message'),0,50).'..';
		     }
		     else echo $this->Session->read('User.status_message');
		}else echo 'STATUS';
		?></span></div>
                <a href="<?php echo $this->webroot;?>users/company_profile#u_status" class="right_text_tab_small small_font">CHANGE YOUR STATUS</a>				
</div>
<?php
//}
?>