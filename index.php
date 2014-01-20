<?php
  require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '191151347752624',
  'secret' => 'a4c1147272a2df8f706f5ac2a7956b5b',
));

$request = $facebook->getSignedRequest();
$isFan = $request['page']['liked'];

?>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0"/>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="inc/jquery-1.10.2.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="https://fast.fonts.net/jsapi/c71e20be-219a-4a86-8783-74514d0a6982.js">
  </script>
<script>
;(function($){
  $(document).ready(function() {
    var form = $('#formular');
    var inputs = $('input[type=text]');
    inputs.on('focus', function(e){
      $(this).removeClass('error');
    });
    form.on('click', '#mc-embedded-subscribe', function(e){
      e.preventDefault();
      var send = true;
      var email     = $("#two").val();
      var fname     = $("#one").val();
      var insta     = $("#three").val();
      var sevenp    = $("#option1").is(':checked');
      var subscribe = $("#option2").is(':checked');
      var agree     = $("#option3").is(':checked');


      if ( !(/(.+)@(.+){2,}\.(.+){2,}/.test(email)) || email=="" || email==null) {
        var node = $("#two").parent();
        node.addClass('error');
        send = false;
      }
      if ( fname=="" || fname ==null) {
        var node1 = $("#one");
        node1.addClass('error');
        send = false;
      }
      if ( insta=="" || insta==null) {
        var node2 = $("#three");
        node2.addClass('error');
        send = false;
      }
      /* if ( !sevenp ) {
        var node3 = $("#option1");
        node3.addClass('error');
        send = false;
      }
      if ( !subscribe ) {
        var node4 = $("#option2");
        node4.addClass('error');
        send = false;
      }*/
      if ( !agree ) {
        var node5 = $("#option3");
        node5.addClass('error');
        send = false;
      }

      if (send){
        $(".error-msg").hide();
        $.ajax({
          url: form.attr('action'),
          type: 'post',
          data:  { 'FNAME' : fname , 'INSTA' : insta, 'EMAIL' : email, 
          'SEVENP': sevenp, 'SUBSCRIBE': subscribe, 'AGREE': agree },
          dataType: "text" 
        });
        $('.subscribe_mask').show();
        FB.Canvas.scrollTo(0,0);
      } 
      else $(".error-msg").show(); 
    })
  });

})(jQuery);
</script>

</head>
<body>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId   : '191151347752624',
      status  : true,
      xfbml   : true,
      cookie  : true,
      channelUrl : 'http://discretepow.herokuapp.com/channel.html',
      oauth  : true 
    });
    
    FB.Canvas.setAutoGrow(1000);

    if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {     
      FB.Event.subscribe('auth.authResponseChange', function(response) {
        if (response.status === 'connected') {
          testAPI();
        } else if (response.status === 'not_authorized') {
          $('.fb-like').hide();
          $('.fb-login-button').show();
          FB.login(function() {}, {scope: 'user_likes'} );
        } else {
          $('.fb-like').hide();
          $('.fb-login-button').show();
          FB.login(function() {}, {scope: 'user_likes'} );
        }
      });
      FB.Event.subscribe('auth.login', function(){
        window.location.reload();
      });
      FB.Event.subscribe('auth.logout', function(){
        window.location.reload();
      });
    } else {

      FB.Event.subscribe("edge.create",  function(href, widget ) {
        top.window.location = 'https://www.facebook.com/discreteheadwear/app_191151347752624'
      });
    }
  };
  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  function testAPI() {
    FB.api('/me', function(response) {
      FB.api("/"+response.id+"/likes/191151347752624", function(apiResponse){ 
        if (apiResponse.data && apiResponse.data.length > 0){
          $('.fb_like_mask').hide();
          $('.fb-like').hide();
          $('.fb-login-button').hide();
        } else {
          $('.fb-login-button').hide();
          $('.fb-like').show();
        }
      });
    });
    FB.Event.subscribe("edge.create",  function(href, widget ) {
      window.location.reload();
    });
  };
