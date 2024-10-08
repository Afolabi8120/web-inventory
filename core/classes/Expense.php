<?php

	class Expense {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

		// add expense
		public function addExpense($title,$description){
			$stmt = $this->pdo->prepare("INSERT INTO tblexpense (title,description) VALUES(:title,:description)");
			$stmt->bindParam(":title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":description", $description, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		// edit expense
		public function editExpense($expense_id,$title,$description){
			$stmt = $this->pdo->prepare("UPDATE tblexpense SET title=:title,description=:description WHERE expense_id=:expense_id");
			$stmt->bindParam(":expense_id", $expense_id, PDO::PARAM_INT);
			$stmt->bindParam(":title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":description", $description, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

	}

?>