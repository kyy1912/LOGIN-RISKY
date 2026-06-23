<?php
class User
{
    private $conn;
    private $table = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // CREATE
    public function create($username, $email, $asal, $password)
    {
        $sql = "INSERT INTO $this->table (username, email, asal, password) 
                VALUES ('$username', '$email', '$asal', '$password')";

        try {
            $this->conn->query($sql);
            return true;
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    // LOGIN
    public function login($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return true;
        }

        return false;
    }

    public function incrementLoginCount($username) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET login_count = COALESCE(login_count, 0) + 1 WHERE username = ?");
        $stmt->bind_param("s", $username);
        return $stmt->execute();
    }

    public function getLoginCount($username) {
        $stmt = $this->conn->prepare("SELECT login_count FROM $this->table WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['login_count'];
        }
        return 0;
    }

    // GET ALL USERS
    public function getAllUsers()
    {
        $sql = "SELECT * FROM $this->table";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function hapus($id){
        $sql = "DELETE FROM $this->table WHERE id = " . $id;
        $result = $this->conn->query($sql);

        return $result;

    }

    public function ambilUserdariId($id){
        $sql = "SELECT * FROM $this->table WHERE id = " . $id;
        $result = $this->conn->query($sql);
        return $result -> fetch_assoc();
    }
    
    public function update($id, $username, $email, $asal, $password){
        $sql = "UPDATE $this->table SET 
        USERNAME = '$username', EMAIL = '$email', ASAL = '$asal', PASSWORD = '$password' WHERE ID = " . $id;
        $result = $this->conn->query($sql);
        return $result;
    }

}