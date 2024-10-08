<?php
    include('../core/init.php');

    if(isset($_POST['btnRegister']) && !empty($_POST['btnRegister'])){

        // passing data received from user into variable
        $matricno = $_POST['matricno'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $program = $_POST['program'];
        $level = $_POST['level'];
        $faculty = $_POST['faculty'];
        $department = $_POST['department'];
        $password = $_POST['password'];
        $password2 = $_POST['cpassword'];

        // Form Validation 
        if(empty($matricno) || empty($firstname) || empty($lastname) || empty($department) || empty($faculty) || empty($email) || empty($password) || empty($phone) || empty($program) || empty($level) || empty($password2) || empty($password)){
            $_SESSION['messageTitle'] = "Empty Fields";
            $_SESSION['messageText'] = "All Input Field are Required";
            $_SESSION['messageIcon'] = "warning";
        }elseif(strlen($matricno) < 6 || strlen($matricno) > 13) {
            $_SESSION['messageTitle'] =  "Matric or Form No";
            $_SESSION['messageText'] = "Invalid matric or form number";
            $_SESSION['messageIcon'] = "warning";
        }elseif(strlen($phone) < 11 || strlen($phone) > 11) {
            $_SESSION['messageTitle'] =  "Invalid Phone No";
            $_SESSION['messageText'] = "Please Use a Valid Phone No";
            $_SESSION['messageIcon'] = "warning";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['messageTitle'] =  "Invalid Email";
            $_SESSION['messageText'] = "Please use a valid Email Address";
            $_SESSION['messageIcon'] = "warning";
        }elseif(!preg_match("/^[a-z A-Z]*$/", $firstname)){
            $_SESSION['messageTitle'] =  "Firstname Field not Valid";
            $_SESSION['messageText'] = "Only Alphabet allowed for the firstname field";
            $_SESSION['messageIcon'] = "warning";
        }elseif(!preg_match("/^[a-z A-Z]*$/", $lastname)){
            $_SESSION['messageTitle'] =  "Lastname Field not Valid";
            $_SESSION['messageText'] = "Only Alphabet allowed for the lastname field";
            $_SESSION['messageIcon'] = "warning";
        }elseif(!preg_match("/^[a-zA-Z\d]*$/", $matricno)){
            $_SESSION['messageTitle'] =  "Matric or Form No";
            $_SESSION['messageText'] = "Invalid matric or form number";
            $_SESSION['messageIcon'] = "warning";
        }elseif(!preg_match("/^[\d]*$/", $phone)){
            $_SESSION['messageTitle'] =  "Wrong Phone Number";
            $_SESSION['messageText'] = "Please Use a Valid Phone No";
            $_SESSION['messageIcon'] = "warning";
        }elseif ($password !== $password2) {
            $_SESSION['messageTitle'] =  "Password Not Match";
            $_SESSION['messageText'] = "Both Password Do Not Match";
            $_SESSION['messageIcon'] = "warning";
        }elseif ($user->checkMatricno($matricno) === true){
            $_SESSION['messageTitle'] =  "Not Available";
            $_SESSION['messageText'] = "Matric or Form Number Already In Use";
            $_SESSION['messageIcon'] = "warning";
        }elseif ($user->checkEmail($email) === true){
            $_SESSION['messageTitle'] =  "Not Available";
            $_SESSION['messageText'] = "Email Address Already In Use";
            $_SESSION['messageIcon'] = "warning";
        }elseif ($user->checkPhone($phone) === true){
            $_SESSION['messageTitle'] =  "Not Available";
            $_SESSION['messageText'] = "Phone Number Already In Use";
            $_SESSION['messageIcon'] = "warning";
        }else{

            // preventing sql injection
            $matricno = $admin->validateInput($matricno);
            $firstname = strtolower($admin->validateInput($firstname));
            $lastname = strtolower($admin->validateInput($lastname));
            $email = $admin->validateInput($email);
            $phone = $admin->validateInput($phone);
            $program = $admin->validateInput($program);
            $level = $admin->validateInput($level);
            $department = $admin->validateInput($department);
            $faculty = $admin->validateInput($faculty);
            $password = $admin->validateInput($password);
            $password2 = $admin->validateInput($password2);

            # generating chat code for student
            $alpha = "abcdefghijklmnopqrstuvwxyz";
            $alphabet = str_shuffle(substr($alpha, 0, 4));
            $rand = rand(111,9999).time();
            $rand2 = str_shuffle(substr($rand, 0, 4));
            $chat_code = "S". strtoupper(str_shuffle($rand2.$alphabet));

            $email = strtolower($email);

            //hashing the password
            $pass = password_hash($password, PASSWORD_DEFAULT);

            if($user->registerUser($matricno,$firstname,$lastname,$email,$phone,'',$program,$level,$faculty,$department,$pass,'','','s',$chat_code) === true){
                $_SESSION['name'] = ucwords($lastname);
                $_SESSION['msg-email'] = true;
                header('location: email-msg');
            }else{
                $_SESSION['messageTitle'] =  "Registration Not Successful";
                $_SESSION['messageText'] = "Failed to create account";
                $_SESSION['messageIcon'] = "danger";
            }
            
        }

    }


?>