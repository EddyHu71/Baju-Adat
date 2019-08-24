<?php
	include "../action/action.php";
	
	$db = new Crud();
	
	if (ISSET($_POST['size_add'])) {
		$simbol_ukuran = $_POST['simbol_ukuran_add'];
		$minimun_ukuran = $_POST['minimun_ukuran_add'];
		$maksimun_ukuran = $_POST['maksimun_ukuran_add'];
		
	}
	
	$query = $db->insert("table_ukuran_baju", "");
	
	if ($query) {
		
	} else {
	
	}
	
	if (ISSET($_POST['size_update'])) {
		$simbol_ukuran = $_POST['simbol_ukuran_update'];
		$minimun_ukuran = $_POST['minimun_ukuran_update'];
		$maksimun_ukuran = $_POST['maksimun_ukuran_update'];
		
	$query = $db->update("table_ukuran_baju", "");
	
		if ($query) {
			
		} else {
		
		}
	}
	
	if (ISSET($_POST['size_delete'])) {
		$simbol_ukuran = $_POST['simbol_ukuran_delete'];
		$minimun_ukuran = $_POST['minimun_ukuran_delete'];
		$maksimun_ukuran = $_POST['maksimun_ukuran_delete'];
		
	$query = $db->delete("table_ukuran_baju", "");
	
		if ($query) {
			
		} else {
		
		}
	}
?>