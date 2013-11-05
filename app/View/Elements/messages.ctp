<!-- message box functionality-->
<div class="upper_box_wrapper">
       <div class="box_wrap_inner"><a href="#" onclick="show()"><img src="<?php echo $this->webroot;?>img/chat1.png" /> </a></div>
       <div class="upper_box" id="upper_box" style="display:none;">
         <div class="bott_margin"><img src="<?php echo $this->webroot;?>img/chat1.png" /></div>
         <div class="left_section_upper">
            <div class="icon_list">
               <ul>
               <li><a href="javascript:void(0);" onclick="show()" ><img src="<?php echo $this->webroot;?>img/icon5.png" alt="" border="0"  /></a></li>
                 <li><a href="javascript:void(0);" id='inbox'><img src="<?php echo $this->webroot;?>img/icon4.png" alt="" border="0"  /><span>Mail</span></a></li>
                   <li><a href="javascript:void(0);" id='compose'><img src="<?php echo $this->webroot;?>img/icon1.png" alt="" border="0"  /><span>New Message</span></a></li>
                   <li><a href="javascript:void(0);" id='delete'><img src="<?php echo $this->webroot;?>img/icon2.png" alt="" border="0"  /><span>Delete</span></a></li>
                    </ul>
                  </div>
             </div>
         <div class="right_section_upper">
         <div class="client_section">
         <div id='message_status'></div>         
         <div id='messages'>            
         </div>

         <div class="message_section" style="display:none;">
                    <!--compose section-->
      <div class="client_outer">        
          <div class="client_img_outer_f"><img src="<?php echo $this->webroot;?>img/client_img_outer_b.png" alt="" /></div>
             <div class="client_img_outer" id='compose_image'><img src="<?php echo $this->webroot;?>img/client_img_gray.png" alt="" /></div>
                  
                   <div class="client_detail">
                        <?php echo $this->Form->input('Message.name',array('type'=>'text','div'=>false,'label'=>false,'id' => 'compose_to','class'=>'compose_input1 ac_input'));?><span class='required'>*</span>
                        <?php echo $this->Form->input('Message.message_to',array('type'=>'hidden','id' => 'hidden_to'));?>                   
                                                 
                        </div>
                        
                </div>
                 <!--Single Client Outer End--> 
                   <h3>New Message <span class='required'>*</span></h3>
                   <?php echo $this->Form->input('Message.message',array('type'=>'textarea','div'=>false,'label'=>false,'id' => 'compose_typed_message','cols'=>"1" ,'rows'=>"11"));?>
                   
                    <input type="button" value="Submit" class="submit_butt" id='message_button' />
                   
          
                   
           </div>
              <!--Message section End -->
               
             </div>        
             
             
       </div>
     </div>
     </div>
<!-- /end of message box functionality-->
<script>
// delete function of message box
$('#delete').click(function(){
     $('#message_status').html('<div id="info" style="background-color:#FFFFFF;float: left;height: 27px;position: fixed;width: 299px;z-index: 500000;"><img src="<?php echo $this->webroot;?>img/loading.gif">&nbsp;Deleting messages</div>');	
     var matches = [];
     $(".inbox_message:checked").each(function() {
          matches.push(this.value);
     });
     if(matches.length == 0){
        $('#info').html( 'Please select a message to delete');    
     }
     else{
           if(matches.length == 1) {
              var text_message = '1 Message';
           }else text_message = matches.length + ' Messages';
            
           $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/messages_delete',
                   data: {
                        ids: matches,                       
                    },
                   success: function(data) {                        
                        $.ajax({
                                    type: "POST",
                                    url: '<?php echo $this->webroot;?>' + 'pages/messages',
                                    data:'',
                                    success: function(data) {
                                         $('#messages').html(data);                                        
                                    }
                        });
                        
                        $('#info').text( text_message + ' deleted successfully');
                   }
            }); 
     }
     $('#info').fadeOut(10000);     
});
// compose message submit function
$('#message_button').click(function(){       
       var username_length = $("input#hidden_to").val().length;
       var text_length = $('#compose_typed_message').val().length;
       if(( username_length > 0 ) && (text_length > 0)){             
              $('#message_status').html('<div id="info" style="background-color:#FFFFFF;float: left;height: 27px;position: fixed;width: 299px;z-index: 500000;"><img src="<?php echo $this->webroot;?>img/loading.gif">&nbsp;Sending Message</div>');	
              $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/send_message',
                   data:{
                        message_to:$('#hidden_to').val(),
                        message:$('#compose_typed_message').val()
                        },
                   success: function(data) {
                        $('#compose_image').html('<img src="<?php echo $this->webroot;?>img/client_img_gray.png" alt="" />');
                        $('#hidden_to').val('');
                        $('#compose_to').val('');                        
                        $('#compose_typed_message').val('');                        
                   }
              });
              $('#info').fadeOut(10000);
              $('.message_section').hide();
              $('#messages').show();    
       }
});


