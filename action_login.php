<?php
session_start();

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["register"])) {
        $username = trim($_POST["username"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        if (!empty($username) && !empty($_POST["password"])) {
            
            $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $_SESSION['register_error'] = "Username sudah digunakan!";
            } else {
                // Simpan user baru ke database
                $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $username, $password);
                if ($stmt->execute()) {
                    $_SESSION['register_success'] = "Registrasi berhasil! Silakan login.";
                } else {
                    $_SESSION['register_error'] = "Gagal menyimpan data pengguna.";
                }
            }
            $stmt->close();
            header("Location: login.php");
            exit;
        } else {
            $_SESSION['register_error'] = "Username dan password tidak boleh kosong!";
            header("Location: login.php");
            exit;
        }
    } elseif (isset($_POST["login"])) {
        $username = trim($_POST["username"]);
        $password = ($_POST['password']);

        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $_SESSION["username"] = $username;
                $_SESSION["login"] = true;
                header("Location: dashboard.php");
                exit;
            }
        }
        $_SESSION['login_error'] = "Username atau password salah!";
        header("Location: login.php");
        exit;
    }
}
?>
