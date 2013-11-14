<?php
// checking the controller and action for displaying of gallery
//if($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'display'){
?>
<div class="tab_outer_right">
                <div class="right_text_tab tab_font"><?php echo $this->Session->read('User.first_name');?></div>
                <div class="red_cross_outer"><img src="<?php if($this->Session->read('User.thumb_image')==''){
			echo $this->webroot.'img/no_image.png';
		     }else{
			echo $this->webroot.'img/upload/'.$this->Session->read('User.thumb_image').'?='.uniqid();			
		     }
		     ?>" alt="<?php echo $this->Session->read('User.first_name');?>"  class="profile_image" /></div>
                <div class="right_text_tab "><span class="status_text" style='text-transform:none;'><?php
		if(strlen($this->Session->read('User.status_message')) > 0)
		{
		     if(strlen($this->Session->read('User.status_message'))>50){
			echo "<a href='javascript:void(0);' title='".$this->Session->read('User.status_message')."'>".substr($this->Session->read('User.status_message'),0,50).'..</a>';
		     }
		     else echo $this->Session->read('User.status_message');
		}else echo 'STATUS';
		?></span></div>
                <a href="<?php echo $this->webroot;?>users/user_profile#u_status" class="right_text_tab_small small_font">CHANGE YOUR STATUS</a>
				<?php
				 if(($this->params['controller'] == 'pages' && $this->params['action'] == 'display') || ( $this->params['controller'] == 'loghours' && $this->params['action'] == 'add')){
			     ?>
                <div class="right_img_outer">
               <?php		   	 
			   	   $array = $this -> requestAction(array(
					 'controller' => 'users',
					 'action' => 'gallery_images'
					));
					$i=1;
					foreach($array as $image):
					?>
                        <div class="gallery_img<?php echo $i;?>"><a href="javascript:void(0);" title="<?php echo $image['images']['caption'];?>"><img src="<?php echo $this->webroot;?>img/log_hours/<?php echo $image['images']['picture_url'];?>" alt=""  width="100%"  /></a></div>                       
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