<?php include 'inc/header.php'; ?>

<?php
include 'inc/db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = htmlspecialchars($_POST['title']);
  $desc = htmlspecialchars($_POST['description']);
  $location = htmlspecialchars($_POST['location']);
  $event_date = $_POST['event_date'];

  // Proses upload gambar
  $allowed_ext = ['jpg', 'jpeg', 'png'];
  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];
  $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

  if (!in_array($ext, $allowed_ext)) {
    $error = "Format gambar tidak valid. Gunakan .jpg, .jpeg, atau .png";
  } else {
    $newname = uniqid() . '.' . $ext;
    $target = "../assets/img/" . $newname;

    if (move_uploaded_file($tmp, $target)) {
      // Simpan ke database
      $query = "INSERT INTO events (title, description, location, event_date, image)
                VALUES ('$title', '$desc', '$location', '$event_date', '$newname')";
      if (mysqli_query($conn, $query)) {
        $success = "Event berhasil ditambahkan!";
      } else {
        $error = "Gagal menyimpan ke database.";
      }
    } else {
      $error = "Gagal upload gambar.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Event</title>
  <style>
    body { font-family: Arial; padding: 20px; background: #f4f4f4; }
    form { background: white; padding: 20px; max-width: 500px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
    input, textarea { width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 4px; border: 1px solid #ccc; }
    button { padding: 10px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    .msg { margin-bottom: 15px; padding: 10px; border-radius: 4px; }
    .error { background: #fdd; border: 1px solid #f99; }
    .success { background: #dfd; border: 1px solid #9f9; }
  </style>
</head>
<body>

<h2>Tambah Event Baru</h2>

<?php if ($error): ?>
  <div class="msg error"><?= $error ?></div>
<?php elseif ($success): ?>
  <div class="msg success"><?= $success ?></div>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data">
  <label>Judul Event:</label>
  <input type="text" name="title" required>

  <label>Deskripsi:</label>
  <textarea name="description" rows="4" required></textarea>

  <label>Lokasi:</label>
  <input type="text" name="location" required>

  <label>Tanggal Acara:</label>
  <input type="date" name="event_date" required>

  <label>Upload Gambar (.jpg, .jpeg, .png):</label>
  <input type="file" name="image" accept=".jpg,.jpeg,.png" required>

  <button type="submit">Tambah Event</button>
</form>

</body>
</html>
<?php include 'inc/footer.php'; ?>

