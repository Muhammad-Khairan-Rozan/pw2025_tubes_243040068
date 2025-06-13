<?php include 'inc/header.php'; ?>


<?php
include 'inc/db.php';

$id = $_GET['id'];


$result = mysqli_query($conn, "SELECT image FROM events WHERE id=$id");
$data = mysqli_fetch_assoc($result);
if ($data) {
  $file = "../assets/img/" . $data['image'];
  if (file_exists($file)) {
    unlink($file); // hapus file gambar
  }

  mysqli_query($conn, "DELETE FROM events WHERE id=$id");
}

header("Location: event_list.php");
exit;
?>
<?php include 'inc/footer.php'; ?>

