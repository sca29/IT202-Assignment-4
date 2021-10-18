<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCtype html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Welcome back, <strong><?php echo $_SESSION['username']; ?>, to House Hunter Realty!</strong></h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
        <div class="dropdown">
            <button class="dropbtn">Select an Option</button>
            <div class="dropdown-content">
                <a href="opt1.php">Show Realtor Data</a>
                <a href="opt2test.php">Schedule an Appointment</a>
                <a href="opt3.php">Cancel an Appointment</a>
                <a href="opt4test.php">Register a Client Account</a>
            </div>
        </div>
        <p> <br> </p>
        <button class="btn" onclick="window.location.href='login.php'">Log Out</button>
    <?php endif ?>
</div>
		
</body>
</html>