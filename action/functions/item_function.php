<?php
	include "api/action.php";
	include "api/db.php";
	include "api/my_function.php";
	
	$crud = new Crud();
	
	if (isset($_POST['item_add'])) {
		$kode_item_register = $_POST['kode_barang_add'];
		$name_item_register = $_POST['nama_barang_add'];
		$desc_item_register = $_POST['desc_barang_add'];
		$price_item_register = $_POST['size_barang_add'];
		//$size_item_register = $_POST[''];
		$files = $_FILES['image']['tmp_name'];
		$photo_item_register = addslashes($_FILES['photo']['name']);
		$image_check = getimagesize($_FILES['image']['tmp_name']);
		if ($image_check == null) {
			echo "Image invalid";
		} else {
		
		}
		
		move_uploaded_file($_FILES['photo']['tmp_name'],"../users/" . $_FILES['photo']['name']);
		
		$crud->fetchwhere("table_barang", "'$kode_item_register' = kode_barang");
		
		if ($crud) {
			echo "Tambah Produk gagal";
		} else {
			$tambah = [
			$name_item_register => 'name',
			$desc_item_register => '',
			$price_item_register => '',
			//$size_item_register => '',
			$photo_item_register => ''
			];
			
			$crud->insert("table_register", $tambah);
			
		}
		header("location:login.php");
	}
	
	if (isset($_POST['item_update'])) {
		$name_item_update = $_POST['nama_barang_update'];
		$desc_item_update = $_POST['desc_barang_update'];
		$price_item_update = $_POST['price_barang_update'];
		$size_item_update = $_POST['size_barang_update'];
		$photo_item_update = "";
		
		$crud->update("table_user", "'$'");
	}
	
	
?>