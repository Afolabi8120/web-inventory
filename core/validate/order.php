<?php
    include('core/init.php');

    if(isset($_POST['btnPlaceOrder']) && !empty($_POST['btnPlaceOrder'])){

        $user_id = $_SESSION['admin'];
        $item_total = 0;
        
        $paytype = $_POST['paytype'];
        $subtotal = $_POST['subtotal'];
        $total = $_POST['total'];

        if(empty($paytype) || empty($subtotal) || empty($total) || $subtotal == "0.00" || $total == "0.00"){
            return;
        }

        $invoiceno = $order->generateTransactionID();

        foreach ($_SESSION["cart_item"] as $item)
        {
            $item_total += ($item["price"]*$item["quantity"]);
            if($order->addToCart($invoiceno,$user_id,$item["product_id"],$item["quantity"],$item["price"]) === true){
                
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to add items to cart";
                $_SESSION['messageIcon'] = "error";
            }

            unset($_SESSION["cart_item"]);
            unset($_SESSION["total_price"]);
            unset($item["product_id"]);
            unset($item["quantity"]);
            unset($item["price"]);
        }

        if($order->addPayment($invoiceno,$total,$paytype,"1") === true){
            $_SESSION['messageTitle'] = "Success";
            $_SESSION['messageText'] = "Order placed successfully";
            $_SESSION['messageIcon'] = "success";
            header("refresh:1;url=pos");
        }else{
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Failed to add order payment";
            $_SESSION['messageIcon'] = "error";
        }

    }

?>