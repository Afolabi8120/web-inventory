<?php
	include('core/init.php');
	unset($_SESSION['admin']);
	header('location: login');

?>