<HTML>
<head>
	<title>Register your account</title>
	<?php
		include "library.php";
		include "../functions/user_function.php";
	?>
</head>

<body>
  <div class="container">
    <p>Please fill in this form to create an account.</p>
    <hr>
	<input type="file" required>
    <input type="text" placeholder="Enter Name" name="name_register" required>
    <input type="text" placeholder="Enter Username" name="username_register" required>
    <input type="email" placeholder="Enter Email" name="email_register" required>
	<input type="number" placeholder="Enter Phone Number" name="phone_register" required>	
    <input type="text" placeholder="Enter Address" name="address_register" required>
	<input type="password" placeholder="Enter Password" name="pass_register" required>
    <input type="password" placeholder="Repeat Password" name="pass_register_confirm" required>


    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn" name="user_register">Sign Up</button>
    </div>
  </div>
  
  <?php
	include "libraryjs.php";
  ?>
</body>
</HTML>