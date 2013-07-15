<?php
require_once("../connect.php");

function insert_data($shop_id,$price,$card_num,$date,$time)
	{
	$mysqli = new mysqli($GLOBALS["server_name"], $GLOBALS["server_account"], $GLOBALS["server_password"], $GLOBALS["sql_base"]);
   if ($mysqli->connect_errno)
         {
         echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
         }
   if(!$mysqli->set_charset("utf8"))
	    	{  
	    	echo "не установлена<br />";  
	    	}
	
	$stmt = $mysqli->prepare("INSERT INTO card_stat(`shop_id`,`price`,`card_num`,`date`,`time`) VALUES (?, ?, ?, ?, ?)"); 
	$stmt->bind_param('ddsss', $shop_id, $price, $card_num, $date,$time); 
	$stmt->execute(); 
	}

if(isset($_POST['shop_id']))
{
$date = DateTime::createFromFormat('d/m/Y:H-i-s',$_POST["time"]);
insert_data($_POST["shop_id"],$_POST["price"],$_POST["card_num"],$date->format('Y-m-d'),$date->format('H:i:s'));
}
echo "none";
?>