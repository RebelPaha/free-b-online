<?
	include('config.php');
 	
	$file = "phone.csv"; // Некоторый файл
	$fh = fopen($file, "w+") or die("File ($file) does not exist!");
	
	$sql="SELECT phone FROM member";
	$res=mysql_query($sql,$db);
	while($row=mysql_fetch_row($res))
	{
		$data=$row[0].";";
		$data = iconv( 'UTF-8','Windows-1251', $data);
		fwrite($fh, $data."\n");
	}	
	fclose($fh);
	echo 'Все';
?>