<?php

  if ($_GET['next_pics']):
  $extra_query = '&max_tag_id='.$_GET['next_pics'];
  endif;

  if ($_GET['prev_pics']):
  $extra_query = '&min_tag_id='.$_GET['prev_pics'];
  endif;

  function callInstagram($url)
    {
    $ch = curl_init();
    curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 2
    ));

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
    }

  $tag = 'bjj';
  $client_id = "11115ed2e74d47bbbebb4c69dbacfae2";
  $url = "https://api.instagram.com/v1/tags/$tag/media/recent?client_id=$client_id$extra_query";


  $inst_stream = callInstagram($url);
  $results = json_decode($inst_stream, true);

  //Now parse through the $results array to display your results... 
  foreach($results['data'] as $item){
      $image_link = $item['images']['low_resolution']['url'];
      echo '<div class="image_box">';
      echo '<img src="'.$image_link.'" />';
      echo '<p>Comments: '.$item['comments']['count'].'</p>';
      echo '<p class="likes">Likes: '.$item['likes']['count'].'</p>';
      echo '</div>';
  }
  $next_pics = $results['pagination']['next_max_tag_id'];
  $prev_pics = $results['pagination']['min_tag_id'];

  /*echo '<pre>';
  print_r($results);
  echo '</pre>';
   */
?>
  <script>
    var morepics = <?php echo $next_pics; ?>;
  </script>

