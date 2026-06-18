<?php
require_once '../users.php';
require_once '../database.php';

    $db = new Database();
    $conn = $db->connect();
    $user = new User($conn);

    $id = $_GET['id'];
    $user_Data = $user->ambilUserdariId($id);

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <h1 class="mt-4">Edit User</h1>
          <hr />
          <div class="table-responsive small">
            <form action="proses_edit_user.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input value="<?php echo $user_Data['USERNAME']; ?>" type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="<?php echo $user_Data['EMAIL']; ?>" type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="asal" class="form-label">Asal</label>
                    <input value="<?php echo $user_Data['ASAL']; ?>" type="text" class="form-control" id="asal" name="asal" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input value="<?php echo $user_Data['PASSWORD']; ?>" type="password" class="form-control" id="password" name="password" required>
                </div>
                <input type="hidden" name="id" value="<?php echo $user_Data['ID']; ?>">
                <button type="submit" class="btn btn-primary">Edit User</button>
            </form>
          </div>
        </main>