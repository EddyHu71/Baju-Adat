<?php
	include "api/action.php";
	include "api/db.php";
	include "api/my_function.php";
	
	$crud = new Crud();
	
	if (ISSET($_POST['size_add'])) {
		$simbol_ukuran = $_POST['simbol_ukuran_add'];
		$minimun_ukuran = $_POST['minimun_ukuran_add'];
		$maksimun_ukuran = $_POST['maksimun_ukuran_add'];
		
	$query = $crud->insert("table_ukuran_baju", "");
	
	if ($query) {
		
	} else {
	
	}
	
	if (ISSET($_POST['size_update'])) {
		$simbol_ukuran = $_POST['simbol_ukuran_update'];
		$minimun_ukuran = $_POST['minimun_ukuran_update'];
		$maksimun_ukuran = $_POST['maksimun_ukuran_update'];
		
	$query = $crud->update("table_ukuran_baju", "");
	
	if ($query) {
		
	} else {
	
	}
	
	if (ISSET($_POST['size_delete'])) {
		$simbol_ukuran = $_POST['simbol_ukuran_delete'];
		$minimun_ukuran = $_POST['minimun_ukuran_delete'];
		$maksimun_ukuran = $_POST['maksimun_ukuran_delete'];
		
	$query = $crud->delete("table_ukuran_baju", "");
	
	if ($query) {
		
	} else {
	
	}
	}
?>