<?php
    require('../core/init.php');
    require_once('../assets/dompdf/vendor/autoload.php');

    $date_from = date('Y-m-d', strtotime($_GET['from']));
    $date_to = date('Y-m-d', strtotime($_GET['to']));

    /* Filter Excel Data */
    function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

    /* Excel File Name */
    $fileName = 'Sales Report From ' . $date_from . ' - To ' . $date_to . '.xls';

    /* Excel Column Name */
    $fields = array('Product Name', 'Quantity', 'Price', 'Sub Total', 'Payment Type', 'Payment Status', 'Sold By', 'Date Sold');

    /* Implode Excel Data */
    $excelData = implode("\t", array_values($fields)) . "\n";

    /* Fetch All Records From The Database */
    foreach ($order->getSalesSummary($date_from,$date_to) as $fetchSalesSummary){
        $lineData = array(ucwords($fetchSalesSummary->product_name), $fetchSalesSummary->quantity, number_format($fetchSalesSummary->price, 00), number_format($fetchSalesSummary->quantity * $fetchSalesSummary->price, 00), ucwords($fetchSalesSummary->paytype), $order->printPaymentStatus($fetchSalesSummary->invoiceno), $order->printSellerUsername($fetchSalesSummary->invoiceno), $fetchSalesSummary->date_paid);
        array_walk($lineData, 'filterData');
        $lineData2 = array("", "", "", $order->getSalesSummaryTotal($date_from,$date_to), "", "", "", "");
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
    $excelData .= implode("\t", array_values($lineData2)) . "\n";

    /* Generate Header File Encodings For Download */
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$fileName\"");

    /* Render  Excel Data For Download */
    echo $excelData;

    exit;
