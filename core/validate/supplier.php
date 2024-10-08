<?php
    include('core/init.php');

    if(isset($_POST['btnAddSupplier']) && !empty($_POST['btnAddSupplier'])){ # create new supplier account

        $fullname = strtolower($admin->validateInput($_POST['fullname']));
        $email = strtolower($admin->validateInput($_POST['email']));
        $phone = $admin->validateInput($_POST['phone']);
        $address = $admin->validateInput($_POST['address']);

        // Form Validation 
        if(empty($username) || empty($fullname) || empty($email) || empty($phone)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "All input fields are required";
            $_SESSION['messageIcon'] = "error";
        }elseif ($supplier->checkEmail($email) === true){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Email already taken";
            $_SESSION['messageIcon'] = "error";
        }elseif ($supplier->checkPhone($phone) === true){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Phone No. already in use";
            $_SESSION['messageIcon'] = "error";
        }else{

            if($supplier->addSupplier($fullname,$email,$phone,$address) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "Supplier account created successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to create supplier account";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }else if(isset($_POST['btnEditSupplier']) && !empty($_POST['btnEditSupplier'])){ # update supplier account

        $supplier_id = strtolower($admin->validateInput($_POST['supplier_id']));
        $fullname = strtolower($admin->validateInput($_POST['fullname']));
        $email = strtolower($admin->validateInput($_POST['email']));
        $phone = $admin->validateInput($_POST['phone']);
        $address = $admin->validateInput($_POST['address']);

        // Form Validation 
        if(empty($supplier_id)  || empty($fullname) || empty($email) || empty($address)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "All input fields are required";
            $_SESSION['messageIcon'] = "error";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Please use a valid email address";
            $_SESSION['messageIcon'] = "error";
        }elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only alphabet and numbers allowed";
            $_SESSION['messageIcon'] = "error";
        }else{

            if($supplier->editSupplier($supplier_id,$fullname,$email,$phone,$address) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "User account updated successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to update user account";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }else if(isset($_POST['btnDeleteSupplier']) && !empty($_POST['btnDeleteSupplier'])){ # delete supplier account

        $supplier_id = $admin->validateInput($_POST['supplier_id']);

        if($admin->delete('tblsupplier','supplier_id',$supplier_id) === true){
            $_SESSION['messageTitle'] = "Success";
            $_SESSION['messageText'] = "Supplier account removed successfully";
            $_SESSION['messageIcon'] = "success";
        }else{
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Failed to remove supplier account";
            $_SESSION['messageIcon'] = "error";
        }

    }elseif(isset($_POST['btnSettings']) && !empty($_POST['btnSettings'])){ # setting up store info

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $motto = $_POST['motto'];

        // Form Validation 
        if(empty($name) || empty($address) || empty($email) || empty($phone)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "All input fields are required";
            $_SESSION['messageIcon'] = "error";
        }else{

            $name = strtolower($admin->validateInput($name));
            $email = strtolower($admin->validateInput($email));
            $phone = $admin->validateInput($phone);
            $address = $admin->validateInput($address);
            $motto = $admin->validateInput($motto);

            if($supplier->setStoreInfo($name,$phone,$email,$address,$motto) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "Store details set successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to set store details";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }

?>