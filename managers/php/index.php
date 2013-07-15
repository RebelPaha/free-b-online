<?php

require_once("core/view.php");
require_once("core/cs.php");
require_once("core/model.php");
require_once("connect.php");

session_start();

if((isset($_POST["login"])) and (isset($_POST["pass"])))
    {
	require_once("models/model_login.php");
        require_once("cs/cs_login.php");
        $cs_login = new cs_login();
	$cs_login->action($_POST["login"],$_POST["pass"]);
    }

if(isset($_POST["get_ven_data"]))
	{
	require_once ("models/model_vendor.php");
	require_once ("cs/cs_vendor.php");
	$cs_ven = new cs_vendor();
	$cs_ven -> action();
    	}

if((isset($_POST["ven_name"]))&&(isset($_POST["ven_gift"])))
    {
	require_once("models/model_mail.php");
	require_once("cs/cs_mail.php");
	$cs_mail = new cs_mail();
	$cs_mail -> action();
    }

?>