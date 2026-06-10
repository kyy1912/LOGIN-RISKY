<?php
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/users.php";

$username = $_POST['username'] ?? "";
$email = $_POST['email'] ?? "";
$asal = $_POST['asal'] ?? "";
$password = $_POST['password'] ?? "";
$password_ulang = $_POST['password_ulang'] ?? "";

if(isset($_POST['setuju'])){
    // Cek apakah password dan password ulang sama
    if ($password !== "" && $password === $password_ulang) {
        $db = new Database();
        $conn = $db->connect();
        
        $user = new User($conn);
        // Memanggil fungsi create untuk menyimpan ke database
        $user->create($username, $email, $asal, $password);
        
        echo "<br><a href='index.php'>Login di sini</a>";
    } else {
        echo "Password tidak boleh kosong dan harus sama dengan Password Ulang!";
        echo "<br><a href='signup.html'>Kembali</a>";
    }
} else {
    echo "Anda harus menyetujui form (centang 'Saya Setuju')";
    echo "<br><a href='signup.html'>Kembali</a>";
}
