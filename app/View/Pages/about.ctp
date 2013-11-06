<?php echo $this->Html->script('popbox');?>
<script type='text/javascript' charset='utf-8'>
    $(document).ready(function(){
      $('.popbox').popbox();
	  $('.popbox_c').popbox1();
	  $('.popbox_n').popbox2();
    });  
</script>
<style>
.click_button{
  cursor: pointer;
}
</style>
<div class="container">
        	<div class="section">
				<h1>About us</h1>
               <!-- <p>All of us, at some time in our lives, do social good in our world. Whether this be volunteering at a local hospital, educating children in underprivileged areas, or even providing medical support through NGOs on other continents. Doing good is inherent in our beings, and as such we all experience some form of altruism during our lives. Soceana is an attempt to push forward social good by making it more accessible and enjoyable. Through Soceana, both users and companies will have access to a simple and easy-to-use interface where they can post volunteer listings, apply for positions, and effortlessly tally how much “good” one does.</p>-->
               <p>Soceana, focuses on the three-way triangle between current student volunteers, new, potential volunteers, and large service organizations. As tests such as the SAT, MCAT, GMAT, and LSAT are valued due to their standardization ability, now Soceana seeks to standardize volunteer hours through a unique platform. The market base is extremely appealing as the target groups would be all high schools throughout the nation who can promote validating one’s volunteer hours to apply for college, colleges who support reaching out into the community especially to bolster one’s graduate school application, and those who genuinely hope to get more involved in service.</p>
               <p>Volunteers will use the site to track their volunteer hours and through confirmation by the organization they are volunteering with, their hours will become “Soceana Certified.” Organizations, on the other hand, will be able to market their volunteer opportunities on the site as well as use our analytics to discover both times of dearth of volunteers during the year as well as compare their different locations’ volunteer activities to see where they need to market more heavily.</p>
               <p>The Social Good arena seems to be an area that is only beginning to get tapped into and there is much potential to really create a high-impact profit-company that will promote getting involved in truly making a difference in society. Through this standardization mechanism, now volunteering will become more highly valued and therefore more of a focus in today’s society. Soceana is the key to truly making this a reality.</p>
            </div>
			<div class="mt20"></div>
			<div class="section">
            	<h1>BENEFITS OF USING SOCEANA</h1>
                <p>New volunteers, current volunteers and nonprofits/organizations all gain through using Soceana as a standard.</p>
                <div class="logo_div">
				  <img src="<?php echo $this->webroot;?>img/benefits.png" alt="in"  border="0"/>
                  <div class='popbox'>
    <a class='open' href='#'><img src="<?php echo $this->webroot;?>img/pop_up_base.png" alt="" > </a>
               <div class='collapse'>
      <div class='box'>
        <div class='arrow'></div>
        <div class='arrow-border'></div>

        
          <p>
          <div class="pop_upbox">ORGANIZATIONS</div>
            <div class="bottom_border"></div>
             <div class="main_section">
                <div class="left_s">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                <br/><br/>
                <strong>- Reason One</strong><br/>
                 <strong>- Reason Two</strong><br/>
                  <strong>- Reason Three</strong><br/>
                   <strong>- Reason Four</strong><br/> 
                    <strong>- Reason Five</strong><br/>
                </div>
                   <div class="right_s">
                     <img src="<?php echo $this->webroot;?>img/nurse.png" alt="" />
                  </div>
                </div>
               </p>
         
        

      </div>
    </div>
</div>      
   
<div class='popbox_c'>
     <a class='open1' href='#'>
       <img src="<?php echo $this->webroot;?>img/pop_up_base_green.png" alt="" width="87" />      
       </a>
     
     <div class='collapse1'>
      <div class='box1'>
        <div class='arrow1'></div>
        <div class='arrow-border1'></div>

        
          <p>
          <div class="pop_upbox">CURRENT VOLUNTEERS</div>
            <div class="bottom_border"></div>
             <div class="main_section">
                <div class="left_s">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                <br/><br/>
                <strong>- Reason One</strong><br/>
                 <strong>- Reason Two</strong><br/>
                  <strong>- Reason Three</strong><br/>
                   <strong>- Reason Four</strong><br/> 
                    <strong>- Reason Five</strong><br/>
                </div>
                   <div class="right_s">
                     <img src="<?php echo $this->webroot;?>img/nurse.png" alt="" />
                  </div>
                </div>
               </p>
         
        

      </div>
    </div>
