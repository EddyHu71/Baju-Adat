<?php
	include "action.php";
	$crud = new Crud();
	
	if (isset($_POST['user_login'])) {
		$name_login = $_POST[''];
		$user_login = $_POST[''];
		$pass_login = $_POST[''];
		$crud->fetchwhere("table_user", "'$user_login' = username_user AND '$pass_login' = password_user");
		if ($crud) {
			echo "Anda berhasil login";
		} else {
			echo "Anda gagal login";
		}
	}
	
	if (isset($_POST['user_register'])) {
		$name_register = $_POST[''];
		$user_register = $_POST[''];
		$email_register = $_POST[''];
		$pass_register = $_POST[''];
		$phone_register = $_POST[''];
		
		$crud->fetchwhere("table_user", "'$user_register' = username_user AND '$email_register' = email_user");
		if ($crud) {
			echo "Register gagal";
		} else {
			echo "Register sukses";
		}
	}
	
	if (isset($_POST[''])) {
		
	}
?>