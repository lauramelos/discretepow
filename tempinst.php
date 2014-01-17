<head>

  <script src="inc/jquery-1.10.2.min.js" type="text/javascript"></script>
  <script src="inc/get_images.js" type="text/javascript"></script>

</head>

<?php       
  include_once('get_images.php');
  echo $results[pagination][next_url];
  $next_pics = $results[pagination][next_max_tag_id];
  $prev_pics = $results[pagination][min_tag_id];
  echo "Next from: $next_pics";
  echo "Previous from: $prev_pics";
?>
  <a href="http://<?php echo $host; ?>/tempinst.php?prev_pics=<?php echo $prev_pics; ?>">prev 20</a>
  <a href="http://<?php echo $host; ?>/tempinst.php?next_pics=<?php echo $next_pics; ?>">next 20</a>
<?php
    echo '<pre>';
    //print_r($results);
    echo '</pre>';

?>

