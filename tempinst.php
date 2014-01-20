<?php
  require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '230882110427062',
  'secret' => '85a1afa43610eaca11ad5ef17930cfe1',
));

$request = $facebook->getSignedRequest();
$isFan = $request['page']['liked'];

if($isFan) {
  echo '<p>liked</p>';
}

?>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <script src="inc/jquery-1.10.2.min.js" type="text/javascript"></script>
  <script src="inc/get_images.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="instagram.css">
</head>
<body>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId   : '230882110427062',
      status  : true,
      xfbml   : true,
      cookie  : true,
      channelUrl : 'http://discretepow.herokuapp.com/channel.html',
      oauth  : true 
    });
    
    FB.Canvas.setAutoGrow(1000);
  }
</script>

<?php       
  include_once('get_images.php');

  $host = $_SERVER['SERVER_NAME'];
?>
  <div style="background-color: red;" id="morepics">more</div>
<?php
    echo '<pre>';
    //print_r($results);
    echo '</pre>';

?>
</body>
</html>
