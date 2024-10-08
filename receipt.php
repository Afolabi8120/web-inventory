<?php 
  
    $pageTitle = "Receipt";
    require('core/init.php');
    include('includes/head.php'); 
      
    if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
        $user_id = $_SESSION['admin'];
    $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
    }else{
        header('location: login');
    }

    $getStoreData = $admin->fetch('tblsettings');

    if(isset($_GET['receiptno']) AND !empty($_GET['receiptno'])){

        $receiptno = stripcslashes($_GET['receiptno']);

    }elseif(!isset($_GET['receiptno']) AND empty($_GET['receiptno'])){
        header('location: pos');
    }

?>
<div class="col-xl-3 col-xxl-3 mt-3">
    <div class="card card-bordered card-full border border-dark">
        <div class="nk-tb-list">
            <div class="nk-tb-item">
                <div class="card-body">
                    <div>
                        <style>
                            .heading {
                                letter-spacing: 1px;
                                text-align: center;
                            }
                            @media print {
                                .btn-print {
                                    display:none !important;
                                }
                            }
                        </style>
                        <h4 class="heading" style="font-size:10pt">
                            <span class="font-weight-bold h5"><?= ucwords($getStoreData->name); ?></span> <br>
                            <span class="font-weight-light">Tel: <?= $getStoreData->phone; ?></span><br>
                            <span class="font-weight-light"><?= $getStoreData->email; ?></span><br>          
                                Receipt No. <?= $receiptno; ?> <br>
                                Date: <?= date('d M Y g:ia'); ?>                                             
                            </strong> 
                        </h4>
                        </div>
                        <hr>
                        <table cellspacing="5" style="font-size:8.4pt">
                            <thead>
                                <tr>
                                    <th style="text-align:left;" width="2%">SL</th>
                                    <th width="100%" style="text-align:left;"><strong>ITEM DETAILS</strong></th>
                                    <th width="100%" style="text-align:right;"><strong>TOTAL</strong></th>
                                </tr>
                            </thead>
                            <?php $i = 1; foreach($admin->selectWhere('tblcart','invoiceno',$receiptno) as $getReceipt): ?>
                            <tr>
                                <td style="text-align:left;"><strong><?= $i++; ?></strong></td>
                                <td style="text-align:left; overflow-wrap: break-word">
                                    <strong>
                                        <?php

                                            $getProduct = $admin->fetchSingle('tblproduct','product_id',$getReceipt->product_id);
                                            echo ucwords($getProduct->product_name);

                                        ?>
                                    <br>
                                    <?= $getReceipt->quantity; ?> X <?= $getReceipt->price; ?>        
                                    </strong>
                                </td>
                                <td style="text-align:right;"><strong><?= $getReceipt->quantity * $getReceipt->price; ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="1"><strong>TOTAL:</strong></td>
                                <td style="text-align:right;" colspan="2">
                                    <strong>
                                        <?php
                                            $getTotal = $admin->fetchSingle('tblpayment','invoiceno',$receiptno);
                                            echo $getTotal->total;
                                        ?>
                                    </strong>
                                </td>
                            </tr>
                        </table>
                        <hr>
                        <p align="center">
                            <strong>
                                Items Sold By 
                                <?php
                                    
                                    $getSellerID = $admin->fetchSingle('tblcart','invoiceno',$receiptno);
                                    $getSellerData = $admin->fetchSingle('tbluser','user_id',$getSellerID->user_id);
                                            echo ucwords($getSellerData->username);
                                ?>
                            <strong></p>
                        <p align="center"><em>Powered By Code Tree Technologies.</em></p>
                        <hr>
                        <p align="center">
                            <strong>
                                Items Purchased are not Refundable
                            <strong>

                            <button type="submit" class="btn btn-dark btn-print" onclick="window.print();">Print</button>
                            <a href="pos" class="btn btn-danger btn-print">Back</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
      window.addEventListener(window.print());
    </script>