</script>

  <?php if (!$isFan): ?>
    <div class="fb_like_mask"></div>
    <div class="fb-like"
      data-href="https://www.facebook.com/discreteheadwear/app_191151347752624"
      data-width="600"
      data-layout="button_count"
      data-action="like"
      data-show-faces="false"
      data-share="false"
      data-colorscheme="dark">
    </div>
  <?php endif ?>
  <div class="fb-login-button" data-max-rows="1" data-show-faces="false" data-scope="user_likes" ></div>
  <div class="subscribe_mask"></div>
  <div class="top_image">
    <div class="top_logo"></div>
    <div class="title_under_logo">
      <p>TAKE A STAND FOR WINTER</p>
      <p>GET HOOKED UP LIKE A PRO</p>
    </div>
    <div class="bottom_text">
      <h2>WE LOVE WINTER. LET'S TAKE A STAND TO PROTECT IT</h2>
      <p>Winters are getting dryer and shorter every year. Politics aside, that's not good for anyone, especially skiers and snowboarders. Winter is our season but winter is in trouble. So let's do something about it! <strong>Protect Our Winters</strong> is uniting the global winter sports community to fight climate change's effects on our sport. Take the POW Seven Pledge and start making an impact on the future of Winter! </p>
        
      <p><strong>As a thank you for supporting POW, the sponsoring brands have put together some amazing prize packages.</strong> </p>

    </div>
  </div>
  <div class="win">
    <div class="weekly_prize">
      <div class="desc_text">
        <p class="prize">WEEKLY PRIZE</p>
        <h2>GOPRO HERO 3, $150 IN DISCRETE GEAR AND MORE</h2>
        <p>Each week we'll select one lucky winner to take home the new GoPro Hero 3,
            $150 in Discrete gear and a <i>Into the Mind</i> Blu-Ray signed by
            Julian Carr</p>
      </div>
      <img src="imgs/win_products.png" />
    </div>
    <div class="grand_prize">
      <div class="desc_text">
        <p class="prize">GRAND PRIZE</p>
        <h2>ROCK BRIGHTON LIKE A PRO WITH THE PROS</h2>
        <p>Win a trip for two, including airfare, to ski with GoPro athletes at the
            world-renowned Brighton Mountain Resort in Utah's Wasatch Mountains.
            We'll also hook you up with complete ski kit including:</p>
        <ul>
          <li>+ GoPro Hero 3 Black Edition</li>
          <li>+ Icelantic Skis</li>
          <li>+ Custom Boots from Daleboot</li>
          <li>+ Complete Spyder Outerwear and Baselayer Package</li>
          <li>+ Apres Apparel by Discrete</li>
          <li>+ $5,000 Total Value</li>
        </ul>
      </div>
      <img src="imgs/win_grand_prize.jpg" />
    </div>
  </div>

  <div class="want_in">
    <div class="ready">
      <h2>READY?</h2>
      <p>HERE'S HOW IT WORKS:</p>
    </div>
    <div class="step one">
      <div class="title">
        <p>STEP ONE</p>
        <h2>POW SEVEN PLEDGE</h2>
      </div>
      <img src="imgs/wantin_step1.jpg" />
        <p class="qualification">WEEKLY PRIZE QUALIFICATION</p>
      <div class="caption">
        <h2>TAKE THE POW SEVEN PLEDGE</h2>
        <p>As a thank you for taking the pledge, you're entered in each of our
            weekly prize deawing from GoPro and Discrete</p>
      </div>
    </div>
    <div class="step two">
      <div class="title">
        <p>STEP TWO</p>
        <h2>INSTAGRAM #UnitedWePOW</h2>
      </div>
      <img src="imgs/wantin_step2.jpg" />
        <p class="qualification">GRAND PRIZE QUALIFICATION</p>
      <div class="caption">
        <h2>WIN THE ULTIMATE SKI WEEKEND IN UTAH</h2>
        <p>Tag your ski, snowboard and general winter-loving pics on
          <strong> Instagram</strong> with <strong class="wantin">#UnitedWePOW</strong>
           and <strong class="wantin">@ProtectOurWinters</strong>. Hit it hard all 
          season long. In March, we'll invete our favorite 
          <strong class="wantin">#UnitedWePow</strong> Instagrammer and a freind
          to join us in the Wasatch Mountains of Utah for an all-expense-paid
          trip to ski with GoPro athlete Julian Carr and friends on the world-cass
          terrain of Snowbird Mountain Resort.</p>
      </div>
    </div>
  </div>

  <div class="pledge">
    <div class="top_pledge">
      <img src="imgs/pow_logo.png" class="powlogo" />
      <div class="pledge_text">
        <h2>OUR TIME IS NOW.</h2>
        <p>There is no much information out there, it's tough to know that you're
            actally making a difference. We'll make it super-ease for you. We'll
            consolidated the best and most effective actions into one short list.
            The POW SEVEN is simple and effective.<br /><strong>Pledge to do POW
            SEVEN once a month and you'll make a difference</strong></p>
      </div>
    </div>

    <div class="pledges_container">
      <div class="pledge_child">
        <p>01</p>
        <h2>GET<br />POLITICAL</h2>
        <p>Contact your elected official and encourage them to take action on
            climate change.</p>
      </div>

      <div class="pledge_child">
        <p>02</p>
        <h2>EDUCATE<br />YOURSELF</h2>
        <p>Read as much as possible and talk to others.
