<?php       
    // Get class for Instagram
    // More examples here: https://github.com/cosenary/Instagram-PHP-API
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    require_once 'inc/instagram.class.php';

    // Initialize class with client_id
    // Register at http://instagram.com/developer/ and replace client_id with your own
    $instagram = new Instagram('11115ed2e74d47bbbebb4c69dbacfae2');

    // Set keyword for #hashtag
    $tag = 'bjj';

    // Get latest photos according to #hashtag keyword
    $media = $instagram->getTagMedia($tag);

    // Set number of photos to show
    $limit = 200;

    // Set height and width for photos
    $size = '300';

    // Show results
    // Using for loop will cause error if there are less photos than the limit
    foreach(array_slice($media->data, 0, $limit) as $data)
    {
        // Show photo
        echo '<img style="float: left; display: block;" src="'.$data->images->thumbnail->url.'" height="'.$size.'" width="'.$size.'" alt="SOME TEXT HERE" />';
    }

    echo 'end class testing<br />....';

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
    $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;

    $inst_stream = callInstagram($url);
    $results = json_decode($inst_stream, true);

    //Now parse through the $results array to display your results... 
    foreach($results['data'] as $item){
        $image_link = $item['images']['low_resolution']['url'];
        echo '<img src="'.$image_link.'" />';
    }

?>

