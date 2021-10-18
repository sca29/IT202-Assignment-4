<?php 
    $db = mysqli_connect('sql1.njit.edu', 'sca29', 'TsuShowMinnow13589!', 'sca29');
    session_start(); 

    $errors = array(); 

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
  	        <label>Enter the client's name</label>
  	        <input type="text" name="name">
        </div>
        <div class="input-group">
  	        <label>Select the client's type</label>
  	        <select name="type">
        		<option value="B">Buyer</option>
        		<option value="S">Seller</option>
			</select>
		</div>
		<div class="input-group">
  	        <label>Enter the client's address (Sellers only, "-" for buyers)</label>
  	        <input type="text" name="address">
        </div>
        <div class="input-group">
  	        <button type="submit" class="btn">Register new client</button>
  	    </div>
    </form>

    <?php

        if (isset($_POST['name'])) 
        {
            // this adds a new client
			$name = $_POST['name'];
			$address = $_POST['address'];
			$type = $_POST['type'];
            $numTick = 0;
            
            if ($type == "S") 
            {
				$numTick = 1; 
            } 
            else 
            {
				$numTick = 0;
			}

            $query = "INSERT INTO `Clientele`(`id`, `client_name`, `client_type`, `client_address`) VALUES (NULL, '$name', '$numTick', '$address')";
            $result = mysqli_query($db, $query);
			
            echo "Displaying Clients: <br>";
            $query = "SELECT * FROM `Clientele`";
            $result = mysqli_query($db, $query);

            while($R = $result->fetch_array()) 
            {
                $wordType;
                    if($R[2] == 1)
                    {
                        $wordType = "Seller";
                    }
                    else
                    {
                        $wordType = "Buyer";
                    }
                echo "The client $R[1] is a $wordType, with an address at $R[3]<br>";
            }
        } 
        else 
        {
            $query = "SELECT * FROM `Clientele`";
            $result = mysqli_query($db, $query);

            while($R = $result->fetch_array()) 
            {
                $wordType;
                    if($R[2] == 1)
                    {
                        $wordType = "Seller";
                    }
                    else
                    {
                        $wordType = "Buyer";
                    }
                echo "The client $R[1] is a $wordType, with an address at $R[3]<br>";
            }
        }
    ?>

    <p> <br> </p>
    <button class="btn" onclick="window.location.href='index.php'">Return</button>
    <button class="btn" onclick="window.location.href='login.php'">Log Out</button>
    
</body>
</html>
