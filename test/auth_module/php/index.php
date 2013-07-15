<?php
require_once("connect.php");
require_once("hzip.php");

session_start();


$tmp_path = "../tmp/".session_id();
	if(!file_exists($tmp_path))
		{
		mkdir($tmp_path);
		}

	if(!file_exists($tmp_path."/img"))
		{
		mkdir($tmp_path."/img");
		}

	if(!file_exists($tmp_path."/php"))
		{
		mkdir($tmp_path."/php");
		}

	if(!file_exists($tmp_path."/js"))
		{
		mkdir($tmp_path."/js");
		}

	if(!file_exists($tmp_path."/css"))
		{
		mkdir($tmp_path."/css");
		}

if(isset($_FILES["logo"])) 
{
$uploadfile = $GLOBALS['tmp_img_path']."/".session_id()."/img/key.jpg";

if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) 
    {
    	if(getimagesize($uploadfile)) 
    		{
    		echo json_encode(array("upload" => true));
    		}
    	else 
    		{
    		unlink($uploadfile);
    		echo json_encode(array("upload" => false)); 
    		}
    } 
else 
    {
    echo json_encode(array("upload" => false));
    }
}


//part 1 creating replacing text;
$param_cnt = 0;
	foreach($_POST as $key => $val)
	{
		$param_cnt++;
		if (preg_match("/auth_table_name?/i",$key)) 
			{
				$login_params_isset.= 'isset($_POST["'.$val.'"])&&' ;
				$login_params_sql .= ' `'.$val.'`=? AND';
				$login_params_bind_type.='s';
				$login_params_bind_post.='$_POST['.$val.'],';
				//there starts bydlo code
				$login_index_form.= "<tr>
					<td>
						<label>".$_POST["auth_full_name".substr($key,-1)]."</label>
					</td>
					<td>
						<input name=\"".$val."\" type=\"text\" required>
					</td>
					<td></td>
				</tr>";
				//
			}  
		
		if (preg_match("/reg_table_name?/i",$key)) 
			{
			$reg_table_params.= "`".$val."` varchar(64) NOT NULL,\n";
			}
   	if (preg_match("/reg_full_name?/i",$key)) 
			{
			//there might be generating html code for registration form;
			}
	}

if($param_cnt>1) 
{
	$login_params_bind = substr("'".$login_params_bind_type."',".$login_params_bind_post,0,-1);
	$login_params_isset=substr($login_params_isset,0,-2);
	$login_params_sql = substr($login_params_sql,0,-3);
// part 2 creating folder structure;

	


// part 3 writing replaced text to files
//3.1 creating sql dump-file
	$sql_dump = file_get_contents("../base/adm_login.sql");
	file_put_contents($tmp_path."/adm_login.sql",preg_replace("/<-PARAMS->/", $reg_table_params, $sql_dump));

/*3.2 php/index.php
* TODO: add registration and pass_restore code to index.php template*/

	$index_php_dump = file_get_contents("../base/php/index.php");
	$index_php_dump = preg_replace("/<-LOGIN_POST_ISSET->/", $login_params_isset, $index_php_dump);
	$index_php_dump = preg_replace("/<-LOGIN_SQL_PARAMS->/", $login_params_sql, $index_php_dump);
	$index_php_dump = preg_replace("/<-LOGIN_BIND_PARAMS->/", $login_params_bind, $index_php_dump);
	file_put_contents($tmp_path."/php/index.php",$index_php_dump);


//3.3 js/main.js
	if (!copy("../base/js/main.js", $tmp_path."/js/main.js")) 
		{
   	 echo "{\"error: \" \"main.js copy\"}";
		}	
//3.4 css/main.css
	$main_css_dump = file_get_contents("../base/css/main.css");
	file_put_contents($tmp_path."/css/main.css",preg_replace("/<-CSS_BG_COLOR->/", isset($_POST["color"])?$_POST["color"]:"#808080", $main_css_dump));

//3.5 index.html
	$index_html_dump = file_get_contents("../base/index.html");
	file_put_contents($tmp_path."/index.html",preg_replace("/<-INDEX_LOGIN_FORM->/", $login_index_form, $index_html_dump));

//3.6 connect.php
	if (!copy("../base/php/connect.php", $tmp_path."/php/connect.php")) 
		{
   	 echo "{\"error: \" \"connect.php copy\"}";
		}
//zip it
	HZip::zipDir($tmp_path, $tmp_path.'/auth.zip'); 

	echo "{\"archive\":\"tmp/".session_id()."/auth.zip\",\"test_url\":\"tmp/".session_id()."\"}";
}
?>