<?php
    include('../core/init.php');

    // update user details
    if(isset($_POST['btnUpdateUser']) && !empty($_POST['btnUpdateUser'])){

        // passing data received from user into variable
        $user_id = $_POST['user_id'];
        $matricno = $_POST['matricno'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $program = $_POST['program'];
        $level = $_POST['level'];
        $faculty = $_POST['faculty'];
        $department = $_POST['department'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];

        # getting the user's information
        $getUser = $admin->fetchSingle('tbluser','id',$user_id);

        // Form Validation 
        if(empty($user_id) || empty($matricno) || empty($firstname) || empty($lastname) || empty($department) || empty($faculty) || empty($email) || empty($gender) || empty($phone) || empty($program) || empty($level) || empty($address)){
            $_SESSION['ErrorMessage'] = "All Input Field are Required";
        }elseif($getUser->id != $user_id) { # checking if the id passed from the form matches with the one in database
            $_SESSION['ErrorMessage'] = "Invalid user ID";
        }elseif(strlen($phone) < 11 || strlen($phone) > 11) {
            $_SESSION['ErrorMessage'] = "Please Use a Valid Phone No";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['ErrorMessage'] = "Please use a valid Email Address";
        }elseif(!preg_match("/^[a-z A-Z]*$/", $firstname)){
            $_SESSION['ErrorMessage'] = "Only Alphabet allowed for the firstname field";
        }elseif(!preg_match("/^[a-z A-Z]*$/", $lastname)){
            $_SESSION['ErrorMessage'] = "Only Alphabet allowed for the lastname field";
        }elseif(!preg_match("/^[a-zA-Z\d]*$/", $matricno)){
            $_SESSION['ErrorMessage'] = "Invalid matric or form number";
        }elseif(!preg_match("/^[\d]*$/", $phone)){
            $_SESSION['ErrorMessage'] = "Please Use a Valid Phone No";
        }else{

            // preventing sql injection
            $user_id = $admin->validateInput($user_id);
            $matricno = $admin->validateInput($matricno);
            $firstname = strtolower($admin->validateInput($firstname));
            $lastname = strtolower($admin->validateInput($lastname));
            $email = $admin->validateInput($email);
            $phone = $admin->validateInput($phone);
            $program = $admin->validateInput($program);
            $level = $admin->validateInput($level);
            $department = $admin->validateInput($department);
            $faculty = $admin->validateInput($faculty);
            $gender = $admin->validateInput($gender);
            $address = $admin->validateInput($address);

            if($user->updateUserByAdmin($getUser->id,$matricno,$firstname,$lastname,$email,$phone,$gender,$program,$level,$faculty,$department,$address) === true){
                $_SESSION['SuccessMessage'] = "Profile details changed Successfully";
            }else{
                $_SESSION['ErrorMessage'] = "Unable to update user's Profile";
            }
            
        }

    }else if(isset($_POST['btnActivate']) && !empty($_POST['btnActivate'])){

        // passing data received from user into variable
        $user_id = $_POST['user_id'];

        # getting the user's information
        $getUser = $admin->fetchSingle('tbluser','id',$user_id);

        // Form Validation 
        if($getUser->id != $user_id) { # checking if the id passed from the form matches with the one in database
            $_SESSION['ErrorMessage'] = "Invalid user ID";
        }else{

            if($admin->changeStatus('tbluser','status',1,'id',$getUser->id) === true){
                $_SESSION['SuccessMessage'] = "User account activated successfully";
            }else{
                $_SESSION['ErrorMessage'] = "Unable to activate user's account";
            }
            
        }

    }else if(isset($_POST['btnDeactivate']) && !empty($_POST['btnDeactivate'])){ # deactivate customer's account

        // passing data received from form into variable
        $user_id = $_POST['user_id'];

        # getting the user's information
        $getUser = $admin->fetchSingle('tbluser','id',$user_id);

        // Form Validation 
        if($getUser->id != $user_id) { # checking if the id passed from the form matches with the one in database
            $_SESSION['ErrorMessage'] = "Invalid user ID";
        }else{

            if($admin->changeStatus('tbluser','status',2,'id',$getUser->id) === true){
                $_SESSION['SuccessMessage'] = "User account deactivated successfully";
            }else{
                $_SESSION['ErrorMessage'] = "Unable to deactivate user's account";
            }
            
        }

    }else if(isset($_POST['btnChangePassword']) && !empty($_POST['btnChangePassword'])){ # change customer password

        // passing data received from user into variable
        $new_password = $_POST['password'];
        $c_password = $_POST['cpassword'];

        $user_id = $_POST['user_id'];

        # getting the user's information
        $getUser = $admin->fetchSingle('tbluser','id',$user_id);

        // Form Validation 
        if(empty($new_password) || empty($c_password)){
            $_SESSION['ErrorMessage'] = "All input field are required";
        }elseif($getUser->id != $user_id) { # checking if the id passed from the form matches with the one in database
            $_SESSION['ErrorMessage'] = "Invalid user ID";
        }elseif($new_password !== $c_password) {
            $_SESSION['ErrorMessage'] = "Both new password do not match";
        }else{

            // preventing sql injection
            $new_password = $admin->validateInput($new_password);
            $c_password = $admin->validateInput($c_password);

            $newpassword = password_hash($new_password, PASSWORD_DEFAULT);
                
            // update customer's password
            if($user->updateUserPassword($getUser->id,$newpassword) === true){
                $_SESSION['SuccessMessage'] = "Password changed Successfully";
            }else{
                $_SESSION['ErrorMessage'] = "Unable to change your password";
            }
            
        }

    }

?>