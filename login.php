<?php

session_start();
require 'config.php';

$value_username = "";
$value_password = "";

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $value_username = $_POST["username"];
    $value_password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");

    if (mysqli_num_rows($result) === 1) {
        $result1 = mysqli_fetch_assoc($result);
        $nama = $result1["nama_admin"];
        $id_admin = $result1["id_admin"];
        $_SESSION["id_admin"] = $id_admin;
        $value_username = "";
        $value_password = "";
        echo "<script>alert('Selamat datang $nama!');
          window.location.href = 'index.php';
          </script>";
        exit;
    } else {
        echo "<script>alert('username atau password salah!');
          </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Gill Sans', 'Gill Sans MT',
                Calibri, 'Trebuchet MS', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #c8c8c8;
        }

        .container {
            width: 100%;
            display: flex;
            max-width: 420px;
            background: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .login {
            width: 400px;
        }

        form {
            width: 250px;
            margin: 60px auto;
        }

        h1 {
            margin: 20px;
            text-align: center;
            font-weight: bolder;
            text-transform: uppercase;
        }

        hr {
            border-top: 2px solid #ffa12c;
        }

        p {
            text-align: center;
            margin: 10px;
        }

        form label {
            display: block;
            font-size: 16px;
            font-weight: 600;
            padding: 5px;
        }

        input {
            width: 100%;
            margin: 2px;
            border: none;
            outline: none;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid gray;
        }

        button {
            border: none;
            outline: none;
            padding: 8px;
            width: 252px;
            color: #FFFFFF;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            border-radius: 5px;
            background: #00f;
        }

        button:hover {
            background: rgba(214, 86, 64, 1);
        }

        @media (max-width: 880px) {
            .container {
                width: 100%;
                max-width: 750px;
                margin-left: 20px;
                margin-right: 20px;
            }

            form {
                width: 300px;
                margin: 20px auto;
            }

            .login {
                width: 400px;
                padding: 20px;
            }

            button {
                width: 100%;
            }

            .right img {
                width: 100%;
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login">
            <form action="" method="post">
                <h1>Login</h1>
                <form action="index.html" method="post">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" placeholder="username" name="username" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" placeholder="Password" name="password" required>

                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Login</button>
                </form>
                <p>
                    <a href="#">Forgot Password?</a>
                </p>
        </div>
</body>

</html>