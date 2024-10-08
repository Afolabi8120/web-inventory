<?php

    require('core/init.php');

    if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
        $user_id = $_SESSION['admin'];
        $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
    }else{
        header('location: login');
    }

    $output = "";
    if(!empty($_SESSION["cart_item"])):
        $item_total = 0;
        foreach ($_SESSION["cart_item"] as $item){
        $i = 1;
        $output .= '
            <tr class="small fetch_cart" >
                <td class="font-weight-bold">'.$i++.'</td>
                <td class="font-weight-bold">'.ucwords($item["product_name"]).'</td>
                <td class="font-weight-bold">
                        '.$item["quantity"]. ' x '. $item["price"].'
                </td>
                <td class="font-weight-bold">'
                        . $item["price"] * $item["quantity"].'
                </td>
                <td>
                        <a href="javascript:;" class="btn btn-sm btn-danger mb-2" title="Remove this Item" onclick="removeFromCart('.$item["product_id"].')"><i class="fas fa-trash"></i></a>
                </td>
            </tr>'.
                $item_total += ($item["price"]*$item["quantity"]);
                $_SESSION['total_price'] = $item_total; 
                }
                else:
                    unset($_SESSION["cart_item"]);
                
        $output .=  '<tr class="small">
                    <td class="font-weight-bold text-center h5" colspan="5">Nothing in Cart</td>
                </tr>';
        
        if(isset($_SESSION["cart_item"])) 
        { 
            $subTotal = $_SESSION['total_price'];
        } 
        else
        { 
            $subTotal ='0.00'; 
        }

    endif;
    exit($output);

?>
