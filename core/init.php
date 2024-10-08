<?php
	include('database/config.php');
	include('classes/Admin.php');
	include('classes/Category.php');
	include('classes/User.php');
	include('classes/Supplier.php');
	include('classes/Product.php');
	include('classes/Order.php');
	include('classes/Expense.php');

	global $pdo;

	# class instances
	$admin = new Admin($pdo);
	$category = new Category($pdo);
	$product = new Product($pdo);
	$order = new Order($pdo);
	$user = new User($pdo);
	$supplier = new Supplier($pdo);
	$expense = new Expense($pdo);

	session_start();

	date_default_timezone_set("Africa/Lagos");
    $h = date('G');

    if($h >= 5 && $h <= 11){
        $getdate = "Good morning";
    }else if($h >= 12 && $h <= 15){
        $getdate = "Good afternoon";
    }else if($h >= 16 && $h <= 23){
        $getdate = "Good evening";
    }else {
        $getdate = "Good morning";
    }

    $getStoreData = $admin->fetch('tblsettings');

?>