<?php
	include "api/action.php";
	include "api/db.php";
	include "api/my_function.php";
	
	$crud = new Crud();
	
	if (ISSET($_POST['user_login'])) {
		$name_login = $_POST[''];
		$user_login = $_POST[''];
		$pass_login = $_POST[''];
		$query = $crud->fetchwhere("table_user", "'$user_login' = username_user AND '$pass_login' = password_user");
		if ($query) {
			echo "Anda berhasil login";
		} else {
			echo "Anda gagal login";
		}
	}
	
	if (ISSET($_POST['user_register'])) {
		$name_register = $_POST[''];
		$user_register = $_POST[''];
		$email_register = $_POST[''];
		$pass_register = $_POST[''];
		$phone_register = $_POST[''];
		$files = $_FILES['image']['tmp_name'];
		$photo_register = addslashes($_FILES['photo']['name']);
		$image_check = getimagesize($_FILES['image']['tmp_name']);
		if ($image_check == null) {
			echo "Image invalid";
		} else {
		
		}
		
		move_uploaded_file($_FILES['photo']['tmp_name'],"../users/" . $_FILES['photo']['name']);
		
		$query = $crud->fetchwhere("table_user", "'$user_register' = username_user AND '$email_register' = email_user");
		
		if ($query) {
			echo "Register gagal";
		} else {
			$tambah = [
			$name_register => 'name',
			$user_register => '',
			$email_register => '',
			$pass_register => '',
			$phone_register => '',
			$photo_register => ''
			];
			
			$crud->insert("table_register", $tambah);
			
		}
		header("location:login.php");
	}
	
	if (ISSET($_POST['user_update'])) {
		$name_update = $_POST[''];
		$user_update = $_POST[''];
		$email_update = $_POST[''];
		$pass_update = $_POST[''];
		$phone_update = $_POST[''];
		$photo_update = "";
		
		$query = $crud->update("table_user", "'$'");
		if ($query) {
		
		} else {
		
		}
	}
	
	
?>