<?php
         $i = 1;
         foreach($messages as $message){
         ?>
        <div class="client_outer">
        <div class="status_sign">
            <img src="<?php echo $this->webroot;?>img/busy.png" alt="" />
        </div>
        <div class="client_img_outer_f">
            <img src="<?php echo $this->webroot;?>img/client_img_outer_b.png" alt="" />
        </div>
        <div class="client_img_outer">
            <?php
            if( $message['User']['thumb_image'] == '' || $message['User']['thumb_image'] == null)
            {
                  $image =  $this->webroot.'img/no_image.png';
                        
            }else
            {
                  $image =  $this->webroot.'img/upload/'.$message['User']['thumb_image'];       
            }
            ?>
            <img src="<?php echo $image;?>" alt="" width='69' height='69' />
        </div>
                  
                     <div class="client_detail" onclick="reply(<?php echo $message['Message']['id'];?>)"><h3><?php echo ucfirst($message['User']['first_name']).' '.ucfirst($message['User']['last_name']);?></h3>
                        <div class="light_gray" onclick="reply(<?php echo $message['Message']['id'];?>)">
                          <?php echo substr($message['Message']['message'],0,50).'...';?>
                        </div>                        
                      </div>
                <p>
                    <input id="demo_box_<?php echo $i;?>" class="css-checkbox inbox_message" type="checkbox" value="<?php echo $message['Message']['id'];?>" name='message[]' />
					<label for="demo_box_<?php echo $i;?>" name="demo_lbl_<?php echo $i;?>" class="css-label"></label>
		</p>
         </div>
        <?php
        $i++;
        }
        ?>