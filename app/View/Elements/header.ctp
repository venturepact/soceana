<?php
/* @ check if the role of current logged in user is organzation or normal volunteer
*/
if($this->Session->read('User.role')!=''){
?>
<script>
	
<!--i-Phone nav-->
$(document).ready(function(){
	
	$('.iphone_nav_outer').click(function(){
		
		$('.iphone_nav').slideToggle(900);
					
	});
	
});
	
	
<!--i-Phone nav-->

</script>
<header>
        <div id="header">      
                <a class="logo" href="<?php echo $this->webroot;?>"><img alt="Soceana Logo" src="<?php echo $this->webroot;?>img/logo.png"> </a> 
                 <div class="top_nav_outer">
                        <ul class="top_nav">
                   <li><a href="<?php echo $this->webroot;?>">ANALYTICS</a></li>
                   <li><a href="<?php echo $this->webroot;?><?php
                      if($this->Session->read('User.role') == 'organizations')echo 'log_hours/review_hours';
					  elseif($this->Session->read('User.role') == 'companies')echo '#';
                      else echo 'log_hours/add';
                                ?>">
					<?php if($this->Session->read('User.role') == 'organizations')echo 'REVIEW HOURS';
					else echo 'LOG HOURS';?></a></li>
                                <li><a href="<?php echo $this->webroot;?><?php
                                if($this->Session->read('User.role') == 'organizations')echo 'users/organization_profile';
                                elseif($this->Session->read('User.role') == 'companies')echo 'users/company_profile';
                                else echo 'users/personalize';
                                ?>">
					<?php
							if(($this->Session->read('User.role') == 'organizations')|| ($this->Session->read('User.role') =='companies')){echo strtoupper($this->Session->read('User.organization_name'));}		
                                else echo strtoupper($this->Session->read('User.first_name'));
                                ?></a></li>
                                <li><a href="<?php echo $this->webroot;?>users/logout">LOGOUT</a></li>
                                <li><a href="<?php echo $this->webroot;?><?php
                                if($this->Session->read('User.role') == 'organizations')echo 'users/organization_profile';
                                elseif($this->Session->read('User.role') == 'companies')echo 'users/company_profile';
                                else echo 'users/user_profile';
                                ?>"><img height="15" border="0" title="inser title here" alt="" src="<?php echo $this->webroot;?>img/edit_icon.png"></a></li>
                        </ul>
                <div class="c_profile"><a class="link_text" href="<?php echo $this->webroot;?><?php
                                if($this->Session->read('User.role') == 'organizations')echo 'users/organization_profile';
								elseif($this->Session->read('User.role') == 'companies')echo 'users/company_profile';
                                else echo 'users/user_profile';
                                ?>">COMPLETE YOUR PROFILE</a></div> 
               </div>
               <div class="iphone_nav_outer"><span>Navigation</span>
                <ul class="iphone_nav">
                  <?php
				   if($this->Session->read('User.role') == 'organizations'){ ?>
                  <li><a href="<?php echo $this->webroot;?>">ANALYTICS</a></li>
                  <li><a href="<?php echo $this->webroot;?>log_hours/review_hours">REVIEW HRS.</a></li>
                  <li><a onclick="show()" href="javascript:void(0);">MESSAGES</a></li>
                  <li><a href="<?php echo $this->webroot;?>users/change_password">CHANGE PWD</a></li>                 
                  <li><a href="<?php echo $this->webroot;?>pages/gallery">GALLERY</a></li>                 
                  <li><a href="<?php echo $this->webroot;?>users/organization_profile">PROFILE</a></li>
                  
                  <?php }
				  else if($this->Session->read('User.role') == 'companies')
				  {
				   ?>
                  
                   <li><a href="<?php echo $this->webroot;?>">ANALYTICS</a></li>
                 <!-- <li><a href="<?php //echo $this->webroot;?>log_hours/add">LOG HRS.</a></li>-->
                  <li><a onclick="show()" href="javascript:void(0);">MESSAGES</a></li>
                  <li><a href="<?php echo $this->webroot;?>users/change_password">CHANGE PWD</a></li>                   
                  <li><a href=" <?php echo $this->webroot;?>pages/gallery">GALLERY</a></li>                 
                  <li><a href="<?php echo $this->webroot;?>users/company_profile">PROFILE</a></li>
                  <?php } else{?>
                  <li><a href="<?php echo $this->webroot;?>">ANALYTICS</a></li>
                  <li><a href="<?php echo $this->webroot;?>log_hours/add">LOG HRS.</a></li>
                  <li><a onclick="show()" href="javascript:void(0);">MESSAGES</a></li>
                  <li><a href="<?php echo $this->webroot;?>users/change_password">CHANGE PWD</a></li> 
                  <li><a href="<?php echo $this->webroot;?>users/personalize">PERSONALIZE</a></li>
                  <li><a href=" <?php echo $this->webroot;?>pages/gallery">GALLERY</a></li>                 
                  <li><a href="<?php echo $this->webroot;?>users/user_profile">PROFILE</a></li>
                  <?php }?>
                   </ul>
                 </div> 
               </div> 
</header>
<?php		
}
else{
?>
   <header>
    <div id="header"> 
         
          <a href="<?php echo $this->webroot;?>" class="logo"><img src="<?php echo $this->webroot;?>img/logo.png" alt="Soceana Logo" /> </a> 
                    <div class="top_nav_outer">
                                <ul class="top_nav">
                                      <li><a href="<?php echo $this->webroot;?>">LOGIN</a></li>
                                      <li><a href="<?php echo $this->webroot;?>users/add/user">SIGN UP</a></li>
                                </ul>
    
                     </div>  
                     
   <!-- <div class="iphone_nav_outer"><span>Navigation</span>
    <ul class="iphone_nav" >
      <li><a  href="/soceana/">ANALYTICS</a></li>
      <li><a  href="/soceana/log_hours/review_hours">REVIEW HRS.</a></li>
      <li><a  onclick="show()" href="javascript:void(0);">MESSAGES</a></li>
      <li><a  href="/soceana/users/change_password">CHANGE PWD</a></li> 
      <li><a  href="/soceana/users/personalize">PERSONALIZE</a></li>
      <li><a  href="/soceana/users/user_profile">PROFILE</a></li>
       </ul>
     </div>  -->
         </div>
          
       
</header>



<?php
}
?>




