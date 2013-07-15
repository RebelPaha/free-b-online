<?php
include('config.php');
function export_csv(
        $table, 		// Имя таблицы для экспорта
        $afields, 		// Массив строк - имен полей таблицы
        $filename, 	 	// Имя CSV файла для сохранения информации
                    // (путь от корня web-сервера)
        $delim=';', 		// Разделитель полей в CSV файле
        $enclosed='"', 	 	// Кавычки для содержимого полей
        $escaped='\\\\', 	 	// Ставится перед специальными символами
        $lineend='\\\\r\\\\n'){  	// Чем заканчивать строку в файле CSV

    $q_export = 
    "SELECT ".$afields.
    "   INTO OUTFILE '".$_SERVER['DOCUMENT_ROOT'].'/'.$filename."' ".
    "FIELDS TERMINATED BY '".$delim."' FROM ".$table
    ;

        // Если файл существует, при экспорте будет выдана ошибка
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$filename)) 
            unlink($_SERVER['DOCUMENT_ROOT'].'/'.$filename); 
        return mysql_query($q_export) or die(mysql_error());
    }
	if(export_csv('member','phone','telephone.csv')) echo 'Все выполнилось';
	else echo 'Неудача';
?>