<?php 
include 'koneksi.php';
$id = $_GET['id'];
$sql = "SELECT * FROM events WHERE id = $id";
$result = $conn->query($sql);
$event = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $event['title'] ?></title>
</head>
<body>
    <h1><?= $event['title'] ?></h1>
    <img src="images/<?= $event['image'] ?>" width="400"><br>
    <p><strong>Tanggal:</strong> <?= date("d M Y, H:i", strtotime($event['date'])) ?></p>
    <p><strong>Lokasi:</strong> <?= $event['location'] ?></p>
    <p><?= $event['description'] ?></p>
    <a href="index.php">← Kembali</a>
</body>
</html>
