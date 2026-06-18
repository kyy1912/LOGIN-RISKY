<?php
include '../users.php';
include '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $conn = $db->connect();
    $user = new User($conn);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $asal = $_POST['asal'];
    $password = $_POST['password'];

    $user->create($username, $email, $asal, $password);

    header("Location: index.php?halaman=daftar_user.php");
    exit;
}
?>
