<?php
require_once("connect.php");

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

$txt_file    = file_get_contents('http://free-b.com.ua/scanner/test.txt');
$rows        = explode("\n", $txt_file);
array_shift($rows);

foreach($rows as $row => $data)
{
    //get row data
    $row_data = explode(':', $data);

    $info[$row]['date']           = $row_data[0];
    $info[$row]['time']         = $row_data[1];
    $info[$row]['card_num']  = $row_data[2];
    $info[$row]['price']       = $row_data[3];
    $info[$row]['shop_id'] = $row_data[4];
 
    $date = DateTime::createFromFormat('d/m/Y',$info[$row]['date']);
	 $time = DateTime::createFromFormat('H-i-s',$info[$row]['time']);	
    insert_data($info[$row]['shop_id'],$info[$row]['price'],$info[$row]['card_num'],$date->format('Y-m-d'),$time->format('H:i:s'));
}

?>