<?php

    require('../core/init.php');
    require_once('../assets/dompdf/vendor/autoload.php');
    $getStoreData = $admin->fetch('tblsettings');
    $totalProduct = $admin->count('tblproduct');

    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

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
                <i>Inventory Report. Generated On ' . date('d M Y') . '</i>
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
                <h5>Current Store Inventory Report On ' . date('d M Y') . ' </h5>
            </div>
            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:20%">S/N</th>
                        <th style="width:50%">Item Code</th>
                        <th style="width:100%">Item Details</th>
                        <th style="width:50%">Current Stock</th>
                    </tr>
                </thead>
                <tbody>
                    ';
                    foreach ($admin->selectAllAsc('tblproduct','product_name') as $getProductStock){
                        $i = 1;
                        $html .=
                            '
                    <tr>
                        <td>' . $i++ . '</td>
                        <td>' . $getProductStock->product_code . '</td>
                        <td>' . ucwords($getProductStock->product_name)  . '</td>
                        <td>' . $getProductStock->quantity . '</td>
                    </tr>
                            ';
                    }
                    $html .= 
                    '<tr>
                        <td style="align: right;font-weight: bold;" colspan="3"> Total Stock</td>
                        <td>' . $product->sumProductQuantity() . '</td>
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
    $dompdf->stream('Inventory Report ' . date('d M Y') . '', array("Attachment" => 1));
    $options = $dompdf->getOptions();
    $options->setDefaultFont('');
    $dompdf->setOptions($options);

