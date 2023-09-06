<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include('_dbconnect.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    $url = $_POST['url'];
    $url_arr = explode('?', $url);
    $urlArr = explode('&', $url);

    $query = $query = "SELECT * FROM `users` WHERE `email` = '$username'";
    $result = mysqli_query($conn, $query);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $row['name'];
                $_SESSION['userId'] = $row['user_id'];
                if (count($urlArr) > 1) {
                    header('location:' . $urlArr[0]);
                    exit;
                } else {
                    header('location:' . $url_arr[0]);
                    exit;
                }
            } else {
                if (count($url_arr) > 1) {
                    header('location:' . $url . '&wrongpassword=true');
                    exit;
                } else {
                    header('location:' . $url . '?wrongpassword=true');
                    exit;
                }
            }
        }
    } else {
        if (count($url_arr) > 1) {
            header('location:' . $url . '&wrongemail=true');
            exit;
        } else {
            header('location:' . $url . '?wrongemail=true');
            exit;
        }
    }
}
