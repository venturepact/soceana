<style>
    .profile_content_main{min-height: 0;}
</style>
<script>
function showonlyone(thechosenone) {
      var newboxes = document.getElementsByTagName("div");
            for(var x=0; x<newboxes.length; x++) {
                  name = newboxes[x].getAttribute("class");
                  if (name == 'newboxes') {
                        if (newboxes[x].id == thechosenone) {
                        newboxes[x].style.display = 'block';
                  }
                  else {
                        newboxes[x].style.display = 'none';
                  }
            }
      }
}</script>
<div class="profile_content_main">
	    <div class="profile_content_left">
                  <div class="main_heading_gray">FAQ</div>
            </div>                 
</div>
<div class="profile_content_main"><br />
                <p style="color:#666; padding-bottom:8px;"><strong>Need help? Take a look at our frequently asked questions.</strong></p>
 <div class="orange_text">
            <a id="myHeader1" href="javascript:showonlyone('newboxes1');" >Question Number One</a>
         </div>
         <div class="newboxes" id="newboxes1">
         Praest dui ipsum, scelerisque semper tincidunt non, consequat in massa. Ut laoreet, leo non fringilla cursus, risus quam rhoncus velit, nec hendrerit nibh ligula ac justo. Vestibulum eros turpis, hendrerit eget ligula convallis, euismod tempus augue. Integer eleifend lorem eu lobortis rutrum. Proin nec tortor in ante ornare volutpat vel feugiat nulla. Suspendisse eget nisi nisi. Ut aliquam ante eget orci gravida viverra. Donec eget ornare sapien. Pellentesque ut urna ac turpis tempor molestie. Interdum et malesuada fames ac ante ipsum primis in faucibus.
         </div> 
         <div>&nbsp;</div>
         
     <div class="orange_text">
            <a id="myHeader2" href="javascript:showonlyone('newboxes2');" >Question Number Two</a>
        </div>
         <div class="newboxes" id="newboxes2" style="display: none;padding: 5px;">scelerisque semper tincidunt non, consequat in massa. Ut laoreet, leo non fringilla cursus, risus quam rhoncus velit, nec hendrerit nibh ligula ac justo. Vestibulum eros turpis, hendrerit eget ligula convallis, euismod tempus augue. Integer eleifend lorem eu lobortis rutrum. Proin nec tortor in ante ornare volutpat</div>
         
         <div>&nbsp;</div>
         
         <div class="orange_text">
            <a id="myHeader3" href="javascript:showonlyone('newboxes3');" >Question Number Three</a>
        </div>
         <div class="newboxes" id="newboxes3" style="display: none;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
         
         
<div>&nbsp;</div>
              </div>