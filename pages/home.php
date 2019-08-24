<HTML>
<head>
	<title>Welcome to Budat</title>
	<?php
		include "library.php";
		include "../functions/user_function.php";
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		include "../includes/tabbar.php";
	?>
<div>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
	  <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
	  <li data-target="#myCarousel" data-slide-to="5"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="images/gambar1.jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="images/gambar2.jpg" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="images/gambar3.jpg" alt="New York" style="width:100%;">
      </div>
      <div class="item">
        <img src="images/gambar4.png" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="images/gambar5.jpg" alt="New York" style="width:100%;">
      </div>
      <div class="item">
        <img src="images/gambar6.jpg" alt="New York" style="width:100%;">
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
	<h3>Product</h3>
</div>
<div class="container">
	<div class="col-md-4">
		<img src="barang/1aceh.png">
	</div>
	<div class="col-md-4">
		<img src="barang/1gorontalo.png">
	</div>
	<div class="col-md-4">
		<img src="barang/1karo.png">
	</div>
</div>
</body>
</HTML>