<?php

    include('core/init.php');

    if(isset($_POST['btnAddProduct']) && !empty($_POST['btnAddProduct'])){
        
        $product_code = $_POST['product_code'];
        $product_name = $_POST['product_name'];
        $barcode = $_POST['barcode'];
        $supplier_id = $_POST['supplier_id'];
        $category_id = $_POST['category_id'];
        $buying_price = $_POST['buying_price'];
        $selling_price = $_POST['selling_price'];
        $quantity = $_POST['quantity'];
        $unit = $_POST['unit'];
        $reorder_level = $_POST['reorder_level'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $manufacture_date = $_POST['manufacture_date'];
        $expiry_date = $_POST['expiry_date'];

        // counting the numbers of images selected
        $product_image = $_FILES['product_image']['name'];

        // Form Validation 
        if(empty($product_code) || empty($product_name) || empty($barcode) || empty($unit) || empty($supplier_id) || empty($category_id) || empty($buying_price) || empty($selling_price) || empty($quantity) || empty($reorder_level) || $status == "" || empty($manufacture_date) || empty($expiry_date)){
            $_SESSION['messageTitle'] = "Empty Fields";
            $_SESSION['messageText'] = "All Input Field are Required";
            $_SESSION['messageIcon'] = "error";
        }elseif(!preg_match("/^[a-zA-Z 0-9]*$/", $product_name)){
        	$_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Please use a valid product name";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif($product->checkProductCode($product_code)){
        	$_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Product code already in use";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif($product->checkProductName($product_name)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Product name already in use";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif($product->checkProductBarcode($barcode)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Barcode already exist";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[0-9]*$/", $buying_price)){
        	$_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only numbers allowed for the buying price field";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[0-9]*$/", $selling_price)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only numbers allowed for the selling price field";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[0-9]*$/", $quantity)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only numbers allowed for the quantity field";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[a-zA-Z0-9]*$/", $barcode)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Please use a valid product barcode";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[0-9]*$/", $reorder_level)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only numbers allowed for reorder level field";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(empty($_FILES['product_image']['name'])){
        	$_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Please select at a product image";
            $_SESSION['messageIcon'] = "error";
            return;
        }else{

        	$product_image = $_FILES['product_image']['name'];

            $product_code = $admin->validateInput($product_code);
            $product_name = strtolower($admin->validateInput($product_name));
            $barcode = $admin->validateInput($barcode);
            $supplier_id = $admin->validateInput($supplier_id);
            $category_id = $admin->validateInput($category_id);
            $buying_price = $admin->validateInput($buying_price);
            $selling_price = $admin->validateInput($selling_price);
            $quantity = $admin->validateInput($quantity);
            $unit = $admin->validateInput($unit);
            $reorder_level = $admin->validateInput($reorder_level);
            $description = $admin->validateInput($description);
            $status = $admin->validateInput($status);
            $manufacture_date = $admin->validateInput($manufacture_date);
            $expiry_date = $admin->validateInput($expiry_date);

	        //specifying the supported file extension
	        $validextensions = ['jpg', 'png', 'jpeg'];
	        $ext = explode('.', basename($_FILES['product_image']['name']));

	        //explode file name from dot(.)
	        $file_extension = end($ext);

	        $getImageID = uniqid().time(); #generate a unique id
	        $hashImageID = sha1($getImageID); #encrypt the unique id
	        $useImageID = "PRO".date('Ymdi').substr($hashImageID, 2, 6); #split the unique id
	        $useImageID = strtoupper($useImageID);

	        $product_image = $useImageID.".".$file_extension;
	        $target = 'assets/product_image/' . $product_image;

	        if($product->addProduct($product_code,$product_name,$barcode,$supplier_id,$category_id,$buying_price,$selling_price,$quantity,$unit,$product_image,$reorder_level,$status,$description,$manufacture_date,$expiry_date) === true){
	        	move_uploaded_file($_FILES['product_image']['tmp_name'],  $target);
	        	$_SESSION['messageTitle'] = "Success";
            	$_SESSION['messageText'] = "Product added successfully";
            	$_SESSION['messageIcon'] = "success";
                header("refresh:2;url=view-product"); 

	   	    }else{
	   	    	$_SESSION['messageTitle'] = "Alert";
            	$_SESSION['messageText'] = "Failed to add product";
            	$_SESSION['messageIcon'] = "error";
	   	    }
	        
	    }

    }
    elseif(isset($_POST['btnEditProduct']) && !empty($_POST['btnEditProduct'])){
        
        $product_id = $admin->validateInput($_POST['product_id']);
        $product_name = strtolower($admin->validateInput($_POST['product_name']));
        $barcode = $admin->validateInput($_POST['barcode']);
        $supplier_id = $admin->validateInput($_POST['supplier_id']);
        $category_id = $admin->validateInput($_POST['category_id']);
        $buying_price = $admin->validateInput($_POST['buying_price']);
        $selling_price = $admin->validateInput($_POST['selling_price']);
        $quantity = $admin->validateInput($_POST['quantity']);
        $unit = $admin->validateInput($_POST['unit']);
        $reorder_level = $admin->validateInput($_POST['reorder_level']);
        $description = $admin->validateInput($_POST['description']);
        $status = $admin->validateInput($_POST['status']);
        $manufacture_date = $admin->validateInput($_POST['manufacture_date']);
        $expiry_date = $admin->validateInput($_POST['expiry_date']);

        // getting the product image name
        $product_image = $_FILES['product_image']['name'];

        # getting product details
        $fetchProductData = $admin->fetchSingle('tblproduct','product_id',$product_id);

        // Form Validation 
        if(empty($product_name) || empty($barcode) || empty($unit) || empty($supplier_id) || empty($category_id) || empty($buying_price) || empty($selling_price) || empty($quantity) || empty($reorder_level) || $status == "" || empty($manufacture_date) || empty($expiry_date)){
            $_SESSION['messageTitle'] = "Empty Fields";
            $_SESSION['messageText'] = "All Input Field are Required";
            $_SESSION['messageIcon'] = "error";
        }elseif(!preg_match("/^[a-zA-Z 0-9]*$/", $product_name)){
        	$_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Please use a valid product name";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[0-9.]*$/", $buying_price)){
        	$_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only numbers allowed for the buying price field";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[0-9.]*$/", $selling_price)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only numbers allowed for the selling price field";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[0-9]*$/", $quantity)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only numbers allowed for the quantity field";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[a-zA-Z0-9]*$/", $barcode)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Please use a valid product barcode";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[0-9]*$/", $reorder_level)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only numbers allowed for reorder level field";
            $_SESSION['messageIcon'] = "error";
            return;
        }else{

            if(empty($_FILES['product_image']['name'])){

                $product_image = $fetchProductData->product_image;

                if($product->editProduct($product_id,$product_name,$barcode,$supplier_id,$category_id,$buying_price,$selling_price,$quantity,$unit,$product_image,$reorder_level,$status,$description,$manufacture_date,$expiry_date) === true){
                    $_SESSION['messageTitle'] = "Success";
                    $_SESSION['messageText'] = "Product updated successfully";
                    $_SESSION['messageIcon'] = "success";
                }else{
                    $_SESSION['messageTitle'] = "Alert";
                    $_SESSION['messageText'] = "Failed to update product";
                    $_SESSION['messageIcon'] = "error";
                }

            }else{

            	$product_image = $_FILES['product_image']['name'];

    	        //specifying the supported file extension
    	        $validextensions = ['jpg', 'png', 'jpeg'];
    	        $ext = explode('.', basename($_FILES['product_image']['name']));

    	        //explode file name from dot(.)
    	        $file_extension = end($ext);

    	        $getImageID = uniqid().time(); #generate a unique id
    	        $hashImageID = sha1($getImageID); #encrypt the unique id
    	        $useImageID = "PRO".date('Ymdi').substr($hashImageID, 2, 6); #split the unique id
    	        $useImageID = strtoupper($useImageID);

    	        $product_image = $useImageID.".".$file_extension;
    	        $target = 'assets/product_image/' . $product_image;

    	        if($product->editProduct($product_id,$product_name,$barcode,$supplier_id,$category_id,$buying_price,$selling_price,$quantity,$unit,$product_image,$reorder_level,$status,$description,$manufacture_date,$expiry_date) === true){
                    move_uploaded_file($_FILES['product_image']['tmp_name'],  $target);
                    $_SESSION['messageTitle'] = "Success";
                    $_SESSION['messageText'] = "Product updated successfully";
                    $_SESSION['messageIcon'] = "success";
                }else{
                    $_SESSION['messageTitle'] = "Alert";
                    $_SESSION['messageText'] = "Failed to update product";
                    $_SESSION['messageIcon'] = "error";
                }
            }
	        
	    }

    }elseif(isset($_POST['btnEditStock']) && !empty($_POST['btnEditStock'])){ #edit stock
        
        $product_id = $admin->validateInput($_POST['product_id']);
        $quantity = $admin->validateInput($_POST['quantity']);
        $action = $admin->validateInput($_POST['action']);
        $reasons = $admin->validateInput($_POST['reasons']);

        // Form Validation 
        if(empty($action) || empty($reasons) || empty($quantity)){
            $_SESSION['messageTitle'] = "Empty Fields";
            $_SESSION['messageText'] = "All Input Field are Required";
            $_SESSION['messageIcon'] = "error";
        }elseif(!preg_match("/^[0-9]*$/", $quantity)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only numbers allowed for the quantity field";
            $_SESSION['messageIcon'] = "error";
            return;
        }elseif(!preg_match("/^[a-z A-Z0-9]*$/", $reasons)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only alphabet and numbers allowed for reasons field";
            $_SESSION['messageIcon'] = "error";
            return;
        }else{

            if($action == 1){
                if($product->addToStock($product_id,$quantity) === true){
                    if($product->addAdjustment($product_id,$quantity,$action,$reasons) === true){
                        $_SESSION['messageTitle'] = "Success";
                        $_SESSION['messageText'] = "Quantity adjusted successfully";
                        $_SESSION['messageIcon'] = "success";
                    }else{
                        $_SESSION['messageTitle'] = "Alert";
                        $_SESSION['messageText'] = "Failed to update product";
                        $_SESSION['messageIcon'] = "error";
                    }
                }else{
                    $_SESSION['messageTitle'] = "Alert";
                    $_SESSION['messageText'] = "Failed to update product";
                    $_SESSION['messageIcon'] = "error";
                }
            }else if($action == 2){
                if($product->removeFromStock($product_id,$quantity) === true){
                    if($product->addAdjustment($product_id,$quantity,$action,$reasons) === true){
                        $_SESSION['messageTitle'] = "Success";
                        $_SESSION['messageText'] = "Quantity adjusted successfully";
                        $_SESSION['messageIcon'] = "success";
                    }else{
                        $_SESSION['messageTitle'] = "Alert";
                        $_SESSION['messageText'] = "Failed to update product";
                        $_SESSION['messageIcon'] = "error";
                    }
                }else{
                    $_SESSION['messageTitle'] = "Alert";
                    $_SESSION['messageText'] = "Failed to update product";
                    $_SESSION['messageIcon'] = "error";
                }
            }

        }

    }

?>