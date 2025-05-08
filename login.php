<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="weblogo-removebg-preview.png">
    <title>Login & Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background-image: url('login.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 30px;
            text-align: center;
        }

        .form-container {
            display: flex;
            flex-direction: column;
        }

        .toggle-btns {
            display: flex;
            margin-bottom: 20px;
        }

        .toggle-btn {
            flex: 1;
            padding: 10px;
            margin: 0 3px;
            background-color: #435e8a;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .toggle-btn.active {
            background-color: #3a4f73;
        }

        .toggle-btn:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .toggle-btn:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .form-content {
            display: none;
        }

        .form-content.active {
            display: block;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background: #435e8a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background: #3a4f73;
        }

        .error {
            background: #f9d0d0;
            border: 1px solid #f29595;
            color: #333;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }

        .success {
            background: #d0f9d0;
            border: 1px solid #95f295;
            color: #333;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 id="form-title" style="color: #f3f3f3; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 36px">Login</h2> <!--teks berubah saat login dan register-->
        <div class="toggle-btns">
            <button class="toggle-btn active" data-form="login">Login</button>
            <button class="toggle-btn" data-form="register">Register</button>
        </div>

        <?php
        session_start();
        
        if (isset($_SESSION['login_error'])) {
            echo "<div class='error'>" . $_SESSION['login_error'] . "</div>";
            unset($_SESSION['login_error']);
        }

        if (isset($_SESSION['register_success'])) {
            echo "<div class='success'>" . $_SESSION['register_success'] . "</div>"; // concat string
            unset($_SESSION['register_success']);
        }

        if (isset($_SESSION['register_error'])) {
            echo "<div class='error'>" . $_SESSION['register_error'] . "</div>";
            unset($_SESSION['register_error']);
        }
        ?>

        <div id="login-form" class="form-content active">
            <form action="action_login.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>

        <div id="register-form" class="form-content">
            <form action="action_login.php" method="post">
                <input type="text" name="username" placeholder="Choose Username" required>
                <input type="password" name="password" placeholder="Create Password" required>
                <button type="submit" name="register">Register</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtns = document.querySelectorAll('.toggle-btn');
            const formContents = document.querySelectorAll('.form-content');
            const formTitle = document.getElementById('form-title'); // Reference to the dynamic text element

            toggleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    toggleBtns.forEach(b => b.classList.remove('active'));
                    formContents.forEach(f => f.classList.remove('active'));

                    this.classList.add('active');
                    document.getElementById(`${this.dataset.form}-form`).classList.add('active');
                    formTitle.textContent = this.textContent; // Update the dynamic text
                });
            });
        });
    </script>
</body>
</html>