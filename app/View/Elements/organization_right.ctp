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
		     ?>" alt="<?php echo $this->Session->read('User.organization_name');?>" width="100%"  height="100%"  /></div>
                <div class="right_text_tab "><h2>STATUS</h2></div>
                <a href="#" class="right_text_tab_small small_font">CHANGE YOUR STATUS</a>				
</div>
<?php
//}
?>