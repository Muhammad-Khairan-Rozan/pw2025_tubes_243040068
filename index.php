<?php
include 'admin/inc/db.php';

// Ambil semua event dari database
$query = "SELECT * FROM events ORDER BY event_date ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Festival Kuliner Nusantara</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 20px;
    }
    .event-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .event-card {
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      overflow: hidden;
      width: 300px;
    }
    .event-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }
    .event-card .content {
      padding: 15px;
    }
    .event-card h3 {
      margin-top: 0;
    }
    .event-card a {
      display: inline-block;
      margin-top: 10px;
      padding: 8px 12px;
      background: #009578;
      color: white;
      text-decoration: none;
      border-radius: 4px;
    }
    .event-card a:hover {
      background: #007f66;
    }
  </style>
</head>
<body>

  <h1>Festival Kuliner Nusantara</h1>
  <p>Selamat datang! Temukan acara kuliner terbaik dari seluruh Nusantara.</p>

  <div class="event-grid">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
      <div class="event-card">
        <img src="assets/img/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
        <div class="content">
          <h3><?= htmlspecialchars($row['title']) ?></h3>
          <p><strong>Lokasi:</strong> <?= htmlspecialchars($row['location']) ?></p>
          <p><strong>Tanggal:</strong> <?= date("d M Y", strtotime($row['event_date'])) ?></p>
          <a href="event_detail.php?id=<?= $row['id']; ?>" class="btn btn-success">Lihat Detail</a>

        </div>
      </div>
    <?php endwhile; ?>
  </div>

</body>
</html>
