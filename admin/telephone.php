<?php
include('config.php');
function export_csv(
        $table, 		// ��� ������� ��� ��������
        $afields, 		// ������ ����� - ���� ����� �������
        $filename, 	 	// ��� CSV ����� ��� ���������� ����������
                    // (���� �� ����� web-�������)
        $delim=';', 		// ����������� ����� � CSV �����
        $enclosed='"', 	 	// ������� ��� ����������� �����
        $escaped='\\\\', 	 	// �������� ����� ������������ ���������
        $lineend='\\\\r\\\\n'){  	// ��� ����������� ������ � ����� CSV

    $q_export = 
    "SELECT ".$afields.
    "   INTO OUTFILE '".$_SERVER['DOCUMENT_ROOT'].'/'.$filename."' ".
    "FIELDS TERMINATED BY '".$delim."' FROM ".$table
    ;

        // ���� ���� ����������, ��� �������� ����� ������ ������
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$filename)) 
            unlink($_SERVER['DOCUMENT_ROOT'].'/'.$filename); 
        return mysql_query($q_export) or die(mysql_error());
    }
	if(export_csv('member','phone','telephone.csv')) echo '��� �����������';
	else echo '�������';
?>