Visit: <a href="http://climate.nasa.gov/" target="_blank">climate.nasa.gov</a>
 and <a href="http://grist.org/" target="_blank">grist.org</a></p>
      </div>

      <div class="pledge_child">
        <p>03</p>
        <h2>FIND YOUR<br />BIGGEST LEVER</h2>
        <p>Discover your sphere of influence and start influencing.</p>
      </div>

      <div class="pledge_child">
        <p>04</p>
        <h2>BE VOCAL, BUG<br />YOUR FRIENDS</h2>
        <p>Speak up about climate change to your
family, friends and co-workers. Have a POW party.</p>
      </div>

      <div class="pledge_child jump">
        <p>05</p>
        <h2>TALK TO<br />BUSINESSES</h2>
        <p>Support businesses taht embrace sustainability. Talk to others about
            what they could be doing.</p>
      </div>
      <div class="pledge_child ">
        <p>06</p>
        <h2>CHANGE YOUR LIFE AND SAVE MONEY</h2>
        <p>Saving the planet isn't hard.
In fact it'll save you money. Look around you and see where you can find
less carbon intensive options.</p>
      </div>

     
      <div class="pledge_child join ">
        <p>07</p>
        <h2>JOIN<br />POW</h2>
        <p>Help us create a movement against climate change, and
keep our winters white.</p>
      </div>

       <div class="pledge_child powseven">
      </div>

         </div>
  </div>

  <div class="signup">

    <div class="title">
      <h2>TAKE<br />THE PLEDGE.</h2>
      <br />
      <h2>TAG <span>#UnitedWePOW</span></h2>
    </div>

    <form action="mcapi_listSubscribe.php" method="post" id="formular">
      <fieldset>
        <input class="inp-text" placeholder="Full Name" name="one" id="one" type="text" size="40" /><br />

        <input class="inp-text" placeholder="Email address" name="two"  id="two" type="text" size="40" /><br />

        <input class="inp-text" placeholder="Instagram" name="three"  id="three" type="text" size="40" /><br />

        <label for="option1">
          <input class="choose" name="option[]" id="option1" type="checkbox" value="true" />
            &nbsp;I TOOK THE POW SEVEN PLEDGE
        </label>
        <label for="option2">
          <input class="choose" name="option[]" id="option2" type="checkbox" value="true" />
            &nbsp;SEND ME MORE INFORMATION FROM POW AND PARTNERS
            <span>25% off Discrete Promo Code Comes in First POW EMAil</span>
        </label>
        <label for="option3">
          <input class="choose" name="option[]" id="option3" type="checkbox" value="true" />
          &nbsp;I AGREE TO THE <a href="term.html">TERMS AND CONDITIONS</a>
        </label> 
        <div id="mce-responses" class="clear">
          <div class="response" id="mce-error-response" style="display:none"></div>
          <div class="response" id="mce-success-response" style="display:none"></div>
        </div> 

        <p><input id="mc-embedded-subscribe" class="submit-button" type="submit" alt="SUBMIT" name="Submit" value="SUBMIT" /></p>
        <p class="error-msg">Please fill all fields or check the red bordered ones.</p>
      </fieldset>
    </form>

    <div class="bottom">
      <img src="imgs/discrete_logo.png" />
      <p><span><strong>BONUS!</strong></span> 25% OFF DISCRETE JUST FOR SIGNING THE POW SEVEN PLEDGE!</p>
    </div>
  </div>
  <div class="footer_img">

      <img src="imgs/footer_bg.jpg" />
  </div>
  <div class="sponsors_footer">
    
      <img src="imgs/sponsors_footer_bg.jpg" />
  </div>

</body>
</html>
