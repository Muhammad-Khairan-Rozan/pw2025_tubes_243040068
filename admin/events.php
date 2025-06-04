<?php
include 'koneksi.php';

// Proses tambah event jika form disubmit
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $image = ''; // untuk sementara kosong, nanti bisa upload gambar

    $sql = "INSERT INTO events (title, description, date, location, image, created_by) VALUES (?, ?, ?, ?, ?, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $title, $description, $date, $location, $image);
    $stmt->execute();
    header("Location: events.php");
    exit();
}

// Proses hapus event
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM events WHERE id = $id");
    header("Location: events.php");
    exit();
}

// Ambil data event dari database
$result = $conn->query("SELECT * FROM events ORDER BY date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Events</title>
</head>
<body>
    <h1>Daftar Event</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th><th>Title</th><th>Date</th><th>Location</th><th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['title']); ?></td>
            <td><?= $row['date']; ?></td>
            <td><?= htmlspecialchars($row['location']); ?></td>
            <td>
                <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus event ini?')">Delete</a>
                <!-- nanti bisa tambah edit -->
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Tambah Event Baru</h2>
    <form method="POST" action="">
        <label>Title:<br><input type="text" name="title" required></label><br>
        <label>Description:<br><textarea name="description" required></textarea></label><br>
        <label>Date:<br><input type="datetime-local" name="date" required></label><br>
        <label>Location:<br><input type="text" name="location" required></label><br>
        <button type="submit" name="submit">Tambah Event</button>
    </form>
</body>
</html>
