<?php
session_start();
include 'koneksi/db.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: dashboard.php");
        exit();
} else {
    echo "<script>
            alert('Login gagal. Username atau password salah.');
            window.location.href = 'index.php'; // Ganti jika nama form login kamu berbeda
        </script>";
        exit();
    }
}else {
    header("Location: index.php");
    exit();
}
?>