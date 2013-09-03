<?php
/* @ check if the role of current logged in user is organzation or normal volunteer
*/
if($this->Session->read('User.role')!=''){
?>
<header>
        <div id="header">      
                <a class="logo" href="<?php echo $this->webroot;?>"><img alt="Soceana Logo" src="<?php echo $this->webroot;?>img/logo.png"> </a> 
                 <div class="top_nav_outer">
                        <ul class="top_nav">
                                <li><a href="<?php echo $this->webroot;?>">ANALYTICS</a></li>
                                <li><a href="<?php echo $this->webroot;?><?php
                                if($this->Session->read('User.role') == 'organizations'){
                                    echo 'loghours/organization_add';
                                }
                                else echo 'loghours/add';
                                ?>">LOG HOURS</a></li>
                                <li><a href="#"><?php
                                if($this->Session->read('User.role') == 'organizations'){
                                    echo strtoupper($this->Session->read('User.organization_name'));
                                }
                                else echo strtoupper($this->Session->read('User.first_name'));
                                ?></a></li>
                                <li><a href="<?php echo $this->webroot;?>users/logout">LOGOUT</a></li>
                                <li><a href="<?php echo $this->webroot;?><?php
                                if($this->Session->read('User.role') == 'organizations'){
                                    echo 'users/organization_profile';
                                }
                                else echo 'users/user_profile';
                                ?>"><img height="15" border="0" title="inser title here" alt="" src="/soceana/img/edit_icon.png"></a></li>
                        </ul>
                <div class="c_profile"><a class="link_text" href="<?php echo $this->webroot;?><?php
                                if($this->Session->read('User.role') == 'organizations'){
                                    echo 'users/organization_profile';
                                }
                                else echo 'users/user_profile';
                                ?>">COMPLETE YOUR PROFILE</a></div> 
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
         </div> 
</header>
<?php
}
?>




