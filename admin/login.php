<?php
session_start();
include 'inc/db.php';

if (isset($_SESSION['admin'])) {
  header("Location: event_list.php");
  exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM admins WHERE username = '$username'");
  $admin = mysqli_fetch_assoc($query);

  if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['admin'] = $admin['username'];
    header("Location: event_list.php");
    exit;
  } else {
    $error = "Username atau password salah!";
  }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login Admin</title></head>
<body>
<h2>Login Admin</h2>
<?php if ($error): ?><p style="color:red"><?= $error ?></p><?php endif; ?>
<form method="post">
  <label>Username:</label><br>
  <input type="text" name="username" required><br><br>

  <label>Password:</label><br>
  <input type="password" name="password" required><br><br>

  <button type="submit">Login</button>
</form>
</body>
</html>
