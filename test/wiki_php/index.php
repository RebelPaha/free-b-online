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

echo "<table>\n<tbody>\n";
$result = $mysqli->query("SELECT `name`,`adress`,`phones`,`url`,`discount` FROM `vender` WHERE `active`=1 AND `category`!=18 AND `id`>130 AND `id`<180");
while($row = $result->fetch_assoc())
	    {
	    echo "<tr><td><h3>".$row['name']."</h3></td></tr>\n";	
		 echo "<tr><td>Адресс:".$row['adress']."</td></tr>\n";		  
		 echo "<tr><td>Телефон:".$row['phone']."</td></tr>\n";		  
		 echo "<tr><td>Сайт:".$row['url']."</td></tr>";
		 echo "<tr><td>Скидка:".$row['discount']."</td></tr>\n"; 
		 echo "<tr><td><br><br></td></tr>";
		 }
echo "</tbody>\n</table>"
?>