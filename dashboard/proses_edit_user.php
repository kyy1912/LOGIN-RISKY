<?php
require_once '../users.php';
require_once '../database.php';

$username = $_POST['username'];
    $email = $_POST['email'];
    $asal = $_POST['asal'];
    $password = $_POST['password'];
    $id = $_POST['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $conn = $db->connect();
    $user = new User($conn);

    $user->update($id, $username, $email, $asal, $password);

    header("Location: index.php");
}