//reply message section
function reply(id) {
    $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/message_reply',
                   data:{id:id},
                   success: function(data) {
                        $('#messages').html(data);                                        
                   },                 
                   
 }) 
  $('.message_section').hide();
  $('#messages').show();
  $(document).ajaxComplete(function(){
  	$(".client_section, #messages").animate({scrollTop: $("#messages").height()}, 300);	
  });
        
        
}

//loading inbox messages automatically
$(document).ready(function(){
     $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/messages',
                   data:'',
                   success: function(data) {
                        $('#messages').html(data);                                        
                   }
            });       
});

//loading inbox messages on click event
$('#inbox').click(function(){
  //$('#message_status').html('<div id="info" style="background-color:#FFFFFF;float: left;height: 27px;position: fixed;width: 299px;z-index: 500000;"><img src="<?php echo $this->webroot;?>img/loading.gif">&nbsp;Loading Messages</div>');	
  $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'pages/messages',
                   data:'',
                   success: function(data) {
                        $('#messages').html(data);                                        
                   }
 });
  //$('#info').fadeOut(10000);
  $('.message_section').hide();
  $('#messages').show();
});

$('#compose').click(function(){
   $('.message_section').show();
   $('#messages').hide();           
});





// auto complete code for compose message
            $(document).ready(function () {
                $('#message_status').hide()  // hide it initially
                .ajaxStart(function () {
                    //alert('started');
                    $('#message_status').show();
                })
                .ajaxStop(function () {
                    //alert('stoped');
                    $('#message_status').hide();
                });

            });
        

  function findValue(li) {
  	if( li == null ) return alert("No match!");

  	// if coming from an AJAX call, let's use the CityId as the value
  	if( !!li.extra ) var sValue = li.extra[0];

  	// otherwise, let's just display the value in the text box
  	else var sValue = li.selectValue;

  	//alert("The value you selected was: " + sValue);
	test(sValue);
  }

  function selectItem(li) {
    	findValue(li);	
  }

  function formatItem(row) {
    	return row[0] + " (id: " + row[1] + ")";		
  }

  function lookupAjax(){
  	var oSuggest = $("#compose_to")[0].autocompleter;
        oSuggest.findValue();
  	return false;
  }

  
  
    $("#compose_to").autocomplete(
      '<?php echo $this->webroot;?>' + 'users/getusers',
      {
  			delay:10,
  			minChars:2,
  			matchSubset:1,
  			matchContains:1,
  			cacheLength:10,
  			onItemSelect:selectItem,
  			onFindValue:findValue,
  			formatItem:formatItem,
  			autoFill:true,			
  		}
    );
	
	
	
	function test(id){		
	    $('#hidden_to').val(id);
            $.ajax({
                   type: "POST",
                   url: '<?php echo $this->webroot;?>' + 'users/getuser_image',
                   data:{ user_id:id},
                   success: function(data) {
                        $('#compose_image').html('<img src='+ data +' width="69" height="69"/>');                                        
                   }
            });
                
	}
// end of auto complete code for compose message
</script>
