<?php

	class Supplier {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

        // check if email already exist
		public function checkEmail($email){
        	$stmt = $this->pdo->prepare("SELECT email FROM tblsupplier WHERE email = :email");
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
        	$stmt = $this->pdo->prepare("SELECT phone FROM tblsupplier WHERE phone = :phone");
        	$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

        // create new supplier
        public function addSupplier($fullname,$email,$phone,$address){
			$stmt = $this->pdo->prepare("INSERT INTO tblsupplier (fullname,email,phone,address) VALUES(:fullname,:email,:phone,:address)");
			$stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		// edit supplier account
        public function editSupplier($supplier_id,$fullname,$email,$phone,$address){
			$stmt = $this->pdo->prepare("UPDATE tblsupplier SET fullname=:fullname,email=:email,phone=:phone,address=:address WHERE supplier_id=:supplier_id ");
			$stmt->bindParam(":supplier_id", $supplier_id, PDO::PARAM_INT);
			$stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		// store settings
        public function setStoreInfo($name,$phone,$email,$address,$motto){
			$stmt = $this->pdo->prepare("UPDATE tblsettings SET name=:name,phone=:phone,email=:email,address=:address,motto=:motto ");
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_STR);
			$stmt->bindParam(":motto", $motto, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}
		
	}

?>