<?php
    include('core/init.php');

    if(isset($_POST['btnAddExpense']) && !empty($_POST['btnAddExpense'])){ # create expense

        $name = $_POST['name'];
        $description = $_POST['description'];

        // Form Validation 
        if(empty($name) || empty($description)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "All fields cannot be empty";
            $_SESSION['messageIcon'] = "error";
        }else{

            // preventing sql injection
            $name = strtolower($admin->validateInput($name));
            $description = strtolower($admin->validateInput($description));

            if($expense->addExpense($name,$description) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "Expense created successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to add expense";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }else if(isset($_POST['btnEditExpense']) && !empty($_POST['btnEditExpense'])){ # update expense

        $expense_id = $_POST['expense_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Form Validation 
        if(empty($expense_id) || empty($name) || empty($description)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "All fields cannot be empty";
            $_SESSION['messageIcon'] = "error";
        }else{

            // preventing sql injection
            $expense_id = strtolower($admin->validateInput($expense_id));
            $name = strtolower($admin->validateInput($name));
            $description = strtolower($admin->validateInput($description));

            if($expense->editExpense($expense_id,$name,$description) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "Expense updated successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to update expense";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }else if(isset($_POST['btnDeleteExpense']) && !empty($_POST['btnDeleteExpense'])){ # delete category

        $expense_id = strtolower($admin->validateInput($_POST['expense_id']));

        if($admin->delete('tblexpense','expense_id',$expense_id) === true){
            $_SESSION['messageTitle'] = "Success";
            $_SESSION['messageText'] = "Expense record removed successfully";
            $_SESSION['messageIcon'] = "success";
        }else{
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Failed to remove expense record";
            $_SESSION['messageIcon'] = "error";
        }

    }

?>