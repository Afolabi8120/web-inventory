<?php

    require('core/init.php');

    if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
        $user_id = $_SESSION['admin'];
        $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);
    }else{
        header('location: login');
    }

    $output = "";
    
    if(isset($_SESSION["cart_item"])) 
    { 
        $subTotal = $_SESSION['total_price'];
    } 
    else
    { 
        $subTotal ='0.00'; 
    }

    $output .= '
        <tr>
            <td class="font-weight-bold">Sub Total</td>
            <td class="font-weight-bold">
                <input type="text" class="form-control h4" name="sub_total" placeholder="00.00" value="'.$subTotal.'" readonly>
            </td>
        </tr>
        <tr>
            <td class="font-weight-bold">Payment Method</td>
            <td class="font-weight-bold">
                <select name="status" class="form-control form-control-sm">
                <option value="cash">Cash</option>
                <option value="card">Card</option>
            </select>
            </td>
        </tr>
        <tr>
            <td class="font-weight-bold">Total</td>
            <td class="font-weight-bold">
                <input type="text" class="form-control h4" name="total" placeholder="00.00" value="'.$subTotal.'" readonly>
            </td>
        </tr>
        <tr>
            <td class="font-weight-bold" colspan="2">
                <input type="submit" class="btn btn-dark btn-block rounded" name="btnPlaceOrder" value="Place Order">
            </td>
        </tr>';

    exit($output);

?>
