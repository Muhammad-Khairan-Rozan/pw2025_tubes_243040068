<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Festival Kuliner</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Daftar Event Kuliner</h1>

    <form method="GET">
        <input type="text" name="search" placeholder="Cari event...">
        <button type="submit">Cari</button>
    </form>

    <div class="event-list">
        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM events WHERE title LIKE '%$search%' ORDER BY date ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="event-card">';
                echo '<img src="images/' . $row['image'] . '" width="250">';
                echo '<h2>' . $row['title'] . '</h2>';
                echo '<p><strong>Tanggal:</strong> ' . date("d M Y, H:i", strtotime($row['date'])) . '</p>';
                echo '<p>' . substr($row['description'], 0, 100) . '...</p>';
                echo '<a href="event.php?id=' . $row['id'] . '">Lihat Detail</a>';
                echo '</div>';
            }
        } else {
            echo "<p>Tidak ada event ditemukan.</p>";
        }
        ?>
    </div>
</body>
</html>
