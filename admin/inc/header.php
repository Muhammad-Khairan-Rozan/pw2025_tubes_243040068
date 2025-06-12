<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <style>
    .admin-header {
      background-color: #f3f3f3;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-family: sans-serif;
    }
    .admin-header a {
      text-decoration: none;
      color: #007BFF;
    }
  </style>
</head>
<body>
  <div class="admin-header">
    <div><strong>Dashboard Admin</strong></div>
    <div>
      Halo, <strong><?= htmlspecialchars($_SESSION['admin']) ?></strong> 👋 | 
      <a href="logout.php">Logout</a>
    </div>
  </div>
  <hr>
