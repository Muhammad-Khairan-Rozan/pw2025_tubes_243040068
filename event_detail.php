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

if (isset($_POST['submit_rsvp'])) {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);

  $stmt = $conn->prepare("INSERT INTO rsvps (event_id, name, email, rsvp_date) VALUES (?, ?, ?, CURDATE())");
  $stmt->bind_param("iss", $id, $name, $email);
  $stmt->execute();

  echo "<script>alert('Terima kasih sudah RSVP!');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($event['title']) ?></title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #fff7e6, #fcd8a9);
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      width: 100%;
      max-width: 800px;
      margin-top: 40px;
      padding: 30px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .container img {
      width: 100%;
      max-height: 400px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    h1 {
      text-align: center;
      color: #d97e00;
      margin-bottom: 20px;
    }

    .detail {
      margin-bottom: 30px;
    }

    .detail strong {
      display: inline-block;
      width: 80px;
    }

    .rsvp-box {
      padding: 20px;
      background: #f9f9f9;
      border-radius: 10px;
    }

    .rsvp-box h2 {
      margin-top: 0;
      color: #d97e00;
    }

    .rsvp-box label {
      display: block;
      margin-top: 12px;
      font-weight: 600;
    }

    .rsvp-box input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    .rsvp-box button {
      margin-top: 20px;
      width: 100%;
      background: #d97e00;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .rsvp-box button:hover {
      background: #b66600;
    }

    .back-link {
      display: inline-block;
      margin-top: 20px;
      text-align: center;
      text-decoration: none;
      color: #555;
      font-size: 14px;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1><?= htmlspecialchars($event['title']) ?></h1>
    <img src="assets/img/<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>">
    
    <div class="detail">
      <p><strong>Lokasi:</strong> <?= htmlspecialchars($event['location']) ?></p>
      <p><strong>Tanggal:</strong> <?= htmlspecialchars(date('d M Y', strtotime($event['event_date']))) ?></p>
      <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
    </div>

    <div class="rsvp-box">
      <h2>Form RSVP</h2>
      <form method="POST">
        <label>Nama:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <button type="submit" name="submit_rsvp">Kirim RSVP</button>
      </form>
    </div>

    <a class="back-link" href="index.php">&larr; Kembali ke daftar event</a>
  </div>

</body>
</html>
