 <?php
App::uses('AppHelper', 'View/Helper');
class SponsorHelper extends AppHelper {
    var $helpers = array('Html');

   function load_advertisements(){
	$rand = rand(0, 1);
	switch($rand){
		case 0:
			$sponsor = "<div class='add_img_outer'><img src='".$this->webroot."img/sp1.png' width='364' height='182' alt='' /></div><div class='sponser_outer'><div class='sponser_inner'><h7>The Children's Hospital of Philadelphia is one of the largest and oldest children's hospitals in the world. CHOP has been ranked as the best children's hospital in the United States by U.S. News & World Report and Parents Magazine in recent years.</h7></div><div class='tip'></div><div class='add_section'><div class='section1'><div class='black_text'>THE CHILDREN’S HOSPITAL OF PHILADELPHIA</div><div class='black_text_thin'>3401 Civic Center Blvd. Philadelphia PA(215) 590-1000</div><a href='http://www.chop.edu/about/volunteer-opportunities/' class='orange_butt' target='_blank'>VOLUNTEER THROUGH SOCEANA</a></div><div class='section2'><img src='".$this->webroot."img/ch_image.png' width='100%' height='100%' alt='' /></div></div></div><div class='add_img_outer'><img src='".$this->webroot."img/sp2.png' width='364' height='182' alt='' /></div><div class='sponser_outer'><div class='sponser_inner'><h7>The Philadelphia Zoo offers volunteer opportunities for individuals and groups ranging in abilities and in age from 14 to 90+ years old. Most of the Zoo’s approximately 500 volunteers support our education programs in an on-going basis, teaching Zoo visitors about animals and conservation projects. Additionally, volunteers provide office assistance and professional services. One-time opportunities are offered depending upon seasonal programming. Further, the Zoo utilizes over 175 interns each year, providing individuals with valuable career experience in a variety of fields including animal care, education and business administration.</h7></div><div class='tip'></div><div class='add_section'><div class='section1'><div class='black_text'>Philadelphia Zoo</div><div class='black_text_thin'>3400 W Girard Ave, Philadelphia, PA 19104</div><a href='http://www.philadelphiazoo.org/Get-Involved/Volunteer.htm' class='orange_butt' target='_blank'>VOLUNTEER THROUGH SOCEANA</a></div><div class='section2'><img src='".$this->webroot."img/main_steel_img.png' width='100%' height='100%' alt='' /></div></div></div>";
		break;
		case 1:
		$sponsor = "<div class='add_img_outer'><img src='".$this->webroot."img/sp3.png' width='364' height='182' alt='' /></div><div class='sponser_outer'><div class='sponser_inner'><h7>Relying on our core of volunteers, Manna seeks to end hunger in the North Penn region by providing food, fulfilling social service needs and conducting community education through a food pantry and soup kitchen, emergency financial aid, counseling and referrals and community outreach.</h7></div><div class='tip'></div><div class='add_section'><div class='section1'><div class='black_text'>MANNA ON MAIN STREET</div><div class='black_text_thin'>713 W Main St Lansdale, PA 19446</div><a href='http://www.mannaonmain.org/get-involved/volunteers' class='orange_butt' target='_blank'>VOLUNTEER THROUGH SOCEANA</a></div><div class='section2'><img src='".$this->webroot."img/main_steel_img.png' width='100%' height='100%' alt='' /></div></div></div><div class='add_img_outer'><img src='".$this->webroot."img/sp4.png' width='364' height='182' alt='' /></div><div class='sponser_outer'><div class='sponser_inner'><h7>We have many opportunities at Parkway Central Library and our 53 neighborhood branches throughout the city, including the Library for the Blind and the Physically Handicapped. Our volunteers help us with special events; assist Philadelphia’s New Americans gain familiarity with a new language by acting as a English Language Facilitator; help departments maintain their collections; provide senior citizens with one-on-one with computer assistance; and help to shelve both new and returned material.</h7></div><div class='tip'></div><div class='add_section'><div class='section1'><div class='black_text'>Free Library of Philadelphia</div><div class='black_text_thin'>1901 Vine Street Philadelphia, PA 19103</div><a href='http://www.freelibrary.org/volserv/volserv.htm' class='orange_butt' target='_blank'>VOLUNTEER THROUGH SOCEANA</a></div><div class='section2'><img src='".$this->webroot."img/main_steel_img.png' width='100%' height='100%' alt='' /></div></div></div>";
		break;
	}
	return $sponsor;
}
}
?> 