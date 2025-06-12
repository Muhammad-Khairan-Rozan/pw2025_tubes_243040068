<?php
require 'admin/inc/db.php';

if (!isset($_GET['id'])) {
  echo "ID tidak ditemukan.";
  exit;
}

$id = (int) $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM events WHERE id = $id");
$event = mysqli_fetch_assoc($query);

if (!$event) {
  echo "Event tidak ditemukan.";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($event['title']) ?></title>
</head>
<body>
  <h1><?= htmlspecialchars($event['title']) ?></h1>
  <img src="assets/img/<?= htmlspecialchars($event['image']) ?>" width="300"><br>
  <strong>Lokasi:</strong> <?= htmlspecialchars($event['location']) ?><br>
  <strong>Tanggal:</strong> <?= htmlspecialchars(date('d M Y', strtotime($event['date']))) ?><br>
  <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
  <a href="index.php">Kembali</a>
</body>
</html>
