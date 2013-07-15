<?php
class model_vendor extends model
{
    public function get_data()
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
	$result = $mysqli->query("SELECT `id`,`name` FROM `city`");
	while($row = $result->fetch_assoc())
	    {
	    $city[$row["id"]]=$row["name"];
	    }
	$result = $mysqli->query("SELECT `id`,`category_name` FROM `categories`");
	while($row = $result -> fetch_assoc())
	    {
	    $cat[$row["id"]] = $row["category_name"];
	    }
	$mysqli->close();
	return array($city,$cat);
	}

    public function set_data()
	{
	
	}
}
?>