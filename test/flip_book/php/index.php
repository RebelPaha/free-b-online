<?php
require_once("connect.php");

if(isset($_POST["id"]))
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
	$result = $mysqli->query("SELECT `name`,`adress`,`phones`,`url`,`logo`,`description` FROM `vender` WHERE `id`=".$_POST["id"]);
	while($row = $result->fetch_assoc())
	    {
	    	//print_r($row);
	      echo json_encode($row);
	    }
}
?>