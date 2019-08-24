<HTML>
<?php
	include "../includes/library.php";
?>

<body>
  <div class="container">
  
    <p>Please fill in this form to create an account.</p>
    <hr>
    <input type="text" placeholder="Enter Name" name="name_register" required>
    <input type="text" placeholder="Enter Username" name="username-register" required>
    <input type="email" placeholder="Enter Email" name="email_register" required>
	<input type="number" placeholder="Enter Phone Number" name="phone_register" required>	
    <input type="text" placeholder="Enter Address" name="address_register" required>
	
	<input type="password" placeholder="Enter Password" name="pass_register" required>
    <input type="password" placeholder="Repeat Password" name="pass_register_confirm" required>
	<input type="file" 
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</body>
</HTML>