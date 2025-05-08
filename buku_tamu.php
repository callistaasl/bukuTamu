<?php
session_start();
require_once 'database.php'; 

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// Membaca data komentar dari database
$select_query = "SELECT name, comment, created_at FROM tamu ORDER BY created_at DESC";
$result = $conn->query($select_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-image: url('login.png');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }

        .container, .tamu-container, .comment-container {
            background: rgba(119, 152, 202, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 50%;
            margin: 20px auto;
        }

        .comment-container {
            color: #f3f3f3;
        }

        input, button, textarea {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            color: #435e8a;
            cursor: pointer;
        }

        button:hover {
            background-color: #3a4f73;
        }

        .navbar {
            background-color: #162860;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
        }

        .navbar a {
            color: #f3f3f3;
            text-decoration: none;
            margin-right: 15px;
        }

        .navbar-right {
            margin-left: auto;
        }

        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ffd9ea;
            color: #162860;
            text-decoration: none;
            border-radius: 5px;
        }

        .comment {
            margin-bottom: 20px;
            background: rgba(0, 0, 0, 0.2);
            padding: 15px;
            border-radius: 10px;
        }

        hr {
            margin: 20px 0;
            color: #f3f3f3;
        }

        h1, h2 {
            color: #f3f3f3;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        p, form {
            color: #f3f3f3;
            font-family: 'Lato', sans-serif;
        }

        #hasil {
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-center">
            <a href="dashboard.php">Home</a>
            <a href="buku_tamu.php">Buku Tamu</a>
        </div>
        <div class="navbar-right">
            <a href="logout.php" class="logout-btn" style="color: #162860">Logout</a>
        </div>
    </div>

    <div class="tamu-container">
        <h1>Buku Tamu</h1>
        <form id="formBukuTamu">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" rows="5" required></textarea>
            
            <input type="submit" value="Submit" style="background-color: #ffd9ea; color: #162860; border: none; cursor: pointer; padding: 10px; border-radius: 5px;">
        </form>
        <div id="hasil"></div>
    </div>

    <div class="comment-container">
        <h2>Daftar Pengunjung</h2>
        <hr>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<b>Pengirim:</b> " . htmlspecialchars($row['name']) . " (" . $row['created_at'] . ")<br>";
                echo "<b>Komentar:</b> " . htmlspecialchars($row['comment']);
                echo "</div><hr>";
            }
        } else {
            echo "<p>Belum ada komentar.</p>";
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#formBukuTamu').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'simpan_tamu.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#hasil').html(response);
                    $('#formBukuTamu')[0].reset();
                    setTimeout(() => location.reload(), 1000); // Reload untuk update komentar
                },
                error: function() {
                    $('#hasil').html('Terjadi kesalahan saat mengirim.');
                }
            });
        });
    </script>
</body>
</html>
