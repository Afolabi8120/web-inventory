<?php 
    require('core/init.php');

    if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
        $user_id = $_SESSION['admin'];
        $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
    }else{
        header('location: login');
    }

    if(isset($_POST['product_id'])){
        # product id
        $product_id = $_POST['product_id'];

        # getting the product details using its id
        $productDetails = $admin->fetchSingle('tblproduct','product_id',$product_id);

        # product quantity set to 1
        $quantity = 1;

        if($productDetails->quantity <= 0){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = ucwords($productDetails->product_name) . " is out of stock";
            $_SESSION['messageIcon'] = "error";
            #echo "<script>alert('".ucwords($productDetails->product_name)."')'is out of stock</script>";
            return;
        }

        # pushing the product details into an array
        $itemArray = array($productDetails->product_id => array('product_name'=>$productDetails->product_name, 'product_id'=>$productDetails->product_id, 'quantity'=>$quantity, 'price'=>$productDetails->selling_price));

        if(!empty($_SESSION["cart_item"])) 
        {
            if(in_array($productDetails->product_id,array_keys($_SESSION["cart_item"]))) 
            {
                foreach($_SESSION["cart_item"] as $k => $v) 
                {
                    if($productDetails->product_id == $k) 
                    {
                        if(empty($_SESSION["cart_item"][$k]["quantity"])) 
                        {
                            $_SESSION["cart_item"][$k]["quantity"] = 0;
                        }
                        $_SESSION["cart_item"][$k]["quantity"] += $quantity;
                        $product->removeFromStock($productDetails->product_id,$quantity);
                    }
                }
            }
            else 
            {
                $product->removeFromStock($productDetails->product_id,$quantity);
                $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
            }
        } 
        else 
        {
            $_SESSION["cart_item"] = $itemArray;
            $product->removeFromStock($productDetails->product_id,$quantity);
        }
    }

    if(isset($_POST['r_product_id'])){
        # product id
        $productId = $_POST['r_product_id'];

        if(!empty($_SESSION["cart_item"]))
        {
            foreach($_SESSION["cart_item"] as $k => $v) 
            {
                if($productId == $v['product_id']){
                    unset($_SESSION["cart_item"][$k]);
                    $product->addToStock($productId,$v['quantity']);
                }
            }
        }
    }

    if(isset($_POST['paytype'])){

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
                if($order->addPayment($invoiceno,$total,$paytype,"1") === true){
                    $_SESSION['messageTitle'] = "Success";
                    $_SESSION['messageText'] = "Order placed successfully";
                    $_SESSION['messageIcon'] = "success";
                }else{
                    $_SESSION['messageTitle'] = "Alert";
                    $_SESSION['messageText'] = "Failed to add order payment";
                    $_SESSION['messageIcon'] = "error";
                }
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
    }
    
?>

