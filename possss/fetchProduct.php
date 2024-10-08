<?php

    require('../core/init.php');

    if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
        $user_id = $_SESSION['admin'];
        $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
    }else{
        header('location: ../login');
    }

    $output = "";
    if(!empty($_SESSION["cart_item"])):
        $item_total = 0;
        $i = 1;
        foreach ($_SESSION["cart_item"] as $item){
        $output .= '
        <tr>
            <td>
                <p>'. $i++ .'</p>
            </td>
            <td>
                <figure class="media">
                    <figcaption class="media-body">
                        <h6 class="title text-truncate">'.ucwords($item["product_name"]).'</h6>
                    </figcaption>
                </figure> 
            </td>
            <td class="text-center"> 
                <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                    <button type="button" class="m-btn btn btn-default" disabled>'.$item["quantity"].'</button>
                </div>
            </td>
            <td> 
                <div class="price-wrap"> 
                    <var class="price">'. $item["price"] * $item["quantity"].'</var> 
                </div> <!-- price-wrap .// -->
            </td>
            <td class="text-right"> 
                <a href="javascript:;" class="btn btn-outline-danger" onclick="removeFromCart('.$item["product_id"].')"> <i class="fa fa-trash"></i></a>
            </td>
            </tr>'.
                $item_total += ($item["price"]*$item["quantity"]);
                $_SESSION['total_price'] = $item_total; 
                }
                else:
                    unset($_SESSION["cart_item"]);
                
        $output .=  '<tr class="small">
                    <td class="font-weight-light text-center h5" colspan="5">Nothing in Cart</td>
                </tr>';

    endif;
    exit($output);

?>
