<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include('_dbconnect.php');

    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];

    $query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
        header('location: .././index.php?emailexist=true');
        exit;
    } else {
        if ($pass == $cpass) {
            $hashpass = password_hash($pass, PASSWORD_DEFAULT);
            $query = "INSERT INTO `users`(`name`, `email`, `password`, `date_time`) VALUES ('$name', '$email', '$hashpass', current_timestamp())";
            $result = mysqli_query($conn, $query);
            if ($result) {
                header('location: .././index.php?signup=success');
                exit;
            } else {
                header('location: .././index.php?error=true');
                exit;
            }
        } else {
            header('location: .././index.php?passwordmatch=false');
            exit;
        }
    }
}
