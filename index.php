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
  <div class="top_image">
    <div class="top_logo"></div>
    <div class="title_under_logo">
      <p>TAKE A STAND FOR WINTER</p>
      <p>GET HOOKED UP LIKE A PRO</p>
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
      <img class="fb_thumb" src="https://graph.facebook.com/<?php echo $user; ?>/picture">
    <?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif ?>

<?php
$isFan = $facebook->api(array(
  "method" => "fql.query",
  "query"  => "SELECT uid FROM page_fan WHERE page_id = '552821881436791' AND uid = $user"
));

print_r($isFan);

?>

</body>
</html>
