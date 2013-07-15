<?php
include('../config.php');
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $sql="SELECT `email` FROM member WHERE email='".$email."'";
    $query = mysql_query($sql, $db);
    $mysql = mysql_num_rows($query);
	if($mysql == 1){
		echo "no";
	}else{
		echo "yes";
	}
}
if(isset($_POST['phone'])){
    $phone = $_POST['phone'];
    $sql="SELECT `phone` FROM member WHERE phone='".$phone."'";
    $query = mysql_query($sql, $db);
    $mysql = mysql_num_rows($query);
	if($mysql == 1){
		echo "no";
	}else{
		echo "yes";
	}
}
if(isset($_POST['card'])){
    $card = str_pad($_POST['card'], 9, 0, STR_PAD_LEFT);
    $sql="SELECT `number_card` FROM member WHERE number_card='".$card."'";
    $query = mysql_query($sql, $db);
    $mysql = mysql_num_rows($query);
	if($mysql == 1){
		echo "no";
	}else{
		echo "yes";
	}
}
if(isset($_POST['refcard'])){
    $refcard = str_pad($_POST['refcard'], 9, 0, STR_PAD_LEFT);
    $sql="SELECT `number_card` FROM member WHERE number_card='".$refcard."'";
    $query = mysql_query($sql, $db);
    $mysql = mysql_num_rows($query);
	if($mysql == 1){
		echo "no";
	}else{
		echo "yes";
	}
}
?>
