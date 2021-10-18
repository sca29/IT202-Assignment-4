<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('sql1.njit.edu', 'sca29', 'my_password_here', 'sca29');


if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $id = mysqli_real_escape_string($db, $_POST['id']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (empty($id)) {
        array_push($errors, "ID is required");
    }
  
    if (count($errors) == 0) {
        $query = "SELECT * FROM Realtors WHERE realtor_name='$username' AND realtor_password='$password' AND realtor_id='$id'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $id;
            $_SESSION['success'] = "You have logged into House Hunter Realty System";
            header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password/ID combination");
        }
    }
  }
  
  ?>