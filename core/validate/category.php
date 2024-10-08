<?php
    include('core/init.php');

    if(isset($_POST['btnAddCategory']) && !empty($_POST['btnAddCategory'])){ # create category

        $name = strtolower($admin->validateInput($_POST['name']));

        // Form Validation 
        if(empty($name)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "Category name cannot be empty";
            $_SESSION['messageIcon'] = "error";
        }elseif(!preg_match("/^[a-z A-Z]*$/", $name)){
            $_SESSION['messageTitle'] = "Only Alphabets";
            $_SESSION['messageText'] = "Only Alphabet allowed for the category name";
            $_SESSION['messageIcon'] = "error";
        }elseif ($category->checkCategoryName($name) === true){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Category name already exist";
            $_SESSION['messageIcon'] = "error";
        }else{

            // preventing sql injection
            $name = strtolower($admin->validateInput($name));

            if($category->addCategory($name) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "Category created successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to add category";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }else if(isset($_POST['btnUpdate']) && !empty($_POST['btnUpdate'])){ # update category

        $cat_id = strtolower($admin->validateInput($_POST['cat_id']));
        $name = strtolower($admin->validateInput($_POST['name']));

        // Form Validation 
        if(empty($name)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "Category name cannot be empty";
            $_SESSION['messageIcon'] = "error";
        }elseif(!preg_match("/^[a-z A-Z]*$/", $name)){
            $_SESSION['messageTitle'] = "Only Alphabets";
            $_SESSION['messageText'] = "Only Alphabet allowed for the category name";
            $_SESSION['messageIcon'] = "error";
        }else{
            

            if($category->updateCategory($cat_id,$name) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "Category updated successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
            	$_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to update category";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }else if(isset($_POST['btnDeleteCategory']) && !empty($_POST['btnDeleteCategory'])){ # delete category

        $cat_id = strtolower($admin->validateInput($_POST['cat_id']));

        if($admin->delete('tblcategory','cat_id',$cat_id) === true){
            $_SESSION['messageTitle'] = "Success";
            $_SESSION['messageText'] = "Category removed successfully";
            $_SESSION['messageIcon'] = "success";
        }else{
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Failed to remove category";
            $_SESSION['messageIcon'] = "error";
        }

    }

?>