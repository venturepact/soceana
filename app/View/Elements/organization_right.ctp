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
                <div class="right_text_tab "><span class="status_text" style='text-transform:none;'><?php
		if(strlen($this->Session->read('User.status_message')) > 0)
		{
		     if(strlen($this->Session->read('User.status_message'))>50){
			echo "<a href='javascript:void(0);' title='".$this->Session->read('User.status_message')."'>".substr($this->Session->read('User.status_message'),0,50).'..</a>';
		     }
		     else echo $this->Session->read('User.status_message');
		}else echo 'STATUS';
		?></span></div>
                <a href="<?php echo $this->webroot;?>users/organization_profile#u_status" class="right_text_tab_small small_font">CHANGE YOUR STATUS</a>	
                
                <?php
				 if(($this->params['controller'] == 'pages' && $this->params['action'] == 'display') || ( $this->params['controller'] == 'log_hours' && $this->params['action'] == 'review_hours')){
			     ?>
                <div class="right_img_outer">
               <?php		   	 
			   	   $array = $this -> requestAction(array(
					 'controller' => 'users',
					 'action' => 'gallery_images2'
					));
					//pr($array);
					$i=1;
					foreach($array as $image):
					?>
                        <div class="gallery_img<?php echo $i;?>"><a href="javascript:void(0);" title="<?php echo $image['UserPic']['caption'];?>"><img src="<?php echo $this->webroot;?>img/user_pics/<?php echo $image['UserPic']['picture_url'];?>" alt="" width="240px" height="175" style='cursor:default;' /></a></div>                       
                <?php
					$i++;
					endforeach;
				?>
                </div>
                <?php }?>			
</div>
<?php
//}
?>