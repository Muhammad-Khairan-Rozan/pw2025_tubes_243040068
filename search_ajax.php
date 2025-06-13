<?php
require 'admin/inc/db.php';

$output = '';
$search = '';

// Cek apakah ada input pencarian
if (isset($_POST['query'])) {
  $search = mysqli_real_escape_string($conn, $_POST['query']);
}

if ($search !== '') {
  // Jika ada input, cari berdasarkan title atau lokasi
  $query = "SELECT * FROM events WHERE title LIKE '%$search%' OR location LIKE '%$search%' ORDER BY event_date ASC";
} else {
  // Jika input kosong, ambil semua data
  $query = "SELECT * FROM events ORDER BY event_date ASC";
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  while ($event = mysqli_fetch_assoc($result)) {
    $output .= '
      <div class="event-card">
        <img src="assets/img/' . htmlspecialchars($event['image']) . '" alt="' . htmlspecialchars($event['title']) . '">
        <div class="content">
          <h3>' . htmlspecialchars($event['title']) . '</h3>
          <p><strong>Lokasi:</strong> ' . htmlspecialchars($event['location']) . '</p>
          <p><strong>Tanggal:</strong> ' . date("d M Y", strtotime($event['event_date'])) . '</p>
          <a href="event_detail.php?id=' . $event['id'] . '" class="btn btn-success">Lihat Detail</a>
        </div>
      </div>
    ';
  }
} else {
  $output = '<p>Event tidak ditemukan.</p>';
}

echo $output;
?>
