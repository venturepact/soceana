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
		     ?>" alt="<?php echo $this->Session->read('User.first_name');?>" width="170" height="170" /></div>
                <div class="right_text_tab "><h2>STATUS</h2></div>
                <a href="#" class="right_text_tab_small small_font">CHANGE YOUR STATUS</a>
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
                        <div class="gallery_img<?php echo $i;?>"><img src="<?php echo $this->webroot;?>img/log_hours/<?php echo $image['images']['picture_url'];?>" alt="" width="240px" height="175" /></div>                       
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