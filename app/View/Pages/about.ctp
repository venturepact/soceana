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
               <p>Millennials are increasingly driven toward both products and employers that promote social impact. Reputation Institute shows 73% of consumers strongly desire more long-term CSR. Gallup shows 70% of workers feel disengaged. Soceana is the game-changer; both mobile and web tools have been created through Soceana to address this change by helping companies better manage and promote social good. Soceana creates a central hub for key data analytics, personalized skills- based matching, and an engagement platform. It’s almost like a Facebook with its employee-led event planning and photo-upload features meets LinkedIn with its messaging and professional development all tied together with data analytics to create a unique product in a thriving space. Soceana will truly improve brand loyalty, increase employee satisfaction, and generate social good.</p>
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
          <div class="pop_upbox">Non-Profit Organizations</div>
            <div class="bottom_border"></div>
             <div class="main_section">
                <div class="left_s">
                	<ol>
                        <li>Streamlined mechanism of recording volunteers' service time.</li>
                        <li>Data Metrics and Analytics to better understand market trends and organizational impact.</li>
                        <li>Personalized Skills-Based Matching for better organization exposure and well-aligned, dedicated volunteers.</li>
                        <li>Engagement Platform for organizing events, enhanced communication, and event showcasing.</li>
                    </ol>
                <!--<br/><br/>
                <strong>- Reason One</strong><br/>
                 <strong>- Reason Two</strong><br/>
                  <strong>- Reason Three</strong><br/>
                   <strong>- Reason Four</strong><br/> 
                    <strong>- Reason Five</strong><br/>-->
                </div>
                   <!--<div class="right_s">
                     <img src="<?php echo $this->webroot;?>img/nurse.png" alt="" />
                  </div>-->
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
          <div class="pop_upbox">Volunteers</div>
            <div class="bottom_border"></div>
             <div class="main_section">
                <div class="left_s">
                	<ol>
                        <li>Central Hub for logging and tracking volunteer hours.</li>
                        <li>Data Metrics to better understand personal volunteer trends, preferences, and impact.</li>
                        <li>Personalized Skills-Based Matching for better service alignment and engagement.</li>
                        <li>Engagement Platform similar to social network for organizing events, bettered communication, and way to share memories.</li>
                    <ol>
                </div>
                   <!--<div class="right_s">
                     <img src="<?php echo $this->webroot;?>img/nurse.png" alt="" />
                  </div>-->
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
          <div class="pop_upbox">Profit-Driven Company</div>
            <div class="bottom_border"></div>
             <div class="main_section">
                <div class="left_s">
                <ol>
                    <li>Data Metrics and Analytics to measure firm’s social impact for 10Ks and annual reports as well as to increase brand and consumer loyalty.</li>
                    <li>Personalized Skills-Based Matching for increased employee satisfaction and transferable skill build.</li>
                    <li>Engagement Platform for showcasing service involvement and bettering communication streams within office space.</li>
                    <li>Engagement Platform also enables both employee-led and inter-company event planning leading to increased employee retention and bettered inter-company networks and relationships.</li>
                </ol>
                </div>
                   <!--<div class="right_s">
                     <img src="<?php echo $this->webroot;?>img/nurse.png" alt="" />
                  </div>-->
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
				<h1>VOLUNTEERS</h1>
                <?php if($this->Session->read('User.id')==''){?>
                <div class="butt_outer">
                 <a href="<?php echo $this->webroot;?>users/login" class="green_butt ">LOGIN</a>
                </div>
				<?php }?>
                <div class="mt20"></div>
                <p>Volunteers can forget the days of searching endlessly for desirable service opportunities. With Soceana, volunteers receive a way to find opportunities that align best with their individual skills so that they can make genuine contributions to communities and take part in a more rewarding volunteer experience. Soceana also creates a central hub for volunteering where individuals can use data metrics that measure the difference they have made by tracking their hours over time as well as the breakdown of the types of organizations they’re driven toward. Soceana will also enable volunteers to build communities among colleagues through employee-led event planning and provide an enhanced mechanism of communication. Volunteers can even preserve the highlights of their service experiences and other memories through photo-upload features and other interactive elements. Soceana helps facilitate truly memorable volunteering.</p>
                <div class="line mt20">
                <img src="<?php echo $this->webroot;?>img/line.png" />
                </div>
                
                
            </div>
			<div class="mt50 clr"></div>
            <div class="section">
				<h1>NOT-FOR-PROFIT ORGANIZATIONS</h1>
                 <?php if($this->Session->read('User.id')==''){?>
                <div class="butt_outer">
                 <a href="<?php echo $this->webroot;?>users/add/organizations" class="blue_butt ">REGISTER NOW</a>
                   </div>
                  <?php }?>
                <div class="mt20"></div>
                <p>Not-For-Profit Organizations can truly impact the community with the vision they were built on, especially with the facilitation of Soceana. Soceana enables measurement of Social Impact through data metrics that demonstrate both the good created by the organization as well as provides better market knowledge such as seeing volunteer trends in demographic or time-period changes. Additionally, Soceana provides a new channel of increased exposure through both being on the main volunteer matching-database as well as through event advertising on the site. Also, Soceana provides not only increased quantity, but also quality of volunteers through skills-based matching. Soceana really does provide a great venue for connecting with leaders in community and showcasing upcoming events through the messaging system as well as a bettered communication platform with volunteers and other nonprofits for events and collaborations. Soceana really helps nonprofits accelerate social good and continue to make a huge impact in the community.</p>
                <div class="line mt20">
                <img src="<?php echo $this->webroot;?>img/line3.png" />
                </div>
                
            </div>
            <div class="mt50 clr"></div>
            <div class="section">
				<h1>BUSINESS / PROFIT DRIVEN COMPANIES</h1>
                 <?php if($this->Session->read('User.id')==''){?>
               <div class="butt_outer">
                 <a href="<?php echo $this->webroot;?>users/add/companies" class="oran_butt ">SIGN UP NOW</a>
                   </div>
                 <?php }?>
                <div class="mt20"></div>
                <p>Profit Companies really boost and better their Corporate Social Responsibility through Soceana. By allowing both their employees to create profiles on Soceana as well as the company as a whole, companies are able to measure the social impact created by their firm through great data metrics and analytics that can be used in 10Ks, Annual Reports, etc. Furthermore, companies can have more cause-related marketing initiatives by sponsoring nonprofits as well as working more closely with similarly-minded nonprofit organizations. Also, through the skills-based matching, Soceana improves employee satisfaction by matching employees with roles that best align with their strengths as well as allows for more transferable skill development and engagement. Additionally, Soceana allows for increased employee retention through building stronger communities within the office through employee-led event planning as well as betters synergies within the community through intercompany collaborative events. Through messaging and photo-upload features, companies will have enhanced intra-company communication methods as well as increased public awareness of service participation. Soceana also provides a platform for both differentiation from other firms through this shift to long-term, active CSR initiatives as well as strategic advertising directly to relevant consumers via the site. Finally, Soceana enables better brand and consumer loyalty and creates a strong drive toward really making a difference in the community.</p>
                <div class="line mt20">
                <img src="<?php echo $this->webroot;?>img/line2.png" />
                </div>
                
            </div>
			<div class="mt20"></div>
</div>
