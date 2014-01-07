<?php
  require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '191151347752624',
  'secret' => 'a4c1147272a2df8f706f5ac2a7956b5b',
));
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
</body>
</html>
