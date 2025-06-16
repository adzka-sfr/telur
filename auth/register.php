<?php
include "../config.php";

// get data post
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $token = $_POST['token'];

    // validate token
    if($token_key !== $token) {
        echo "invalid-token";
        exit;
    }

    // check if username already exists
    $checkUser = mysqli_query($conn, "SELECT * FROM t_user WHERE c_name='$username'");
    if (mysqli_num_rows($checkUser) > 0) {
        echo "username-exists";
    } else {
        // insert new user
        $insertUser = mysqli_query($conn, "INSERT INTO t_user (c_name, c_password, c_register) VALUES ('$username', '$password', '$now')");
        if ($insertUser) {
            echo "success";
        } else {
            echo "registration-failed";
        }
    }
} else {
    echo "Invalid request!";
}
