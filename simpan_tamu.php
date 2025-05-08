<?php
session_start();
require_once 'database.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "Anda belum login.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['name']) && !empty($_POST['comment'])) {
    $name = htmlspecialchars($_POST['name']);
    $comment = htmlspecialchars($_POST['comment']);

    $insert_query = "INSERT INTO tamu (name, comment) VALUES (?, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("ss", $name, $comment);
    
    if ($insert_stmt->execute()) {
        echo "Komentar berhasil dikirim!";
    } else {
        echo "Gagal menyimpan komentar: " . $conn->error;
    }
    $insert_stmt->close();
} else {
    echo "Data tidak lengkap.";
}
?>
