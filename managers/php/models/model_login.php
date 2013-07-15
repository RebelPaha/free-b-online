<?php
class model_login extends model
{
    public $login;
    public $pass;
    function get_data()
	{
	
	$mysqli = new mysqli($GLOBALS["server_name"], $GLOBALS["server_account"], $GLOBALS["server_password"], $GLOBALS["sql_base"]);
	if ($mysqli->connect_errno) 
	    {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	    }
	$result = $mysqli->query("SELECT password FROM adminka WHERE login = '".$mysqli->real_escape_string($this->login)."'");
	$row = $result->fetch_assoc();
	if(isset($row))
	    {
		if(md5($this->pass)==$row["password"])
		    {
			$mysqli->close();
			$_SESSION['login'] = $this->login;
			return array('login'=>true);
		    }
	    }
	    $mysqli->close();
	    return array('login'=>false);
	}

    function set_data($login,$pass)
	{
	    $this->login = $login;
	    $this->pass = $pass;
	}
}

?>