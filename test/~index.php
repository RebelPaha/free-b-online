<?
require 'vkapi.class.php';

$api_id = 3612765; // Insert here id of your application
$secret_key = 'f1xmUMNS3hTg4TirFlVZ'; // Insert here secret key of your application

$VK = new vkapi($api_id, $secret_key);

//$resp = $VK->api('wall.post', array('owner_id'=>'-51987365','message'=>'test'));

$resp = $VK->api('getUserSettings', array('uid'=>'208690150'));

print_r($resp);
?>
