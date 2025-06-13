<?php include 'inc/header.php'; ?>


<?php
include 'inc/db.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM events WHERE id = $id");
$event = mysqli_fetch_assoc($result);

if (!$event) {
  die("Data tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = htmlspecialchars($_POST['title']);
  $desc = htmlspecialchars($_POST['description']);
  $location = htmlspecialchars($_POST['location']);
  $event_date = $_POST['event_date'];
  $old_image = $event['image'];

  // Handle upload jika ada file baru
  if ($_FILES['image']['name']) {
    $file = $_FILES['image'];
    $imageName = time() . '_' . basename($file['name']);
    $target = "../assets/img/" . $imageName;
    $fileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));

    // Validasi tipe file
    $allowed = ['jpg', 'jpeg', 'png'];
    if (in_array($fileType, $allowed)) {
      // Hapus gambar lama
      if (file_exists("../assets/img/$old_image")) {
        unlink("../assets/img/$old_image");
      }

      // Upload baru
      move_uploaded_file($file['tmp_name'], $target);
    } else {
      die("Hanya file JPG, JPEG, PNG yang diperbolehkan.");
    }
  } else {
    $imageName = $old_image; // pakai gambar lama
  }

  $query = "UPDATE events SET title='$title', description='$desc', location='$location', event_date='$event_date', image='$imageName' WHERE id=$id";
  mysqli_query($conn, $query);
  header("Location: event_list.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Event</title></head>
<body>
<h2>Edit Event</h2>
<form method="post" enctype="multipart/form-data">
  <label>Judul:</label><br>
  <input type="text" name="title" value="<?= $event['title'] ?>" required><br><br>

  <label>Deskripsi:</label><br>
  <textarea name="description" required><?= $event['description'] ?></textarea><br><br>

  <label>Lokasi:</label><br>
  <input type="text" name="location" value="<?= $event['location'] ?>" required><br><br>

  <label>Tanggal:</label><br>
  <input type="date" name="event_date" value="<?= $event['event_date'] ?>" required><br><br>

  <label>Gambar Saat Ini:</label><br>
  <img src="../assets/img/<?= $event['image']; ?>" width="150"><br><br>

  <label>Upload Gambar Baru:</label><br>
  <input type="file" name="image" accept=".jpg,.jpeg,.png"><br><br>

  <button type="submit">Simpan Perubahan</button>
</form>
</body>
</html>
<?php include 'inc/footer.php'; ?>
<p><a href="../event_detail.php?id=<?= $event['id']; ?>" target="_blank">Lihat Halaman Detail Publik</a></p>

