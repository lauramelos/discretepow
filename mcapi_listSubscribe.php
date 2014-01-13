<?php
/**
This Example shows how to Subscribe a New Member to a List using the MCAPI.php 
class and do some basic error checking.
**/
require_once 'inc/MCAPI.class.php';
require_once 'inc/config.inc.php'; //contains apikey

$api = new MCAPI($apikey);

$merge_vars = array('FNAME'=>$_POST['FNAME'], 
                    'INSTA'=>$_POST['INSTA'], 
                    'SEVENP'=>$_POST['SEVENP'], 
                    'SUBSCRIBE'=>$_POST['SUBSCRIBE'], 
                    'AGREE'=>$_POST['AGREE'], 
                    );
$subscriberemailID = $_POST["EMAIL"];

// By default this sends a confirmation email - you will not see new members
// until the link contained in it is clicked!
$retval = $api->listSubscribe( $listId, $subscriberemailID, $merge_vars, 'html', false, true, true, true );

if ($api->errorCode){
//	echo "\tCode=".$api->errorCode."\n";
	echo "\tMsg=".$api->errorMessage."\n";
} else {
    echo 'true';
}

?>
