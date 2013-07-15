<?php
require_once("connect.php");

if(isset($_POST['get_card_ven_data']))
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
	$result = $mysqli->query("SELECT `id`,`shop_name` FROM `shop_id`");
	while($row = $result->fetch_assoc())
	    {
	    $arr[$row["id"]]=$row["shop_name"];
	    }

	echo json_encode($arr);
	}

if(isset($_POST['get_card_stat_data']))
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
	//!warning sql injection
	$cnt_date = 0;
	$result = $mysqli->query("SELECT DISTINCT `date` FROM `card_stat` WHERE `shop_id` = '".$_POST['get_card_stat_data']."'");
	while($row = $result->fetch_assoc())
	    {
	    	$cnt_sec =0;
    		$arr[$cnt_date]= array("date"=>$row["date"]);
	    	$sec_res = $mysqli->query("SELECT time,card_num,price FROM `card_stat` WHERE `shop_id` = '".$_POST['get_card_stat_data']."' AND `date` ='".$row['date']."'");
			while($sec_row = $sec_res->fetch_assoc())
				{
				$arr[$cnt_date]=array_merge($arr[$cnt_date], array($cnt_sec => array('time'=>$sec_row['time'],
	    																	'card'=>$sec_row['card_num'],
	    																	'price'=>(int)$sec_row['price'] )));
	    		$cnt_sec++;
	    		}
	    $cnt_date++;
	    }
		echo json_encode($arr);
 	}
?>

