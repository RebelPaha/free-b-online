<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=cp1251" />
<title>Untitled Document</title>
</head>

<body>
<?
include('../config.php');
$sql="TRUNCATE TABLE  member_history";
mysql_query($sql,$db) or die($sql);
$sql="TRUNCATE TABLE  member_mail";
mysql_query($sql,$db) or die($sql);
$sql="TRUNCATE TABLE  stat_vender";
mysql_query($sql,$db) or die($sql);
$sql="TRUNCATE TABLE  member_backcash";
mysql_query($sql,$db) or die($sql);
$sql="UPDATE member SET  `balls` =0,
`change_balls` =0,
`saved_money` =0,
`all_balls` =  '0',
`all_product` =  '0',
`balance` =  '0',
`all_money` =  '0'";
mysql_query($sql,$db) or die($sql);
echo 'Well done!';


?>
</body>
</html>