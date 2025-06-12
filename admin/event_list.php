<?php include 'inc/header.php'; ?>


<?php
include 'inc/db.php';

$result = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin - Daftar Event</title>
  <style>
    table { border-collapse: collapse; width: 100%; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; }
    th { background: #f5f5f5; }
    a { text-decoration: none; padding: 5px 10px; margin: 0 5px; border-radius: 4px; }
    .edit { background: #ffc107; color: black; }
    .delete { background: #dc3545; color: white; }
    .add { background: #28a745; color: white; float: right; margin-bottom: 10px; }
  </style>
</head>
<body>
  <h2>Daftar Event (Admin)</h2>
  <a href="event_add.php" class="add">+ Tambah Event</a>
  <table>
    <tr>
      <th>No</th>
      <th>Judul</th>
      <th>Tanggal</th>
      <th>Lokasi</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>
    <?php $i = 1; while($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
      <td><?= $i++; ?></td>
      <td><?= htmlspecialchars($row['title']); ?></td>
      <td><?= $row['event_date']; ?></td>
      <td><?= htmlspecialchars($row['location']); ?></td>
      <td><img src="../assets/img/<?= $row['image']; ?>" width="100"></td>
      <td>
        <a class="edit" href="event_edit.php?id=<?= $row['id']; ?>">Edit</a>
        <a class="delete" href="event_delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
<?php include 'inc/footer.php'; ?>