</div>
   
   
<!--pop up 3rd-->
<div class='popbox_n'>
     <a class='open2' href='#'>
       <img src="<?php echo $this->webroot;?>img/pop_up_base_orange.png" alt="" width="87" />      
       </a>
     
     <div class='collapse2'>
      <div class='box2'>
        <div class='arrow2'></div>
        <div class='arrow-border2'></div>

        
          <p>
          <div class="pop_upbox">NEW VOLUNTEERS</div>
            <div class="bottom_border"></div>
             <div class="main_section">
                <div class="left_s">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                <br/><br/>
                <strong>- Reason One</strong><br/>
                 <strong>- Reason Two</strong><br/>
                  <strong>- Reason Three</strong><br/>
                   <strong>- Reason Four</strong><br/> 
                    <strong>- Reason Five</strong><br/>
                </div>
                   <div class="right_s">
                     <img src="<?php echo $this->webroot;?>img/nurse.png" alt="" />
                  </div>
                </div>
               </p>
         
        

      </div>
    </div>
</div>
<!--pop up 3rd end-->
</div>
            </div>
            <div class="mt50 clr"></div>
            <div class="section">
				<h1>CURRENT VOLUNTEERS</h1>
                <?php if($this->Session->read('User.id')==''){?>
                <div class="butt_outer">
                 <a href="<?php echo $this->webroot;?>users/login" class="green_butt ">LOGIN</a>
                </div>
				<?php }?>
                <div class="mt20"></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lobortis luctus mauris, et accumsan massa blandit at. Ut porta tempus sem, at posuere ante aliquet id. Mauris dignissim tristique erat, vel varius augue imperdiet tincidunt. Cras eu dolor arcu. Vivamus posuere ultrices ipsum ut dictum. Pellentesque et augue elementum, mattis enim vitae, lacinia sapien. Mauris convallis volutpat massa sed imperdiet. Sed volutpat nec nisl a ultricies. Morbi ornare vitae orci ut hendrerit. Praesent ac tempor eros. Proin pellentesque eu diam a mollis.</p>
                <div class="line mt20">
                <img src="<?php echo $this->webroot;?>img/line.png" />
                </div>
                
                
            </div>
			<div class="mt50 clr"></div>
            <div class="section">
				<h1>BUSINESS / COMPANIES</h1>
                 <?php if($this->Session->read('User.id')==''){?>
               <div class="butt_outer">
                 <a href="<?php echo $this->webroot;?>users/add/companies" class="oran_butt ">SIGN UP NOW</a>
                   </div>
                 <?php }?>
                <div class="mt20"></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lobortis luctus mauris, et accumsan massa blandit at. Ut porta tempus sem, at posuere ante aliquet id. Mauris dignissim tristique erat, vel varius augue imperdiet tincidunt. Cras eu dolor arcu. Vivamus posuere ultrices ipsum ut dictum. Pellentesque et augue elementum, mattis enim vitae, lacinia sapien. Mauris convallis volutpat massa sed imperdiet. Sed volutpat nec nisl a ultricies. Morbi ornare vitae orci ut hendrerit. Praesent ac tempor eros. Proin pellentesque eu diam a mollis.</p>
                <div class="line mt20">
                <img src="<?php echo $this->webroot;?>img/line2.png" />
                </div>
                
            </div>
            <div class="mt50 clr"></div>
            <div class="section">
				<h1>ORGANIZATIONS</h1>
                 <?php if($this->Session->read('User.id')==''){?>
                <div class="butt_outer">
                 <a href="<?php echo $this->webroot;?>users/add/organizations" class="blue_butt ">REGISTER NOW</a>
                   </div>
                  <?php }?>
                <div class="mt20"></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lobortis luctus mauris, et accumsan massa blandit at. Ut porta tempus sem, at posuere ante aliquet id. Mauris dignissim tristique erat, vel varius augue imperdiet tincidunt. Cras eu dolor arcu. Vivamus posuere ultrices ipsum ut dictum. Pellentesque et augue elementum, mattis enim vitae, lacinia sapien. Mauris convallis volutpat massa sed imperdiet. Sed volutpat nec nisl a ultricies. Morbi ornare vitae orci ut hendrerit. Praesent ac tempor eros. Proin pellentesque eu diam a mollis.</p>
                <div class="line mt20">
                <img src="<?php echo $this->webroot;?>img/line3.png" />
                </div>
                
            </div>
			<div class="mt20"></div>
</div>
