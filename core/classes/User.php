<?php

	class User {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

        // check if username already exist
		public function checkUsername($username){
        	$stmt = $this->pdo->prepare("SELECT username FROM tbluser WHERE username = :username");
        	$stmt->bindParam(":username", $username, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

        // check if email already exist
		public function checkEmail($email){
        	$stmt = $this->pdo->prepare("SELECT email FROM tbluser WHERE email = :email");
        	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

        // check if phone number already exist
		public function checkPhone($phone){
        	$stmt = $this->pdo->prepare("SELECT phone FROM tbluser WHERE phone = :phone");
        	$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

        // create new user
        public function addUser($username,$fullname,$email,$phone,$password,$usertype){
			$stmt = $this->pdo->prepare("INSERT INTO tbluser (username,fullname,email,phone,password,usertype) VALUES(:username,:fullname,:email,:phone,:password,:usertype)");
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":usertype", $usertype, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		// edit user account
        public function editUser($user_id,$username,$fullname,$email,$phone,$usertype){
			$stmt = $this->pdo->prepare("UPDATE tbluser SET username=:username,fullname=:fullname,email=:email,phone=:phone,usertype=:usertype WHERE user_id=:user_id ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":usertype", $usertype, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		// change user password
        public function changeUserPassword($user_id,$password){
			$stmt = $this->pdo->prepare("UPDATE tbluser SET password=:password WHERE user_id=:user_id ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function showUserBadge($user_id){
        	$stmt = $this->pdo->prepare("SELECT * FROM tbluser WHERE user_id = :user_id");
        	$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        	$stmt->execute();
        	
        	$getUsertype = $stmt->fetch(PDO::FETCH_ASSOC);

        	if($getUsertype['usertype'] === 'u'){
        		echo '<span class="badge badge-info">User</span>';
        	}else{
        		echo '<span class="badge badge-success">Admin</span>';
        	}
        }
		
	}

?>