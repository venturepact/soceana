<?php if($this->Session->read('User.role') == 'organizations' || $this->Session->read('User.role') == 'companies')
{
?>
<div class="top_heading">
           <h1>GALLERY</h1>            
             </div>
             <div class="gallery_outer">
             <?php if(count($pictures) > 0)
			 {
			 ?>
        <div class="gallery_img_display"><span style="float:left;">SHOWING IMAGES</span><?php
echo $this->paginator->prev(   $this->Html->image 
                                    (   'left_arrow.png', 
                                        array 
                                            ( 'alt' => __('Previous', true), 
                                            'border' => 0 
                                            ) 
                                    ), 
                                    array('escape'=>false,'class'=>'left_arrow') 
                            );
?><span style="float:left;"><?php echo $this->Paginator->counter('{:start} to {:end} of  {:count}');?></span><?php
echo $this->paginator->next(   $this->Html->image 
                                    (   'right_arrow.png', 
                                        array 
                                            ( 'alt' => __('Next', true), 
                                            'border' => 0 
                                            ) 
                                    ), 
                                    array('escape'=>false,'class'=>'left_arrow') 
                            );
?></div>
         <div class="gallery_main">
         	<div class="gallery_left_img">
				<?php if(count($pictures) > 0)
                {
                    echo "<image src='".$this->webroot."img/user_pics/". $pictures[0]['UserPic']['picture_url'] ."'>";
                }
                ?>
       		</div>
            <div class="img_text_display"> 
			   <?php if(count($pictures) > 0)
                {
                    echo $pictures[0]['UserPic']['caption'];
                }
                ?>
			</div>
          </div>
         <div class="gallery_right">         
         <?php 
		 $i = 0;
		// pr($pictures);
		 foreach($pictures as $picture){
		 ?>
            <div class="img_outer<?php if($i == 0) echo ' active';?>" onclick="show_image('<?php echo $picture['UserPic']['picture_url'];?>','<?php echo str_replace("'","\'",$picture['UserPic']['caption']);?>',this);"><img src="<?php echo $this->webroot;?>img/user_pics/<?php echo $picture['UserPic']['picture_url'];?>" alt="<?php echo $picture['UserPic']['caption'];?>" /></div>    
            
         <?php
		 $i++;
		 }
		 ?>
           </div>   
          <?php } else echo "<div style='color:red;text-align:center;'>No image found</div>";?>
         </div>
<script type="text/javascript" language="javascript">
function show_image(image_url ,caption,current_element){
	var image = "<image src='<?php echo $this->webroot;?>img/user_pics/" + image_url + "'>";
	$('.img_text_display').text(caption);
	$('.gallery_left_img').html(image);
	$('.gallery_right .img_outer').each(function(index, element){
	  	$(this).removeClass('active');
	});
	$(current_element).addClass('active');
}
</script>
<?php
}
else{
?>
<div class="top_heading">
           <h1>GALLERY</h1>
            
             </div>
             <div class="gallery_outer">
             <?php if(count($pictures) > 0)
			 {
			 ?>
        <div class="gallery_img_display"><span style="float:left;">SHOWING IMAGES</span><?php
echo $this->paginator->prev(   $this->Html->image 
                                    (   'left_arrow.png', 
                                        array 
                                            ( 'alt' => __('Previous', true), 
                                            'border' => 0 
                                            ) 
                                    ), 
                                    array('escape'=>false,'class'=>'left_arrow') 
                            );
?><span style="float:left;"><?php echo $this->Paginator->counter('{:start} to {:end} of  {:count}');?></span><?php
echo $this->paginator->next(   $this->Html->image 
                                    (   'right_arrow.png', 
                                        array 
                                            ( 'alt' => __('Next', true), 
                                            'border' => 0 
                                            ) 
                                    ), 
                                    array('escape'=>false,'class'=>'left_arrow') 
                            );
?></div>
        <div class="gallery_main">
        	<div class="gallery_left_img">
		        <?php if(count($pictures) > 0)
				{
        			echo "<image src='".$this->webroot."img/log_hours/". $pictures[0]['LogHourImage']['picture_url'] ."'>";
				}
				?>
	         </div>
         	<div class="img_text_display"> 
			   <?php if(count($pictures) > 0)
                {
                    echo $pictures[0]['LogHourImage']['caption'];
                }
                ?>
        	</div>
         </div>
         <div class="gallery_right">         
         <?php 
		 $i = 0;
		// pr($pictures);
		 foreach($pictures as $picture){
		 ?>
            <div class="img_outer<?php if($i == 0) echo ' active';?>" onclick='show_image("<?php echo $picture['LogHourImage']['picture_url'];?>","<?php echo $picture['LogHourImage']['caption'];?>",this)'><img src="<?php echo $this->webroot;?>img/log_hours/<?php echo $picture['LogHourImage']['picture_url'];?>" alt="<?php echo $picture['LogHourImage']['caption'];?>" /></div>    
            
         <?php
		 $i++;
		 }
		 ?>
           </div>   
        <?php } else echo "<div style='color:red;text-align:center;'>No image found</div>";?>
         </div>
         

<script type="text/javascript" language="javascript">
function show_image(image_url ,caption,current_element){
	var image = "<image src='<?php echo $this->webroot;?>img/log_hours/" + image_url + "'>";
	$('.img_text_display').text(caption);
	$('.gallery_left_img').html(image);
	$('.gallery_right .img_outer').each(function(index, element){
	  	$(this).removeClass('active');
	});
	$(current_element).addClass('active');
}
</script>
<?php 
}
?>
