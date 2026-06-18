<?php
require_once '../users.php';
require_once '../database.php';

$db = new Database();
$conn = $db->connect();
$user = new User($conn);

$result = $user->getAllUsers();
$daftar_user = [];
if ($result) {
    $daftar_user = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <h1 class= "mt-4"> Daftar User </h1>
          
          <hr />
          <a href="index.php?halaman=tambah_user_form.php" class="btn btn-sm btn-primary mb-3">Tambah User</a>
          <div class="table-responsive small">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Asal</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($daftar_user as $row) {
                  ?>
                <tr>
                  <td><?php echo $row['ID']; ?></td>
                  <td><?php echo $row['USERNAME']; ?></td>
                  <td><?php echo $row['EMAIL']; ?></td>
                  <td><?php echo $row['ASAL']; ?></td>
                  <td>
                    <a href="delete_user.php?id=<?php echo $row['ID']; ?>">delete</a> 
                    <a href="index.php?halaman=edit_user_form.php&id=<?php echo $row['ID']; ?>">edit</a>
                  </td>
                </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </main>