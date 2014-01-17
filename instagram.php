<?php
/**
 * Template Name: Instagram facebook page
 * @package WordPress
**/
function getInstagrams ($ids, $params) {
  $fn = $params['id'].'_'.$ids.'_'.$params['number'];
  $ids = explode(',', $ids);
  if (!$params['retrieve'] and _fs_localFileExists($fn)) {
    $arrInstam = json_decode(_fs_loadLocalFile($fn), true);
  } else {
    $int = array ();
    $user = array();

    foreach($ids as $id) {

      $url ='';
      if($term = strstr($id,  '#')) {

        $term = substr($term, 1);
        $url = "https://api.instagram.com/v1/tags/%s/media/recent?client_id=%s&access_token=198565484.ed5f894.4e4948fbaa574cdca50fb54509406841";
        $url = sprintf($url, urlencode($term), trim($params['client_id']));
        array_push($int, json_decode(_fs_getData($url), true));
      }
      else if($term = strstr($id, '@')) {

        $term = substr($term, 1);
        $iduser = "https://api.instagram.com/v1/users/search?q=%s&client_id=%s";
        $iduser = sprintf($iduser, urlencode($term), trim($params['client_id']));
        array_push($user, json_decode(_fs_getData($iduser), true));
        if( $user[0]['data'][0]['username'] == $term){
          $uid = $user[0]['data'][0]['id'];
          $url = "https://api.instagram.com/v1/users/%s/media/recent/?count=20&access_token=198565484.ed5f894.4e4948fbaa574cdca50fb54509406841";
          $url = sprintf($url, $uid );

          array_push($int, json_decode(_fs_getData($url), true));
        
/*          $url = "https://api.instagram.com/v1/users/self/media/liked?count=9&access_token=198565484.ed5f894.4e4948fbaa574cdca50fb54509406841";
          $url = sprintf($url, $uid );

          array_push($int, json_decode(_fs_getData($url), true));*/
       }
     }
    }

    $arrInstam=$int;

  }

  return $arrInstam;
}
 $params['id'] = 1254;
 $params['retrieve'] = true;
 $params['number'] = 1254;
 $params['count'] = 20;
 $params['client_id'] = '11115ed2e74d47bbbebb4c69dbacfae2';

 $identifiers ='#bjj';
 
 $data['instams'] = getInstagrams($identifiers, $params);

 echo '<pre>';
 print_r($data);
 echo '</pre>';

?> 
<!doctype html>
<html>
  <head>
    <title>Instagram</title>
 <script type='text/javascript' src="<?php echo get_bloginfo( 'template_url' ).'/js/jquery-1.7.1.min.js';  ?>"></script>
<script src="<?php echo get_bloginfo( 'template_url' ).'/js/jquery-ui.js' ?>"></script>
<script type="text/javascript">


;(function($){
  $(document).ready(function() {
    window.fbAsyncInit = function()
    {
      FB.Canvas.setSize();
    }
    var header =$('#header');
    header.on('click', '.cnav a', function(ev){
      ev.preventDefault();
      if($(this).hasClass('hash')){
        $('.useri').hide();
        $('.hashi').show('fade');
        $(this).addClass('active');
        $('.user').removeClass('active');
      }
      else{
        $('.hashi').hide();
        $('.useri').show('fade');
        $(this).addClass('active');
        $('.hash').removeClass('active');
      }
    });

  });
})(jQuery);   

</script>

<style>
@font-face {
  font-family: 'YakimaHand';
  src: url("<?php echo get_bloginfo( 'template_url' ) ?>/font/yakimahand-regular-webfont.eot");
  src: url("<?php echo get_bloginfo( 'template_url' ) ?>/font/yakimahand-regular-webfont.eot?#iefix") format('embedded-opentype'), url("<?php echo get_bloginfo( 'template_url' ) ?>/font/yakimahand-regular-webfont.woff") format('woff'), url("<?php echo get_bloginfo( 'template_url' ) ?>/font/yakimahand-regular-webfont.ttf") format('truetype'), url("<?php echo get_bloginfo( 'template_url' ) ?>/font/yakimahand-regular-webfont.svg#YakimaHandRegular") format('svg');
  font-weight: normal;
  font-style: normal;
}
body{margin:0; padding:0; height:1300px; width: 785px}
#header{
background:url(<?php echo get_bloginfo( 'template_url' ) ?>/images/bg-instagram.png) no-repeat 0 0;
width:100%;height:139px;
margin:0 auto}
#content{
background: #f9f6f1;
padding: 20px 0 0 0;
}
ul {list-style:none; padding:0 0 0 20px; margin:0 }
ul li{
float: left;
margin: 0 15px 25px 15px;
box-shadow: 0 0 3px #1f2324;
-webkit-box-shadow: 0 0 3px #1f2324;
-moz-box-shadow: 0 0 3px #1f2324;
border: 4px solid #dfd1a7;

}
ul li a{
display:block;
width:150px; height:150px;
}
a.logo{
  float:left;
  width:210px;
  text-decoration:none;
  padding: 20px 0 0 20px;
  display:block;
 }
