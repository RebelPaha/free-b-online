<?
/*
function x_mail( $from, $to, $subj, $text)
   {
 	$un        = strtoupper(uniqid(time()));
	$head      = "From: $from\n";
	$head     .= "To: $to\n";
	$head     .= "Subject: $subj\n";
	$head     .= "X-Mailer: PHPMail Tool\n";
	$head     .= "Reply-To: $from\n";
	
	     if (!@mail("$to", "$subj", $text, $head))
            return 0;
        else
            return 1;
	}
*/

function x_mail($from,$to, $subject, $body, $type='html', $enc='UTF-8'){  
      $eol = "\n";  
      $subject = mb_encode_mimeheader($subject);  
      $headers = 'From: '.mb_encode_mimeheader($from).' <'.$from.'>'.$eol;  
      $headers .= 'Reply-To: '.mb_encode_mimeheader($from).' <'.$from.'>'.$eol;  
      $headers .= 'Return-Path: '.mb_encode_mimeheader($from).' <'.$from.'>'.$eol;  
      $headers .= 'Message-ID: <'.time().'-'.$from.'>'.$eol;  
      $headers .= 'X-Mailer: PHP v'.phpversion().$eol;  
      $headers .= 'Content-Transfer-Encoding: BASE64'.$eol;  
      $headers .= 'Content-Type: text/'.$type.'; charset='.$enc.$eol;  
      $headers .= 'MIME-Version: 1.0'.$eol;  
      $msg = chunk_split( base64_encode($body) );  
      ini_set('sendmail_from',$from);  
      $mail_sent = mail($to, $subject, $msg, $headers, '-r '.$from);  
      ini_restore('sendmail_from');  
      return $mail_sent;  
 }

$text = "Здравствуйте
Меня зовут ".$_POST["name"]." и я бы хотел получить дисконтную карту
Cвязаться со мной можно по телефону: ".$_POST["phone"]."
Коментарий оставленный на сайте:

".$_POST["comment"];
x_mail("info@free-b.com.ua","info@free-b.com.ua","Заказ дисконтной карты",$text);
?>