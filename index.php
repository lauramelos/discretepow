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
  "query"  => "SELECT uid, page_id FROM page_fan WHERE page_id = $pageFanId AND uid = $user"
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

    // Additional initialization code such as adding Event Listeners goes here

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
    <div class="fb_like_mask"></div>
  <?php endif ?>

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
