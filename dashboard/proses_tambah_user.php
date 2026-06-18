<?php
require_once '../users.php';
require_once '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $asal = $_POST['asal'];
    $password = $_POST['password'];

    $db = new Database();
    $conn = $db->connect();
    $user = new User($conn);

    try {
        $user->create($username, $email, $asal, $password);
        header("Location: index.php");
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo "<script>alert('Gagal: Email sudah terdaftar!'); window.history.back();</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan database!'); window.history.back();</script>";
        }
    }
}
?>
