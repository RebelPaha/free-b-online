<?php
file_put_contents("test.txt", $_POST["time"].":".$_POST["card_num"].
	":".$_POST["price"].":".$_POST["shop_id"]."\n", FILE_APPEND);

echo "none";
?>