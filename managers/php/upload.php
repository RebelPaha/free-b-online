<?php
require_once("connect.php");
$uploadfile = $GLOBALS['tmp_path']."/". $_FILES['ven_logo']['name'];

if (move_uploaded_file($_FILES['ven_logo']['tmp_name'], $uploadfile)) 
    {
    echo json_encode(array("upload" => true));
    } 
else 
    {
    echo json_encode(array("upload" => false));
    }
?>
