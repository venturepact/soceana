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
			echo $this->webroot.'img/upload/'.$this->Session->read('User.thumb_image');
		     }
		     ?>" alt="<?php echo $this->Session->read('User.organization_name');?>" width="100%"  height="100%"  /></div>
                <div class="right_text_tab "><h2>STATUS</h2></div>
                <a href="#" class="right_text_tab_small small_font">CHANGE YOUR STATUS</a>		
		<div class="right_img_outer">
                        <div class="gallery_img1"><img src="<?php echo $this->webroot;?>img/gallery_img1.jpg" alt="" width="240px" height="175" /></div>
                        <div class="gallery_img2"><img src="<?php echo $this->webroot;?>img/gallery_img2.jpg" alt=""  width="240px" height="168" /></div>
                        <div class="gallery_img3"><img src="<?php echo $this->webroot;?>img/gallery_img3.jpg" alt=""  width="240px" height="178" /></div>
                        <div class="gallery_img4"><img src="<?php echo $this->webroot;?>img/gallery_img4.jpg" alt=""  width="240px" height="200" /></div>
                        <div class="gallery_img5"><img src="<?php echo $this->webroot;?>img/gallery_img5.jpg" alt=""  width="240px" height="175" /></div>                             
                </div>		
</div>
<?php
//}
?>