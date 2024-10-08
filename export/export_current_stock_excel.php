<?php
    require('../core/init.php');
    require_once('../assets/dompdf/vendor/autoload.php');

    /* Filter Excel Data */
    function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

    /* Excel File Name */
    $fileName = 'Inventory Report On ' . date('d M Y') . '.xls';

    /* Excel Column Name */
    $fields = array('Product Code', 'Item Details', 'Current Stock');

    /* Implode Excel Data */
    $excelData = implode("\t", array_values($fields)) . "\n";

    /* Fetch All Records From The Database */
    foreach ($admin->selectAll('tblproduct') as $getProductStock){
        $lineData = array($getProductStock->product_code, ucwords($getProductStock->product_name), $getProductStock->quantity);
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }

    /* Generate Header File Encodings For Download */
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$fileName\"");

    /* Render  Excel Data For Download */
    echo $excelData;

    exit;
