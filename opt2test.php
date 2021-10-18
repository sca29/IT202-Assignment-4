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

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

    <form method="post">
        <div class="input-group">
  	        <label>Name</label>
  	        <input type="text" name="name">
        </div>
        <div class="input-group">
  	        <label>Date</label>
  	        <input type="text" name="date">
        </div>
        <div class="input-group">
  	        <button type="submit" class="btn">Schedule Appointment</button>
  	    </div>
    </form>

    <?php

        if (isset($_POST['name'])) {
            // this adds a new appointment
            $name = $_POST['name'];
            $date = $_POST['date'];
            $cuser = $_SESSION['username'];
            $query = "INSERT INTO `TimeTable`(`id`, `realtor_name`, `client_name`, `times`) VALUES (NULL, '$cuser', '$name', '$date')";
            $result = mysqli_query($db, $query);

            echo "Current Appointment Schedule: <br>";
            $query = "SELECT * FROM TimeTable WHERE realtor_name='$cuser'";
            $result = mysqli_query($db, $query);

            while($R = $result->fetch_array()) {
                echo "Realtor's Client is $R[2] at $R[3] <br>";
            }
        } else {
            $cuser = $_SESSION['username'];
            $query = "SELECT * FROM TimeTable WHERE realtor_name='$cuser'";
            $result = mysqli_query($db, $query);

            while($R = $result->fetch_array()) {
                echo "Realtor's Client is $R[2] at $R[3] <br>";
            }
        }
    ?>

<p> <br> </p>
    <button class="btn" onclick="window.location.href='index.php'">Return</button>
    <button class="btn" onclick="window.location.href='login.php'">Log Out</button>
    

</body>
</html>
