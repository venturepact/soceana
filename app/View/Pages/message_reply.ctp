<?php
function get_hours($time1,$time2){
	$hourdiff = round((strtotime($time1) - strtotime($time2))/3600, 1);
	return $hourdiff;		
}
foreach($mess as $mes)
{
?>
<!--Single Client Outer-->
        <div class="client_outer">
        <div class="status_sign"><?php 
		   if(($mes['User']['last_login'] != '0000-00-00 00:00:00') && get_hours(date('Y-m-d H:i:s'),$mes['User']['last_login']) < 24)
		   echo '<img src="'.$this->webroot.'img/active.png" alt="" />';
		   else echo '<img src="'.$this->webroot.'img/busy.png" alt="" />';
		   ?>   </div>
        <div class="client_img_outer_f"><img src="<?php echo $this->webroot;?>img/client_img_outer_b.png" alt="" /></div>
        <div class="client_img_outer">
            <?php
            if(strlen($mes['User']['thumb_image'])>0){
            $image = $this->webroot.'img/upload/'.$mes['User']['thumb_image'];
            }else{
                $image = $this->webroot.'img/no_image.png';
            }        
            ?>
        <img src="<?php echo $image;?>" alt="" width='69' height='69' /></div>
                  
                     <div class="client_detail"><h3>
		     <?php echo $mes['User']['first_name'];?> <?php echo $mes['User']['last_name'];?></h3>
                     <div class="light_gray" style='font-size:11px;'>
                           Sent on : <?php echo date("F j, Y, g:i a", strtotime($mes['Message']['created']));?>
                        </div>                        
                      </div>
                         <!-- <p>
                    <input id="demo_box_4" class="css-checkbox" type="checkbox" />
					<label for="demo_box_4" name="demo_lbl_1" class="css-label"></label>
			   	  </p>-->
        </div>
	<div class="message_outer" style='border-bottom: 1px solid #999;'>                       
                         <p>
			     <?php echo nl2br($mes['Message']['message']);?>
			 </p>                        
                     </div>
	
	</div>
<?php
}
?>
<!--Single Client Outer End-->
<?php echo $this->Form->input('Message.reply_to',array('type'=>'hidden','id' => 'reply_to','value' => $message_from));?>
<?php echo $this->Form->input('Message.reference',array('type'=>'hidden','id' => 'reference','value' => $reference_id));?>
<h3>Respond <span class='required'>*</span></h3>
<?php echo $this->Form->input('Message.message',array('type'=>'textarea','div'=>false,'label'=>false,'id' => 'reply_message','cols'=>"1" ,'rows'=>"6"));?>
<input type="button" value="Submit" class="submit_butt" id='sbmt_butt' /><br><br>


<script>
    //reply message submit function
$('#sbmt_butt').click(function(){
       var text_length = $('#reply_message').val().length;
       if(text_length > 0){ 
	$('#message_status').html('<div id="info" style="background-color:#FFFFFF;float: left;height: 27px;position: fixed;width: 299px;z-index: 500000;"><img src="<?php echo $this->webroot;?>img/loading.gif">&nbsp;Message Sent Successfully</div>');	
        $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/send_message2',
                   data:{
                        message_to:$('#reply_to').val(),
                        message:$('#reply_message').val(),
			reference_id:$('#reference').val()
                        },
                   success: function(data) {			
                        $('#reply_to').val('');
                        $('#reply_message').val('');                        
                        $('#reference').val('');
			 $.ajax({
			    type: "POST",
			    url: '<?php echo $this->webroot;?>' + 'pages/messages',
			    data:'',
			    success: function(data) {
				 $('#messages').html(data);                                        
			    }
			}); 
                   }
	    });
	     $('#info').fadeOut(10000);
	     $('.message_section').hide();
	     $('#messages').show();
       }
});
</script>