.social-logo{
position:relative;
top:25px;
margin-left: 55px;
}
h3{
clear:both;
width: 100%; 
margin: 0;
line-height: 35px;
font: normal 18px/36px "YakimaHand", "Helvetica Neue", Helvetica, Arial, sans-serif;
color:#5a5b59;
text-decoration:none;
margin: 0 20px;
}
h3 a{
color:#5a5b59;
text-decoration:none;
 
}
h3 a:hover{
  color: #ff0000;
}
h3 a.user{margin: 0 17px 0 34px}
h3 a.hash{margin: 0 85px 0 0}
h3 a.active{
color:#ff0000;
}
h4 a {
font: normal 18px/36px "YakimaHand", "Helvetica Neue", Helvetica, Arial, sans-serif;
color:#5a5b59;
text-decoration:none;

}
.fb-like{
float:right;
margin-top:30px;
}
.fb-comments{
margin-left:25px;
}
div.cnav {
font-size: 12px;
background: white;
font-family: 'lucida grande', tahoma, verdana, arial, sans-serif;
padding: 25px 0 4px 5px;
border-bottom: 1px solid #D8DFEA;
}
div.cnav a {
padding: 6px 10px 4px 10px;
border: 1px solid #D8DFEA;
background: white;
text-decoration: none;
color: black;
font-weight: bold;
}
div.cnav a.active {
background: #f9f6f1;
border-bottom: 0;
color: #FF0E0B;
padding-bottom: 5px;
}
</style>
  </head>
  <body>
    <div id="header">
      <a href=" <?php echo home_url('/') ?>" class="logo">
        <img src="<?php echo get_bloginfo( 'template_url' ).'/images/logo2.png'; ?>" alt="Yakima - Get Social" width="209" />
      </a>
      <!--img src="<?php echo get_bloginfo( 'template_url' ) ?>/images/instagram.png" alt="instagram" class="social-logo" / -->
      <div class="fb-like" data-send="true" data-width="220" data-show-faces="false" data-font="arial"></div>
      <h3>FOLLOW <a href="http://followgram.me/yakimaracks/" target="_blank" class=follow">@YAKIMARACKS </a> ON INSTAGRAM</h3>
      <div class="cnav">
       <a href="?id=@yakimaracks" class="user active">@yakimaracks</a>&nbsp;<a href="?id=#takemorefriends" class="hash" >#takemorefriends</a>
      </div>
    </div>
    <div id="content">


<?php 
 $instams = $data['instams'];
 $count = $params['count'];
?>
<ul>
<?php
    $loop=0;
    foreach($instams[0]['data'] as $its) : ?>
    <?php $results = $its['images'];
          $caption = $its['caption'];
          $link    = $its['link'];
    ?>
    <li class="useri" >
      <a class="group" href="<?php echo $link ?>" title="<?php echo $caption['text']; ?>" target="_blank" ><img src="<?php echo str_replace('http', 'https', $results['thumbnail']['url']); ?>" width ="150" height="150" /></a>
    </li>
    <?php
      $loop++;
      if($count==$loop) break; 
      endforeach;?>

<?php
    $loop=0;
      foreach($instams[1]['data'] as $its) : ?>
    <?php $results = $its['images'];
          $caption = $its['caption'];
          $link    = $its['link']?$its['link']:$its['images']['standard_resolution']['url'];
    ?>
    <li class="hashi" style="display:none" >
      <a class="group" href="<?php echo $link ?>" title="<?php echo $caption['text']; ?>" target="_blank" ><img src="<?php echo str_replace('http', 'https', $results['thumbnail']['url']); ?>" width ="150" height="150" /></a>
    </li>
    <?php
      $loop++;
      if($count==$loop) break; 
      endforeach;?>



</ul>
<div class="fb-comments" data-href="https://www.facebook.com/pages/Yakima-test/399004496820979?sk=app_268012363302175" data-num-posts="10" data-width="750"></div>
    </div>
<div id="fb-root"></div>
    <script type="text/javascript" src="https://connect.facebook.net/en_US/all.js"></script> 
    <script type="text/javascript">

    FB.init({
        appId: '268012363302175', 
        status: true, 
        cookie: true, 
        xfbml: true
    });

    /* Init fb Resize window */

    /* Completly removed now in JS SDK*/
    /* FB.Canvas.setAutoResize(7); */

    /* As of Jan 2012 you need to use */
    FB.Canvas.setAutoGrow(7);

    </script>
  </body>
</html>
