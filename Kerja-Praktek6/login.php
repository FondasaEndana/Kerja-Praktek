<?php
session_start();
require "koneksi.php";

if (isset($_POST['loginbtn'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM login WHERE username='$username'");
    $countdata = mysqli_num_rows($query);
    $data = mysqli_fetch_array($query);

    if ($countdata > 0) {
        if (password_verify($password, $data['password'])) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['login'] = true;
            header('location: index.php');
            exit();
        } else {
            $error = "Password Salah!!";
        }
    } else {
        $error = "Akun tidak tersedia";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>

<style>
    body {
        background: linear-gradient(to right, #0062E6, #33AEFF);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: 'Arial', sans-serif;
    }

    .login-box {
        width: 400px;
        padding: 30px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .login-box h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    .login-box .form-control {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 5px;
    }

    .login-box .btn {
        background: #0062E6;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .login-box .btn:hover {
        background: #004bb5;
    }

    .google-btn {
        background-color: #DB4437;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .google-btn:hover {
        background-color: #c33d2e;
    }

    .google-btn i {
        margin-right: 10px;
    }

    .alert {
        margin-top: 20px;
    }

    .register-link {
        margin-top: 20px;
    }

    .register-link a {
        color: #0062E6;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .register-link a:hover {
        color: #004bb5;
    }
</style>

<body>
    <div class="login-box">
        <h2>Login</h2>
        <form action="" method="post">
            <div>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            </div>
            <div>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div>
                <button class="btn form-control mt-3" type="submit" name="loginbtn">Login</button>
            </div>
        </form>
        <div class="mt-3">
            <button id="google-login-btn" class="google-btn">
                <i class="fab fa-google"></i> Login with Google
            </button>
        </div>
        <div class="mt-3">
            <?php
            if (isset($error)) {
                echo "<div class='alert alert-warning' role='alert'>$error</div>";
            }
            ?>
        </div>
        <div class="register-link">
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>

    <!-- Firebase JavaScript SDK -->
    <script src="https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.1/firebase-auth.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <!-- Skrip JavaScript Anda -->
    <script type="module">
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js";
        import {
            getAuth,
            GoogleAuthProvider,
            signInWithPopup
        } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-auth.js";

        const firebaseConfig = {
            apiKey: "AIzaSyCE_K6WI-4X8UlarqrmklP_47Rep0DQU2o",
            authDomain: "satniksolutions-63a3e.firebaseapp.com",
            databaseURL: "https://satniksolutions-63a3e-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "satniksolutions-63a3e",
            storageBucket: "satniksolutions-63a3e.appspot.com",
            messagingSenderId: "874710006761",
            appId: "1:874710006761:web:8b003dae3dfa26e0be6978",
            measurementId: "G-G2NY25MLM9"
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        function loginWithGoogle() {
            const provider = new GoogleAuthProvider();
            signInWithPopup(auth, provider)
                .then((result) => {
                    const user = result.user;
                    console.log(user);

                    fetch('store_session.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                user: user
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Session stored:', data);
                            window.location.href = 'index.php';
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                })
                .catch((error) => {
                    console.log(error);
                });
        }

        document.getElementById('google-login-btn').addEventListener('click', loginWithGoogle);
    </script>
</body>

</html>
