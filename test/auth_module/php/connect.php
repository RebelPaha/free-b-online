<?
   $server_mail = "";
	$to_mail = "";
	$redirect_to ="/a";
	$tmp_img_path = "/home/freebcom/public_html/test/auth_module/tmp";
		
	class db
		{
			var $server_name='localhost';
			var $server_account='eurostyl_site';
			var $server_password='tTrZozSD(&2,';
			var $sql_base='eurostyl_site';	
			public $mysqli;
			
			public function db($server_name,$server_account,$server_password,$sql_base)
				{
					$this->server_name = isset($server_name)?$this->server_name:$server_name;
					$this->server_account = isset($server_account)?$this->server_account:$server_account;
					$this->server_password = isset($server_password)?$this->server_password:$server_password;
					$this->sql_base = isset($sql_base)?$this->sql_base:$sql_base;
				}			
				
			public function connect() 
				{
				$this->mysqli = new mysqli($this->server_name, $this->server_account, $this->server_password,
													 $this->sql_base);
				if ($this->mysqli->connect_errno)
					{
   				return "Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
   				}
				if(!$this->mysqli->set_charset("utf8"))
					{  
					return "не установлена<br />";  
					}
				return "OK";
				}
			public function disconnect()
				{
				$this->mysqli->close();
				}
			
			
		}
	

?>