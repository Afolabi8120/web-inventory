<?php

    require('../core/init.php');
    require_once('../assets/dompdf/vendor/autoload.php');
    $getStoreData = $admin->fetch('tblsettings');

    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

    $date_from = date('Y-m-d', strtotime($_GET['from']));
    $date_to = date('Y-m-d', strtotime($_GET['to']));

    $html = '
    <!DOCTYPE html>
    <html>

        <head>
            <meta name="" content="XYZ,0,0,1" />
            <style type="text/css">
                table {
                    border: 1px solid black;
                    font-size: 12px;
                    padding: 4px;
                }

                tr {
                    border: 1px solid black;
                }

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
        </head>

        <body style="margin:1px;">
            <div class="footer">
                <hr>
                <i>Sales Report. Generated On ' . date('d M Y') . '</i>
            </div>
            <div class="list_header" align="center">
                <h3>
                    ' . ucwords($getStoreData->name) . '
                </h3>
                <h4>
                    ' . strtolower($getStoreData->email) . '<br>
                    ' . $getStoreData->phone . ' 
                </h4>
                <hr style="width:100%" , color=black>
                <h5>Sales Report From ' . $date_from . ' - To ' . $date_to . '</h5>
            </div>
            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:100%">Product Name</th>
                        <th style="width:20%">Qty</th>
                        <th style="width:30%">Price</th>
                        <th style="width:40%">Sub Total</th>
                        <th style="width:20%">Payment Type</th>
                        <th style="width:20%">Payment Status</th>
                        <th style="width:40%">Sold By</th>
                        <th style="width:50%">Date Sold</th>
                    </tr>
                </thead>
                <tbody>
                    ';
                    foreach ($order->getSalesSummary($date_from,$date_to) as $fetchSalesSummary){
                        $html .=
                            '
                    }
                    <tr>
                        <td>' . ucwords($fetchSalesSummary->product_name) . '</td>
                        <td>' . $fetchSalesSummary->quantity . '</td>
                        <td>' . number_format($fetchSalesSummary->price, 00)  . '</td>
                        <td>' . number_format($fetchSalesSummary->quantity * $fetchSalesSummary->price, 00) . '</td>
                        <td>' . ucwords($fetchSalesSummary->paytype) . '</td>
                        <td>' . $order->printPaymentStatus($fetchSalesSummary->invoiceno) . '</td>
                        <td>' . $order->printSellerUsername($fetchSalesSummary->invoiceno)  . '</td>
                        <td>' . $fetchSalesSummary->date_paid . '</td>
                    </tr>';
                    }
                    $html .= 
                    '<tr>
                        <td style="align: right;font-weight: bold;" colspan="3"> Total Amount</td>
                        <td>' . $order->getSalesSummaryTotal($date_from,$date_to) . '</td>
                        <td colspan="4"></td>
                    </tr>';
                    $html .= '
                </tbody>
            </table>
        </body>
    </html>
    ';
    $dompdf = new Dompdf();
    $dompdf->load_html($html);
    $dompdf->set_paper('A4');
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->render();
    $dompdf->stream('Sales Report ' . date('d M Y') . '', array("Attachment" => 1));
    $options = $dompdf->getOptions();
    $options->setDefaultFont('');
    $dompdf->setOptions($options);

