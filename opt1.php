<?php 
    ini_set('display_errors', '1');
    $db = mysqli_connect('sql1.njit.edu', 'sca29', 'TsuShowMinnow13589!', 'sca29');
    session_start(); 

    if (!isset($_SESSION['username'])) {
    	$_SESSION['msg'] = "You must be logged in first";
  	    header('location: login.php');
    }
    if (isset($_GET['logout'])) {
  	    session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['id']); 
  	    header("location: login.php");
    }
?>

<!DOCtype html>
<html>
<head>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <h2>Showing Current User's Information</h2>
    
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Realtor: <?php echo $_SESSION['username']; ?></p>
        <p>Realtor Password: <?php echo $_SESSION['password']; ?></p>
        <p>Realtor ID Number: <?php echo $_SESSION['id']; ?></p>
    <?php endif ?>

    <?php
        $cuser = $_SESSION['username'];
        $q = "SELECT * FROM TimeTable WHERE realtor_name='$cuser'";
        $results = mysqli_query($db, $q);

        while($R = $results->fetch_array()) {
            echo "Realtor's Client is $R[2] at $R[3] <br>";
        }

    ?>
    <p> <br> </p>
    <button class="btn" onclick="window.location.href='index.php'">Return</button>
    <button class="btn" onclick="window.location.href='login.php'">Log Out</button>
    
    

</body>
</html>
