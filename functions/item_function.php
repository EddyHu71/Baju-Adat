<?php
	include "action/api/action.php";
	include "action/api/db.php";
	include "action/api/my_function.php";
	
	$crud = new Crud();
	
	if (ISSET($_POST['item_add'])) {
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
		
		$query = $crud->fetchwhere("table_barang", "'$kode_item_register' = kode_barang");
		
		if ($query) {
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
		header("location:barang.php");
	}
	
	if (ISSET($_POST['item_update'])) {
		$name_item_update = $_POST['nama_barang_update'];
		$desc_item_update = $_POST['desc_barang_update'];
		$price_item_update = $_POST['price_barang_update'];
		$size_item_update = $_POST['size_barang_update'];
		$photo_item_update = "";
		
		$query = $crud->update("table_barang", "'$'");
		
		if ($query) {
		
		} else {
		
		}
	}
	
	if (ISSET($_POST['item_delete'])) {
		$name_item_delete = $_POST['nama_barang_delete'];
		$desc_item_delete = $_POST['desc_barang_delete'];
		$price_item_delete = $_POST['price_barang_delete'];
		$size_item_delete = $_POST['size_barang_delete'];
		
		
		$query = $crud->delete("table_barang", "");
		if ($query) {
		
		} else {
		
		}
	}
?>