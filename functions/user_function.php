 <?php
	include "../action/action.php";
	
	$db = new Crud();
	
	if (ISSET($_POST['user_login'])) {
		$user_login = $_POST['username_login'];
		$pass_login = $_POST['password_login'];
		$query = $db->fetchwhere("table_user", "'$user_login' = username_user AND '$pass_login' = password_user");
		if ($query) {
			echo "Anda berhasil login";
		} else {
			echo "Anda gagal login";
		}
	}
	
	if (ISSET($_POST['user_register'])) {
		$name_register = $_POST['name_register'];
		$user_register = $_POST['username_register'];
		$email_register = $_POST['email_register'];
		$pass_register = $_POST['pass_register'];
		$phone_register = $_POST['phone_register'];
		$files = $_FILES['photo']['tmp_name'];
		$photo_register = addslashes($_FILES['photo']['name']);
		$image_check = getimagesize($_FILES['photo']['tmp_name']);
		move_uploaded_file($_FILES['photo']['tmp_name'],"../users/" . $_FILES['photo']['name']);
		//move_uploaded_file($_FILES['photo']['tmp_name'],"../users/" . $_FILES['photo']['name']);
		
		$query = $db->fetchwhere("table_user", "'$user_register' = username_user AND '$email_register' = email_user");
		
	if ($query) {
			echo "Register gagal";
		} else {
			$tambah = array(
				"'$name_register' => 'name_user'",
				"'$user_register' => 'username_user'",
				"'$pass_register' => 'password_user'",
				"'$email_register' => 'email_user'",
				"'$phone_register' => 'phone_user'",
				"'$photo_register' => 'photo_user'"
			);
			
			$db->insert("table_user", $tambah);
			
		}
		header("location:register.php");
	}
	
	if (ISSET($_POST['user_update'])) {
		$name_update = $_POST[''];
		$user_update = $_POST[''];
		$email_update = $_POST[''];
		$pass_update = $_POST[''];
		$phone_update = $_POST[''];
		$photo_update = "";
		
		$query = $db->update("table_user", "'$'");
	
	if ($query) {
		
		} else {
		
		}
	}
	
	
?>