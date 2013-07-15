<?php
require_once("connect.php");

$mysqli = new mysqli($GLOBALS["server_name"], $GLOBALS["server_account"], $GLOBALS["server_password"], $GLOBALS["sql_base"]);
if ($mysqli->connect_errno)
	{
   echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
   }
if(!$mysqli->set_charset("utf8"))
	{  
	echo "не установлена<br />";  
	}

if(<-LOGIN_POST_ISSET->)
{
	$stmt = $mysqli->prepare("SELECT `id` FROM `adm_login` WHERE <-LOGIN_SQL_PARAMS->");
	$stmt->bind_param(<-LOGIN_BIND_PARAMS->); 
	$stmt->bind_result($id);
	$stmt->execute(); 
 	 if($stmt->fetch())
  		{
       session_start();
       $_SESSION["id"]=$id;
       echo(json_encode(array("url"=>$GLOBALS["redirect_to"])));	
    	}
    else 
     	{
   	 echo(json_encode(array("url"=>"error")));
     	}
    $stmt->close(); 
}

$mysqli->close();

?>