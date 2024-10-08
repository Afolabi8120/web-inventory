<?php

	class Product extends Admin {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

		// generate product code
		public function generateProductCode(){

			$alpha = 1;
			$random_value = rand(3, 6);
			$a = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM"), 1, $alpha);
			$b = substr(str_shuffle("1234567890"), 1, $random_value);
			$product_code = $a . $b;

            return strtoupper($product_code);
		}

		// check if the product code already exist
		public function checkProductCode($product_code){
        	$stmt = $this->pdo->prepare("SELECT product_code FROM tblproduct WHERE product_code = :product_code");
        	$stmt->bindParam(":product_code", $product_code, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

        // check if the product name already exist
		public function checkProductName($product_name){
        	$stmt = $this->pdo->prepare("SELECT product_name FROM tblproduct WHERE product_name = :product_name");
        	$stmt->bindParam(":product_name", $product_name, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

        // check if the product barcode already exist
		public function checkProductBarcode($barcode){
        	$stmt = $this->pdo->prepare("SELECT barcode FROM tblproduct WHERE barcode = :barcode");
        	$stmt->bindParam(":barcode", $barcode, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

		public function fetchAllProduct(){
			$stmt = $this->pdo->prepare("SELECT * FROM tblproduct WHERE status = 1 AND quantity > 0 ORDER BY product_name ASC ");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function fetchAllLowStock(){
			$stmt = $this->pdo->prepare("SELECT * FROM tblproduct WHERE quantity <= reorder_level ");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function fetchAllLowStockNotification(){
			$stmt = $this->pdo->prepare("SELECT * FROM tblproduct WHERE quantity <= 1 ORDER BY product_name DESC LIMIT 10 ");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		// show product status badge
		public function showProductBadge($product_id){
        	$stmt = $this->pdo->prepare("SELECT status FROM tblproduct WHERE product_id = :product_id");
        	$stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        	$stmt->execute();
        	
        	$getStatus = $stmt->fetch(PDO::FETCH_ASSOC);

        	if($getStatus['status'] == '1'){
        		echo '<span class="badge badge-success">Available</span>';
        	}elseif($getStatus['status'] == '0'){
        		echo '<span class="badge badge-danger">Not Available</span>';
        	}
        }

		// add product
		public function addProduct($product_code,$product_name,$barcode,$supplier_id,$category_id,$buying_price,$selling_price,$quantity,$unit,$product_image,$reorder_level,$status,$description,$manufacture_date,$expiry_date){
			$stmt = $this->pdo->prepare("INSERT INTO tblproduct (product_code,product_name,barcode,supplier_id,category_id,buying_price,selling_price,quantity,unit,product_image,reorder_level,status,description,manufacture_date,expiry_date) VALUES(:product_code,:product_name,:barcode,:supplier_id,:category_id,:buying_price,:selling_price,:quantity,:unit,:product_image,:reorder_level,:status,:description,:manufacture_date,:expiry_date)");
			$stmt->bindParam(":product_code", $product_code, PDO::PARAM_STR);
			$stmt->bindParam(":product_name", $product_name, PDO::PARAM_STR);
			$stmt->bindParam(":barcode", $barcode, PDO::PARAM_STR);
			$stmt->bindParam(":supplier_id", $supplier_id, PDO::PARAM_INT);
			$stmt->bindParam(":category_id", $category_id, PDO::PARAM_INT);
			$stmt->bindParam(":buying_price", $buying_price, PDO::PARAM_STR);
			$stmt->bindParam(":selling_price", $selling_price, PDO::PARAM_STR);
			$stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
			$stmt->bindParam(":unit", $unit, PDO::PARAM_STR);
			$stmt->bindParam(":product_image", $product_image, PDO::PARAM_STR);
			$stmt->bindParam(":reorder_level", $reorder_level, PDO::PARAM_INT);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":description", $description, PDO::PARAM_STR);
			$stmt->bindParam(":manufacture_date", $manufacture_date, PDO::PARAM_STR);
			$stmt->bindParam(":expiry_date", $expiry_date, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		// edit product
		public function editProduct($product_id,$product_name,$barcode,$supplier_id,$category_id,$buying_price,$selling_price,$quantity,$unit,$product_image,$reorder_level,$status,$description,$manufacture_date,$expiry_date){
			$stmt = $this->pdo->prepare("UPDATE tblproduct SET product_name=:product_name,barcode=:barcode,supplier_id=:supplier_id,category_id=:category_id,buying_price=:buying_price,selling_price=:selling_price,quantity=:quantity,unit=:unit,product_image=:product_image,reorder_level=:reorder_level,status=:status,description=:description,manufacture_date=:manufacture_date,expiry_date=:expiry_date WHERE product_id=:product_id ");
			$stmt->bindParam(":product_id", $product_id, PDO::PARAM_STR);
			$stmt->bindParam(":product_name", $product_name, PDO::PARAM_STR);
			$stmt->bindParam(":barcode", $barcode, PDO::PARAM_STR);
			$stmt->bindParam(":supplier_id", $supplier_id, PDO::PARAM_INT);
			$stmt->bindParam(":category_id", $category_id, PDO::PARAM_INT);
			$stmt->bindParam(":buying_price", $buying_price, PDO::PARAM_STR);
			$stmt->bindParam(":selling_price", $selling_price, PDO::PARAM_STR);
			$stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
			$stmt->bindParam(":unit", $unit, PDO::PARAM_STR);
			$stmt->bindParam(":product_image", $product_image, PDO::PARAM_STR);
			$stmt->bindParam(":reorder_level", $reorder_level, PDO::PARAM_INT);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":description", $description, PDO::PARAM_STR);
			$stmt->bindParam(":manufacture_date", $manufacture_date, PDO::PARAM_STR);
			$stmt->bindParam(":expiry_date", $expiry_date, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		# get total product quantity
		public function sumProductQuantity(){
			$stmt = $this->pdo->prepare("SELECT SUM(`quantity`) FROM `tblproduct` ");
			$stmt->execute();

			$count = $stmt->fetchColumn();

			if($count > 0){
				return $count;
			}else{
				return "0";
			}

		}

		// add to stock
		public function addToStock($product_id,$quantity){
			$stmt = $this->pdo->prepare("UPDATE tblproduct SET quantity= quantity + :quantity WHERE product_id=:product_id ");
			$stmt->bindParam(":product_id", $product_id, PDO::PARAM_STR);
			$stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
			$stmt->execute();

			return true;
		}

		// remove from stock
		public function removeFromStock($product_id,$quantity){
			$stmt = $this->pdo->prepare("UPDATE tblproduct SET quantity= quantity - :quantity WHERE product_id=:product_id ");
			$stmt->bindParam(":product_id", $product_id, PDO::PARAM_STR);
			$stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
			$stmt->execute();

			return true;
		}

		// add stock adjustment
		public function addAdjustment($product_id,$quantity,$action,$reasons){
			$stmt = $this->pdo->prepare("INSERT INTO tblstockadjustment (product_id,quantity,action,reasons) VALUES(:product_id,:quantity,:action,:reasons) ");
			$stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
			$stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
			$stmt->bindParam(":action", $action, PDO::PARAM_INT);
			$stmt->bindParam(":reasons", $reasons, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		# get the total cost of all items
		public function getItemsTotal(){
        	$stmt = $this->pdo->prepare("SELECT SUM(selling_price * quantity) FROM `tblproduct` ");
			$stmt->execute();
			$total = $stmt->fetch(PDO::FETCH_NUM);
			$total_income = $total[0];

			if($total_income > 0){
				return $total_income = $total[0];
			}else{
				return "0";
			}
			
        }

	}

?>