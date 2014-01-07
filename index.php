<?php
  require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '191151347752624',
  'secret' => 'a4c1147272a2df8f706f5ac2a7956b5b',
));

$user = $facebook->getUser();
if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

$pageFanId=226931190751436;
$isFan = $facebook->api(array(
  "method" => "fql.query",
  "query"  => "SELECT uid, page_id FROM page_fan WHERE page_id = '$pageFanId' AND uid = '$user'"
));

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $statusUrl = $facebook->getLoginStatusUrl();
  $loginUrl = $facebook->getLoginUrl();
}

?>

<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '191151347752624',                        // App ID from the app dashboard
      status     : true,                                 // Check Facebook Login status
      xfbml      : true                                  // Look for social plugins on the page
    });
FB.Canvas.setAutoGrow(1000);
  };

  // Load the SDK asynchronously
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/all.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

  <?php if (!$isFan): ?>
    <div class="fb_like_mask">
    </div>
  <?php endif ?>
    <?php print_r($isFan); ?>
    <?php print_r($user); ?>
    <?php echo $loginUrl; ?>

<?php
$request = $facebook->getSignedRequest();
$IsFan = $request['page']['liked'];
echo 'es fan: '.$IsFan;
?>

  <div class="top_image">
    <div class="top_logo"></div>
    <div class="title_under_logo">
      <p>TAKE A STAND FOR WINTER</p>
      <p>GET HOOKED UP LIKE A PRO</p>
    </div>
    <div class="bottom_text">
      <h2>WE LOVE WINTER. LET'S TAKE A STAND TO PROTECT IT</h2>
      <p>The last decade has been the hottest on record, Politics aside, that's not
          good for anyone, especially skiers and showboarders. Winter is our season
          but winter is in trouble. So let's do something about it!.
          <strong>Protect Our Winters</strong> is the POW Seven Pledge ans start making 
          an impact on the future of Winter!</p>
      <p><strong>Our partners have put together some amazing prize packages as a thank
              you for supporting POW</strong>
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
        <h2>ROCK THE BIRD LIKE A PRO WITH THE PROS</h2>
        <p>Win a trip for two, including airfare, to ski with GoPro athletes at the
            world-renowned Snowbird Mountain Resort in Utah's Wasatch Mountains.
            We'll also hook you up with complete ski kit including:</p>
        <p>+ GoPro Hero 3 Black Edition</p>
        <p>+ Icelantic Skis<p>
        <p>+ Custom Boots from Daleboot<p>
        <p>+ Complete Spyder Outerwear and Baselayer Package<p>
        <p>+ Apres Apparel by Discrete<p>
      </div>
      <img src="imgs/win_grand_prize.jpg" />
    </div>
  </div>

  <div class="want_in">
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
    <div>
  </div>

    <?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>

    <?php if ($user): ?>
      <?php if ($isFan): ?>
        <img class="fb_thumb" src="https://graph.facebook.com/<?php echo $user; ?>/picture">
      <?php endif ?>
    <?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif ?>

</body>
</html>
