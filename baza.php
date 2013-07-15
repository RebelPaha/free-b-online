<?
	include('config.php');
 	
	$file = "userdata.csv"; // Некоторый файл
	$fh = fopen($file, "w+") or die("File ($file) does not exist!");
	
	$file2 = "userdata2.csv"; // Некоторый файл
	$fh2 = fopen($file2, "w+") or die("File ($file) does not exist!");
	
	$sql="SELECT phone, f_name, s_name, t_name FROM member";
	$res=mysql_query($sql,$db);
	while($row=mysql_fetch_row($res))
	{
		$data=$row[0].";".$row[3]." ".$row[1]." ".$row[2];
		$data = iconv( 'UTF-8','Windows-1251', $data);
		fwrite($fh, "+38".$data."\n");
		fwrite($fh2, "+38".$row[0]."\n");
		// $text = "$name\n$tema\n$email\n$mes\n";
	}	
	fclose($fh);
	fclose($fh2);
	
?>