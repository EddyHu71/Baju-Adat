<HTML>
<head>
	<title>Login</title>
	
	<?php
		include "library.php";
		include "../functions/user_function.php";
	?>
</head>

<body>
	<div class="imgcontainer">
		<img src="img_avatar2.png" alt="Avatar" class="avatar">
	</div>

	  <div class="container">
		<input type="text" placeholder="Enter Username" name="username_login" required>

		<input type="password" placeholder="Enter Password" name="password_login" required>

		<button type="submit" name="user_login">Login</button>
		<label>
		  <input type="checkbox" checked="checked" name="remember"> Remember me
		</label>
	  </div>

	  <div class="container" style="background-color:#f1f1f1">
		<button type="button" class="cancelbtn">Cancel</button>
		<span class="psw">Forgot <a href="#">password?</a></span>
	  </div>
	  
	  <?php
		include "libraryjs.php";
	  ?>
</body>
</HTML>