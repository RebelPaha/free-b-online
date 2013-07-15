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

if(isset($_POST["login"])&&isset($_POST["pass"]))
{
	$stmt = $mysqli->prepare("SELECT `id` FROM `adm_login` WHERE  `login`=? AND `pass`=? ");
	$stmt->bind_param('ss',$_POST[login],$_POST[pass]); 
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