<?php include 'inc/header.php'; ?>
<?php include 'inc/db.php'; ?>

<?php
$result = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Daftar Event</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Daftar Event</h2>
      <div>
        <a href="rsvp_list.php" class="btn btn-primary me-2">📋 Lihat Daftar RSVP</a>
        <a href="event_add.php" class="btn btn-success">+ Tambah Event</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Gambar</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; while($row = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?= $i++; ?></td>
            <td><?= htmlspecialchars($row['title']); ?></td>
            <td><?= date('d M Y', strtotime($row['event_date'])); ?></td>
            <td><?= htmlspecialchars($row['location']); ?></td>
            <td><img src="../assets/img/<?= $row['image']; ?>" width="100" class="img-thumbnail"></td>
            <td class="text-center">
              <a href="event_edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="event_delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus event ini?')">Hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include 'inc/footer.php'; ?>
