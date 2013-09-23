<style>
    label.error{ color: #FF0000;font-size: 12px;margin: -3px 0 5px 190px;text-align: left;text-transform: none;width: 100%;}</style>
<div class="container">
        	<div class="section">
				<h1>Contact Us</h1>
                <p>Got inquiries? We've got answers. Drop us a line and we will get back to you as soon as possible! We look forward to hearing feedback from our clients, so please do send us a message.</p>
            </div>
			<div class="mt50"></div>
			<div class="section">
            	<?php echo $this->Html->script('jquery.validate');?>
				<?php echo $this->Form->create('Contact',array('id'=>'contact_form'));?>
                	<div class="contact_form">
                    	<label name="name">Name</label>
                      <?php echo $this->Form->input('name',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">Email</label>
                        <?php echo $this->Form->input('email_id',array('type'=>'text','div'=>false,'label'=>false,'id' => 'email_id','maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">Company</label>
                        <?php echo $this->Form->input('company',array('type'=>'text','div'=>false,'label'=>false,'maxlength'=>'50','class'=>'text_style'));?>
                    </div>
                    <div class="contact_form">
                    	<label name="name">Message</label>
                        <?php echo $this->Form->input('message',array('type'=>'textarea','div'=>false,'label'=>false,'maxlength'=>'250','class'=>'text_style'));?>
                    </div>
                     <div class="contact_form">
                    	<input type="submit" class="save_button" value="" />
                    </div>
                    
                <?php echo $this->Form->end();?>
                <script type='text/javascript' language='javascript'>
$().ready(function() {
    
	//validation rule for only alphabets
    $.validator.addMethod("alpha", function(value) {
        return value == value.match(/^[a-z A-Z]*$/);    
    }, 'Please enter only alphabets for this field');
  
    //validation rule for valid email
    $.validator.addMethod("valid_email_id", function(value) {
        return value = value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);               
    }, 'Please enter a valid email id');
    
        // validate signup form on keyup and submit
        $("#contact_form").validate({
            rules: {
                        "data[Contact][email_id]": {
                         required: true,                        
                         'valid_email_id':true
                        },
                       
                         "data[Contact][name]": {
                         required: true,
                         'alpha':true,
                          minlength:2,
                          maxlength:50
                         },
                         "data[Contact][message]": {
                          required: true,                         
                          minlength:2,
                          maxlength:250
                         },                        
                    },
            messages:{
                   		"data[Contact][email_id]": {
                            required: 'Please enter your email id',			  
						},
                         "data[Contact][name]":{
                            required: 'Please enter your name',                            
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 50 characters'
                         },
                         "data[Contact][message]": {
                            required: 'Please enter your message',
                            minlength:'Please enter atleast 2 characters',
                            maxlength:'Please enter maximum 250 characters'
                         },                        
            },
            errorElement: 'label',
            errorClass: 'error help-block',
            errorPlacement: function(error, element){
                if(element.is('input[type="checkbox"]')){
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
                                   
        });                    
});
</script>
            </div>            
            <div class="mt50"></div>
            <div class="section">
            	<h1>CONTACT INFORMATION</h1>
                <p>Phone :</p>
            </div>
            
            <div class="mt50"></div>
            
        </div>