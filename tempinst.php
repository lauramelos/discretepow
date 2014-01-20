<!DOCTYPE html>
<head>

  <script src="inc/jquery-1.10.2.min.js" type="text/javascript"></script>
  <script src="inc/get_images.js" type="text/javascript"></script>

</head>

<?php       
  include_once('get_images.php');

  $host = $_SERVER['SERVER_NAME'];
?>
  <a class="loadmore" href="http://<?php echo $host; ?>/tempinst.php?next_pics=<?php echo $next_pics; ?>">next 20</a>
  <div style="background-color: red;" id="morepics">more</div>
<?php
    echo '<pre>';
    //print_r($results);
    echo '</pre>';

?>

