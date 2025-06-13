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
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right, #fff7e6, #fcd8a9);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .login-box {
    background: #fff;
    padding: 50px 40px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 420px;
    text-align: center;
  }

  .login-box h2 {
    margin-bottom: 25px;
    color: #d97e00;
    font-size: 24px;
  }

  .login-box input[type="text"],
  .login-box input[type="password"] {
    width: 100%;
    padding: 14px;
    margin-bottom: 18px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    box-sizing: border-box;
  }

  .login-box button {
    width: 100%;
    padding: 14px;
    background-color: #d97e00;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
  }

  .login-box button:hover {
    background-color: #b96600;
  }

  .error-message {
    color: red;
    margin-bottom: 15px;
    font-size: 14px;
  }

  .back-link {
    display: inline-block;
    margin-top: 18px;
    font-size: 14px;
    color: #555;
    text-decoration: none;
  }

  .back-link:hover {
    text-decoration: underline;
  }
</style>

</head>
<body>

  <div class="login-box">
    <h2>Login Admin</h2>

    <?php if ($error): ?>
      <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <a href="../index.php" class="back-link">← Kembali ke halaman utama</a>
  </div>

</body>
</html>
