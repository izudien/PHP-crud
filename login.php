<?php
session_start();
require 'functions.php';
// check cokkie baaru session
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    // check cookie dan username
    // $key username yang hash
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}


// jika dah login..sent to home index
if (isset($_SESSION["login"])) {
    header("Location:index.php?page=home");
}


if (isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST['password'];

    // check username dalam database dulu
    //query 
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    // nilai true..check password
    if (mysqli_num_rows($result) === 1) {
        // check password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            // set session
            $_SESSION["login"] = true;

            // check remember me =cookie
            if (isset($_POST['remember'])) {
                // buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }
            header("Location:index.php?page=home");
            exit;
        }
    }

    $error = true;
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Login</title>
    <style type="text/css">
        .login-form {
            width: 340px;
            margin: 50px auto;
        }

        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }

        .form-control,
        .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <form action="" method="post">
            <h2 class="text-center">Log in</h2>
            <?php if (isset($error)) : ?>
                <p style="color:red;font-style:italic;">Username/password error</p>
            <?php endif; ?>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" id="username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="login">Log in</button>
            </div>
            <div class="clearfix">
                <label class="pull-left checkbox-inline"><input type="checkbox" name="remember" id="remember"> Remember me</label>
            </div>
        </form>
        <p class="text-center"><a href="register.php">Create an Account</a></p>
    </div>
</body>

</html>
</head>