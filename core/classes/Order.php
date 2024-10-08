<?php

	class Order extends Admin{

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

		// generate transaction ID
		public function generateTransactionID(){

			$alpha = 1;
			$random_value = rand(3, 6);
			$a = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM"), 1, $alpha);
			$b = substr(str_shuffle("1234567890"), 1, $random_value);
			$product_code = $a . $b;

            return date('Ymd').strtoupper($product_code);
		}

        public function addToCart($invoiceno,$user_id,$product_id,$quantity,$price){

			$stmt = $this->pdo->prepare("INSERT INTO tblcart (invoiceno,user_id,product_id,quantity,price) VALUES(:invoiceno,:user_id,:product_id,:quantity,:price)");
			$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
			$stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
			$stmt->bindParam(":price", $price, PDO::PARAM_STR);
			$stmt->execute();

			return true;
			
		}

		public function addPayment($invoiceno,$total,$paytype,$payment_status){

			$stmt = $this->pdo->prepare("INSERT INTO tblpayment (invoiceno,total,paytype,payment_status) VALUES(:invoiceno,:total,:paytype,:payment_status)");
			$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
			$stmt->bindParam(":total", $total, PDO::PARAM_STR);
			$stmt->bindParam(":paytype", $paytype, PDO::PARAM_STR);
			$stmt->bindParam(":payment_status", $payment_status, PDO::PARAM_INT);
			$stmt->execute();

			return true;
			
		}

		public function getSalesSummary($date_from,$date_to){
			$stmt = $this->pdo->prepare("SELECT c.invoiceno,pro.product_name,c.user_id,c.quantity,c.price,p.total,p.paytype,p.payment_status,p.date_paid FROM tblcart AS c INNER JOIN tblpayment AS p ON c.invoiceno = p.invoiceno INNER JOIN tblproduct AS pro ON c.product_id = pro.product_id WHERE p.date_paid BETWEEN :date_from AND :date_to");
			$stmt->bindParam(":date_from", $date_from, PDO::PARAM_STR);
			$stmt->bindParam(":date_to", $date_to, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function getSalesSummaryTotal($date_from,$date_to){
			$stmt = $this->pdo->prepare("SELECT SUM(c.price * c.quantity) FROM tblcart AS c INNER JOIN tblpayment AS p ON c.invoiceno = p.invoiceno INNER JOIN tblproduct AS pro ON c.product_id = pro.product_id WHERE p.date_paid  BETWEEN :date_from AND :date_to ORDER BY p.date_paid ASC ");
			$stmt->bindParam(":date_from", $date_from, PDO::PARAM_STR);
			$stmt->bindParam(":date_to", $date_to, PDO::PARAM_STR);
			$stmt->execute();

			$count = $stmt->fetchColumn();

			if($count > 0){
				return $count;
			}else{
				return "0";
			}
		}

		public function printOrderStatusBadge($invoiceno){
        	$stmt = $this->pdo->prepare("SELECT * FROM tblpayment WHERE invoiceno = :invoiceno");
        	$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
        	$stmt->execute();
        	
        	$result = $stmt->fetch(PDO::FETCH_ASSOC);

        	switch ($result['payment_status']) {
        		case '0':
        			echo '<span class="badge badge-dark">Not Paid</span>';
        			break;
        		case '1':
        			echo '<span class="badge badge-success">Paid</span>';
        			break;
        	}

        }

        public function printPaymentStatus($invoiceno){
        	$stmt = $this->pdo->prepare("SELECT * FROM tblpayment WHERE invoiceno = :invoiceno");
        	$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
        	$stmt->execute();
        	
        	$result = $stmt->fetch(PDO::FETCH_ASSOC);

        	switch ($result['payment_status']) {
        		case '0':
        			return 'Not Paid';
        			break;
        		case '1':
        			return 'Paid';
        			break;
        	}

        }

        public function printSellerUsername($invoiceno){
        	$stmt = $this->pdo->prepare("SELECT * FROM tblcart WHERE invoiceno = :invoiceno");
        	$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
        	$stmt->execute();
        	
        	$result = $stmt->fetch(PDO::FETCH_ASSOC);

        	$getSellerData = $this->fetchSingle('tbluser','user_id',(string)$result['user_id']);
            return ucwords($getSellerData->username);

        }

        public function getTodayTotalSales(){
			$stmt = $this->pdo->prepare("SELECT SUM(pay.total) FROM tblcart AS c
					INNER JOIN tblproduct AS p ON p.product_id = c.product_id
					INNER JOIN tbluser AS u ON u.user_id = c.user_id
					INNER JOIN tblpayment AS pay ON pay.invoiceno = c.invoiceno
					WHERE DATE(pay.date_paid)=CURDATE() ");
			$stmt->execute();

			$count = $stmt->fetchColumn();

			if($count > 0){
				return $count;
			}else{
				return "0";
			}
		}

		public function getTodayTotalSalesProductCount(){
			$stmt = $this->pdo->prepare("SELECT SUM(c.quantity) FROM tblcart AS c
					INNER JOIN tblproduct AS p ON p.product_id = c.product_id
					INNER JOIN tbluser AS u ON u.user_id = c.user_id
					INNER JOIN tblpayment AS pay ON pay.invoiceno = c.invoiceno
					WHERE DATE(pay.date_paid)=CURDATE() ");
			$stmt->execute();

			$count = $stmt->fetchColumn();

			if($count > 0){
				return $count;
			}else{
				return "0";
			}
		}

		public function getTodayTotalSalesProductLast3Item(){
			$stmt = $this->pdo->prepare("SELECT * FROM tblcart AS c INNER JOIN tblpayment AS pay ON pay.invoiceno = c.invoiceno WHERE DATE(pay.date_paid)=CURDATE() ORDER BY c.id DESC LIMIT 3 ");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);

		}

		public function getRecentSales(){
			$stmt = $this->pdo->prepare("SELECT * FROM tblpayment ORDER BY id DESC LIMIT 5 ");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);

		}

		public function getChart1(){
        	$stmt = $this->pdo->prepare("SELECT p.product_name,SUM(c.quantity * c.price) AS total FROM tblcart AS c INNER JOIN tblproduct AS p ON c.product_id = p.product_id GROUP BY c.product_id ORDER BY total DESC LIMIT 5");
        	$stmt->execute();
        	
        	$result = $stmt->fetchAll(PDO::FETCH_OBJ);

        	return $result;

        }

		public function getChart2(){
        	$stmt = $this->pdo->prepare("SELECT p.product_name,SUM(c.quantity) AS qty FROM tblcart AS c INNER JOIN tblproduct AS p ON c.product_id = p.product_id GROUP BY c.product_id ORDER BY qty DESC LIMIT 5 ");
        	$stmt->execute();
        	
        	$result = $stmt->fetchAll(PDO::FETCH_OBJ);

        	return $result;

        }

        public function getLastTransactionID(){
        	$stmt = $this->pdo->prepare("SELECT * FROM `tblpayment` ORDER BY id DESC LIMIT 1 ");
        	$stmt->execute();
        	
        	$result = $stmt->fetch(PDO::FETCH_ASSOC);

        	return $result['invoiceno'];

        }

	}

?>