<?php

class model_mail extends model
{
    public function set_data()
        {
	//part 1: sending email
	$head = '<html>
	    <head>
	    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	    <meta http-equiv="Content-Language" content="ru">';

	$head .= '</head><body>';
        $text = $head."Менеджер ".$_SESSION['login']." оставил заявку на добавление вендора<br>"."Название: ".
	$_POST["ven_name"]."<br> Категория: ".$_POST["ven_cat"]."<br>Адрес: ".$_POST["ven_addr"]."<br>Телефон: ".
	$_POST["ven_phone"]."<br>URL: ".$_POST["ven_url"]."<br>Скидка: ".$_POST["ven_gift"]."%<br>Город: ".
	$_POST["ven_city"]."<br>Содержимое: <br>".$_POST["content"];
	$text .= '</body>';
	$text .= '</html>';
	$subject_mail = "Добавление вендора ".$_POST["ven_name"]." на сайт";
        $ret = $this->x_mail($GLOBALS['server_mail'],$GLOBALS['to_mail'],$subject_mail,$text,$GLOBALS['tmp_path']."/"
			.$_POST["ven_logo"]) ? "<h1> Отправлено </h1>": "Проблема";
	//$ret.="</body></html>";
	
	//part 2: change logos
	//part 3: delete orig. logo
	//unlink($GLOBALS['tmp_path']."/".$_POST["ven_logo"]);
	return $ret;
	}

    public function x_mail( $from, $to, $subj, $text, $filename)
        {
        $f         = fopen($filename,"rb");
	$un        = strtoupper(uniqid(time()));
	$head      = "From: $from\n";
	$head     .= "To: $to\n";
	$head     .= "Subject: $subj\n";
	$head     .= "X-Mailer: PHPMail Tool\n";
	$head     .= "Reply-To: $from\n";
	$head     .= "Mime-Version: 1.0\n";
	$head     .= "Content-Type:multipart/mixed;";
	$head     .= "boundary=\"----------".$un."\"\n\n";
	$zag       = "------------".$un."\nContent-Type:text/html;\n";
	$zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
	$zag      .= "------------".$un."\n";
	$zag      .= "Content-Type: application/octet-stream;";
	$zag      .= "name=\"".basename($filename)."\"\n";
	$zag      .= "Content-Transfer-Encoding:base64\n";
	$zag      .= "Content-Disposition:attachment;";
	$zag      .= "filename=\"".basename($filename)."\"\n\n";
	$zag      .= chunk_split(base64_encode(fread($f,filesize($filename))))."\n";
        if (!@mail("$to", "$subj", $zag, $head))
            return 0;
        else
            return 1;
	}
}
?>
