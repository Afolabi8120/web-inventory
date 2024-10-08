<?php
    include('core/init.php');

    if(isset($_POST['btnLogin']) && !empty($_POST['btnLogin'])){
        // passing data received from user into variable
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Form Validation 
        if(empty($username) || empty($password)){
            $_SESSION['messageTitle'] = "Empty Fields";
            $_SESSION['messageText'] = "All Input Field are Required";
            $_SESSION['messageIcon'] = "warning";
        }else{

            // preventing sql injection
            $username = strtolower($admin->validateInput($username));
            $password = $admin->validateInput($password);

            // check if username exist
            if($admin->check('tbluser','username',$username) === true){

                // getting the user info using username
                $getUserInfo = $admin->fetchSingle('tbluser','username',$username); 

                if(password_verify($password, $getUserInfo->password)){
                    if($getUserInfo->usertype == 'a'){
                        $_SESSION['messageTitle'] = "Successful";
                        $_SESSION['messageText'] = "Login Successful";
                        $_SESSION['messageIcon'] = "success";
                        $_SESSION['admin'] = $getUserInfo->user_id;
                        header("refresh:2;url=dashboard"); 
                    }else if($getUserInfo->usertype == 'u'){
                        $_SESSION['messageTitle'] = "Successful";
                        $_SESSION['messageText'] = "Login Successful";
                        $_SESSION['messageIcon'] = "success";
                        $_SESSION['user'] = $getUserInfo->user_id;
                        header("refresh:1;url=dashboard"); 
                    }
                }elseif(!password_verify($password, $getUserInfo->password)){
                    $_SESSION['messageTitle'] = "Password Invalid";
                    $_SESSION['messageText'] = "Invalid Password Provided";
                    $_SESSION['messageIcon'] = "error";
                }
            }else{
                $_SESSION['messageTitle'] = "Login Failed";
                $_SESSION['messageText'] = "Invalid Details Provided";
                $_SESSION['messageIcon'] = "error";
            }
        }
    }


    
?>