<?php
class vk_request
{
	var $app_id;
	var $app_secret;
	var $req_uri;
	var $scope;
	var $access_token;

	function vk_request($app_id,$app_secret,$req_uri,$scope="friends,wall") 
		{
			$this->app_id = $app_id;
			$this->app_secret = $app_secret;
			$this->req_uri=$req_uri;
			$this->scope = $scope;
			//шаг 1. авторизация.
			//Если мы уже когда-то авторизировались, то пропускаем эту часть.
			// я для этого использую кукезы, т.е если мы когда то авторизировались в кукезах останется токен.
			// если нет, проходим авторизацию заново, и сохраняем токен в кукезах
			$url='https://oauth.vk.com/authorize?client_id='.$this->app_id.'&scope='
										.$this->scope.'&redirect_uri='.$this->req_uri.'&display=page&response_type=token';
			echo $url;	
					
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
			//curl_setopt($ch, CURLOPT_REFERER, "http://10.6.5.56/cgi-local/upload2pl.pl?bla&bla&bla");
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); // Отправить cookie
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_NOBODY, 0);
			$result = curl_exec($ch);
			echo '<pre>';
			print_r(curl_getinfo($ch));
			echo "\n\ncURL error number:" .curl_errno($ch);
			echo "\n\ncURL error:" . curl_error($ch);			
			echo '<br />';
			curl_close($ch);
			echo $result;
		}
	
	
	function api ($func,$params) 
		{
			$sig='';
			ksort($params);
			foreach ($params as $key => $val) 
			{
    			$sig.= "&".$key."=".$val;
			}
			$url = "https://api.vk.com/method/".$func."?".$sig."&access_token=".$this->access_token;
			echo $url."<hr>";
			return json_decode(file_get_contents($url),true);
		}
	
	
}

$app_id = "3613917";
$app_secret = "gK8YJalhHbMn9mq5ZTbL";
$req_uri = "https://oauth.vk.com/blank.html";

$vk_r = new vk_request($app_id,$app_secret,$req_uri);
//print_r($vk_r->api("wall.post",array("message"=>"test","owner_id"=>"-51987365")));
?>