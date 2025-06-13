<?php
require 'inc/db.php'; 


$query = "SELECT rsvps.*, events.title 
          FROM rsvps 
          JOIN events ON rsvps.event_id = events.id 
          ORDER BY rsvp_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Daftar RSVP</title>
</head>
<body>
  <h1>Daftar RSVP</h1>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Acara</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Tanggal RSVP</th>
    </tr>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) :
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['title']) ?></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= date('d M Y', strtotime($row['rsvp_date'])) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
