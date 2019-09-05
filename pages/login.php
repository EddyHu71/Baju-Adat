<HTML>
<head>
	<title>Login</title>
	<?php
		include "library.php";
		include "../functions/user_function.php";
	?>
	
</head>
<body>
	<?php
		include "../includes/tabbar.php";
	?>
	
	<div class="col-md-6 container">
		<form method="POST" enctype = "multipart/form-data">
			<div width="500px" height="500px">
				<img src="logo_budat.png" alt="Avatar" class="avatar">
			</div>
				<div class="container">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter Username" name="user_login" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Enter Password" name="pass_login" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary form-control" name="user_register">Login</button>
					</div>
				</div>

		  <div class="container" style="background-color:#f1f1f1">
			<span class="psw">Forgot <a href="#">password?</a></span>
		  </div>
		</form>
	</div>
	
	  <?php
		include "libraryjs.php";
	  ?>
</body>
</HTML>