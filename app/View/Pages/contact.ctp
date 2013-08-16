<style>
    .profile_content_main{min-height: 0;}
</style>
<div class="profile_content_main">
    <div class="profile_content_left">
        <div class="main_heading_gray">Contact us</div>
    </div>
</div>
<div class="profile_content_main">
    <p class="gray_text">Got inquiries? We've got answers. Drop us a line and we will get back to you as soon as possible! We look forward to hearing feedback from our clients, so please do send us a message.</p>
        <br />
        <div>&nbsp;</div>
        <div>&nbsp;
        <?php echo $this->Form->create('Page', array('id'=>'contact_form'));?>
          <table width="100%" border="0" cellspacing="5" cellpadding="0">
            <tr>
                <td width="15%" align="left">Name:</td>
                <td width="85%" align="left"><label for="textfield"></label>
                    <?php echo $this->Form->input('name',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','maxlength'=>'50'));?>
              </td>
            </tr>
            <tr>
                <td align="left">Email:</td>
                <td align="left"><label for="textfield2"></label>
                    <?php echo $this->Form->input('email',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','maxlength'=>'50'));?>
                </td>
            </tr>
            <tr>
                <td align="left">Organization:</td>
                <td align="left"><label for="textfield4"></label>
                    <?php echo $this->Form->input('organization',array('type'=>'text','div'=>false,'label'=>false,'style'=>'width:250px;','class'=>'input','maxlength'=>'50'));?>
                </td>
            </tr>
            <tr>
                <td align="left">Message:</td>
                <td align="left"><label for="textarea"></label>
                    <?php echo $this->Form->input('message',array('type'=>'textarea','cols'=>45,'rows'=>5,'div'=>false,'label'=>false));?>
                </td>
            </tr>
            <tr>
              <td colspan="2" align="left">
                <?php echo $this->Form->input('Submit',array('id'=>'sbmt','type'=>'submit','label'=>false,'div'=>false,'class'=>'submit_bnt','style'=>"margin-left:35px;"));?>                               
<div>&nbsp;</div><div>&nbsp;</div>

                <h6 style="margin-bottom: 19px;">CONTACT INFORMATION</h6><br />
                <p><strong>Phone</strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1234567890</p><br />
                <p><strong>Eamil</strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;info@soceana.com</p><br />
                <p><strong>Fax</strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1234567890</p><br />
                <p><strong>Address</strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                </td>
            </tr>
          </table>
        <?php echo $this->Form->end();?>
        </div>
<div>&nbsp;</div>
</div>