<HTML>
<head>
	<title>Register your account</title>
	<?php
		include "library.php";
		include "../functions/user_function.php";
	?>
</head>

<body>
  <div class="form-group">

	<div class="col-md-4">
		<div class="form-group">
		<div id = "preview" style = "width:250px; height :250px; border:1px solid #000;">
			<center id = "lbl">Photo</center>
		</div>
			<input type = "file" class="form-control-file" required = "required" id = "photo" name = "photo_testimonial" />
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Enter Name" name="name_register" required>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Enter Username" name="username_register" required>
		</div>
		<div class="form-group">
			<input type="email" class="form-control" placeholder="Enter Email" name="email_register" required>
		</div>
		<div class="form-group">
			<input type="number" class="form-control" placeholder="Enter Phone Number" name="phone_register" required>	
		</div>
		<div class="form-group">
			<textarea class="form-control" placeholder="Enter Address" name="address_register" rows="3"></textarea>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Enter Password" name="pass_register" required>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Re-enter Password" name="pass_register_confirm" required>
		</div>
	    <p>By creating an account you agree to our Terms & Privacy.</p>

		<div class="form-group">
		  <button type="submit" class="btn btn-primary form-control" name="user_register">Sign Up</button>
		</div>
	</div>

  </div>
  
  <?php
	include "libraryjs.php";
  ?>
	<script type = "text/javascript">
		$(document).ready(function(){
			$pic = $('<img id = "image" width = "100%" height = "100%"/>');
			$lbl = $('<center id = "lbl">[Photo]</center>');
			$("#photo").change(function(){
				$("#lbl").remove();
				var files = !!this.files ? this.files : [];
				if(!files.length || !window.FileReader){
					$("#image").remove();
					$lbl.appendTo("#preview");
				}
				if(/^image/.test(files[0].type)){
					var reader = new FileReader();
					reader.readAsDataURL(files[0]);
					reader.onloadend = function(){
						$pic.appendTo("#preview");
						$("#image").attr("src", this.result);
					}
				}
			});
		});
	</script>
</body>
</HTML>