<?php
    include('core/init.php');

    if(isset($_POST['btnAddUser']) && !empty($_POST['btnAddUser'])){ # create new user account

        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone =$_POST['phone'];
        $usertype =$_POST['usertype'];
        $password =$_POST['password'];
        $cpassword =$_POST['cpassword'];

        // Form Validation 
        if(empty($username) || empty($fullname) || empty($email) || empty($phone) || empty($usertype) || empty($password) || empty($cpassword)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "All input fields are required";
            $_SESSION['messageIcon'] = "error";
        }elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only alphabet and numbers allowed for username";
            $_SESSION['messageIcon'] = "error";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Please use a valid email address";
            $_SESSION['messageIcon'] = "error";
        }elseif ($user->checkUsername($username) === true){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Username already taken";
            $_SESSION['messageIcon'] = "error";
        }elseif ($user->checkEmail($email) === true){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Email already taken";
            $_SESSION['messageIcon'] = "error";
        }elseif ($user->checkPhone($phone) === true){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Phone No. already in use";
            $_SESSION['messageIcon'] = "error";
        }elseif ($password !== $cpassword){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Both password do not match";
            $_SESSION['messageIcon'] = "error";
        }elseif(strlen($password) < 5){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "Password length must be up to or more than 5 characters";
            $_SESSION['messageIcon'] = "error";
        }else{

            $username = strtolower($admin->validateInput($username));
            $fullname = strtolower($admin->validateInput($fullname));
            $email = strtolower($admin->validateInput($email));
            $phone = $admin->validateInput($phone);
            $usertype = $admin->validateInput($usertype);
            $password = $admin->validateInput($password);
            $cpassword = $admin->validateInput($cpassword);

            #hashing the password
            $pass = password_hash($password, PASSWORD_DEFAULT);

            if($user->addUser($username,$fullname,$email,$phone,$pass,$usertype) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "User account created successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to create user account";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }else if(isset($_POST['btnEditUser']) && !empty($_POST['btnEditUser'])){ # update user account

        $user_id = strtolower($admin->validateInput($_POST['user_id']));
        $username = strtolower($admin->validateInput($_POST['username']));
        $fullname = strtolower($admin->validateInput($_POST['fullname']));
        $email = strtolower($admin->validateInput($_POST['email']));
        $phone = $admin->validateInput($_POST['phone']);
        $usertype = $admin->validateInput($_POST['usertype']);

        // Form Validation 
        if(empty($user_id) || empty($username) || empty($fullname) || empty($email) || empty($phone) || empty($usertype)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "All input fields are required";
            $_SESSION['messageIcon'] = "error";
        }elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only alphabet and numbers allowed";
            $_SESSION['messageIcon'] = "error";
        }else{

            if($user->editUser($user_id,$username,$fullname,$email,$phone,$usertype) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "User account updated successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to update user account";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }else if(isset($_POST['btnChangeUserPassword']) && !empty($_POST['btnChangeUserPassword'])){ # admin change user password

        $user_id = strtolower($admin->validateInput($_POST['user_id']));
        $password = strtolower($admin->validateInput($_POST['password']));
        $cpassword = strtolower($admin->validateInput($_POST['cpassword']));

        // Form Validation 
        if(empty($user_id) || empty($password) || empty($cpassword)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "All input fields are required";
            $_SESSION['messageIcon'] = "error";
        }elseif ($password !== $cpassword){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Both password do not match";
            $_SESSION['messageIcon'] = "error";
        }elseif(strlen($password) < 5){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "Password length must be up to or more than 5 characters";
            $_SESSION['messageIcon'] = "error";
        }else{

            # encrypting the user password
            $newpassword = password_hash($password, PASSWORD_DEFAULT);

            if($user->changeUserPassword($user_id,$newpassword) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "User password changed successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to change user password";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }else if(isset($_POST['btnDeleteUser']) && !empty($_POST['btnDeleteUser'])){ # delete user account

        $user_id = $admin->validateInput($_POST['user_id']);

        if($admin->delete('tbluser','user_id',$user_id) === true){
            $_SESSION['messageTitle'] = "Success";
            $_SESSION['messageText'] = "User removed successfully";
            $_SESSION['messageIcon'] = "success";
        }else{
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Failed to remove user";
            $_SESSION['messageIcon'] = "error";
        }

    }else if(isset($_POST['btnChangeProfilePassword']) && !empty($_POST['btnChangeProfilePassword'])){ # change user password

        $user_id = $_POST['user_id'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $old_password = $_POST['old_password'];

        // Form Validation 
        if(empty($user_id) || empty($password) || empty($cpassword) || empty($old_password)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "All input fields are required";
            $_SESSION['messageIcon'] = "error";
        }elseif(strlen($password) < 5){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "Password length must be up to or more than 5 characters";
            $_SESSION['messageIcon'] = "error";
        }elseif ($password !== $cpassword){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Both password do not match";
            $_SESSION['messageIcon'] = "error";
        }else{

            $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);

            $user_id = $getAdmin->user_id;
            $password = $admin->validateInput($password);
            $cpassword = $admin->validateInput($cpassword);
            $old_password = $admin->validateInput($old_password);

            if(password_verify($old_password, $getAdmin->password)){

                // Hashing the password provided by the user word
                $newpassword = password_hash($password, PASSWORD_DEFAULT);
                
                if($user->changeUserPassword($user_id,$newpassword) === true){
                    $_SESSION['messageTitle'] =  "Success";
                    $_SESSION['messageText'] = "Password changed Successfully";
                    $_SESSION['messageIcon'] = "success";
                }else{
                    $_SESSION['messageTitle'] =  "Update Failed";
                    $_SESSION['messageText'] = "Unable to change your password";
                    $_SESSION['messageIcon'] = "danger";
                }

            }else{
                $_SESSION['messageTitle'] =  "Failed";
                $_SESSION['messageText'] = "Old password provided is not correct";
                $_SESSION['messageIcon'] = "warning";
            }
        }

    }else if(isset($_POST['btnUpdateProfile']) && !empty($_POST['btnUpdateProfile'])){ # update profile info

        $user_id = strtolower($admin->validateInput($_POST['user_id']));
        $username = strtolower($admin->validateInput($_POST['username']));
        $fullname = strtolower($admin->validateInput($_POST['fullname']));
        $email = strtolower($admin->validateInput($_POST['email']));
        $phone = $admin->validateInput($_POST['phone']);

        // Form Validation 
        if(empty($user_id) || empty($username) || empty($fullname) || empty($email) || empty($phone)){
            $_SESSION['messageTitle'] = "Empty Field";
            $_SESSION['messageText'] = "All input fields are required";
            $_SESSION['messageIcon'] = "error";
        }elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $_SESSION['messageTitle'] = "Alert";
            $_SESSION['messageText'] = "Only alphabet and numbers allowed for username";
            $_SESSION['messageIcon'] = "error";
        }else{

            $getAdmin = $admin->fetchSingle('tbluser','user_id',$user_id);

            $user_id = $getAdmin->user_id;

            if($user->editUser($user_id,$username,$fullname,$email,$phone,$getAdmin->usertype) === true){
                $_SESSION['messageTitle'] = "Success";
                $_SESSION['messageText'] = "User account updated successfully";
                $_SESSION['messageIcon'] = "success";
            }else{
                $_SESSION['messageTitle'] = "Alert";
                $_SESSION['messageText'] = "Failed to update user account";
                $_SESSION['messageIcon'] = "error";
            }
        }

    }

?>