<?php 

require 'functions.php';

if (isset($_POST["register"])) {

    // function register
    if (register($_POST) > 0) {
        echo "<script>
        alert('User has Register');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
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

    <title>Register new user</title>
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
            <h2 class="text-center">Register New User</h2>
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
                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirm" id="password_confirm">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="register">Created</button>
            </div>
        </form>
        <p class="text-center"><a href="login.php">Login</a></p>
    </div>
</body>

</html>
</head>
















