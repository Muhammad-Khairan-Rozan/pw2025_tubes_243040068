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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #fff6e9, rgb(235, 219, 196));
      margin: 0;
      padding: 20px;
      color: #4a3b27;
    }

    h1 {
      font-size: 2.8em;
      color: #d8740c;
      margin-bottom: 5px;
    }

    p {
      font-size: 1.1em;
      margin-bottom: 20px;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .login-btn {
      padding: 10px 18px;
      background-color: #d8740c;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    .login-btn:hover {
      background-color: #a95905;
    }

    #search {
      padding: 12px;
      width: 100%;
      max-width: 400px;
      border: 2px solid #f4a825;
      border-radius: 8px;
      font-size: 16px;
      margin-bottom: 30px;
    }

    .event-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
    }

    .event-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      transition: transform 0.2s ease;
      border: 1px solid #fce3ba;
    }

    .event-card:hover {
      transform: translateY(-5px);
    }

    .event-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .content {
      padding: 15px;
    }

    .content h3 {
      margin-top: 0;
      font-size: 18px;
      color: #d8740c;
    }

    .event-card a {
      display: inline-block;
      margin-top: 12px;
      padding: 8px 14px;
      background: #f4a825;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      transition: background-color 0.3s ease;
    }

    .event-card a:hover {
      background: #d7890e;
    }

    .hero,
    .hero2 {
      width: 100%;
      height: 100vh;
      background: linear-gradient(to right, #fff6e9, rgb(223, 152, 53));
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      padding: 40px 20px;
      text-align: center;
    }

    .hero-content,
    .hero-content2 {
      max-width: 800px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }

    .hero-text h1 {
      font-size: 3.5em;
      color: #d8740c;
      margin: 0;
    }

    .hero-text p {
      font-size: 1.2em;
      color: #5a4c3f;
      margin-top: 10px;
    }

    .hero2 {
      background: #fff6e9;
      border-bottom-right-radius: 200px;
    }

    .hero-content2 {
      background: #fff6e9;
    }

    .login-btn {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #d97e00;
      color: white;
      padding: 10px 16px;
      border-top-left-radius: 70px;
      border-bottom-right-radius: 70px;
      text-decoration: none;
      font-weight: bold;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      transition: background-color 0.3s;
    }

    .login-btn:hover {
      background-color: #a95905;
    }

    .main-content {
      padding: 40px 20px;
      max-width: 1200px;
      margin: auto;
    }

    .gallery {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
      /* Supaya responsif saat layar kecil */
      margin-top: 30px;
    }

    .gallery img {
      width: 200px;
      height: auto;
      border-radius: 10px;
      object-fit: cover;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .gallery img:hover {
      transform: scale(1.05);
    }
  </style>
</head>


<body>
  <section class="hero">
    <div class="hero-content">
      <div class="hero-text">
        <h1>Festival Kuliner Nusantara</h1>
        <h2>Nikmati berbagai macam makanan khas Nusantara dari berbagai daerah!</h2>
      </div>
      <a href="admin/login.php" class="login-btn">Login Admin</a>
    </div>
    <div class="gallery">
      <img src="assets/img/39588-festival-jajanan-minang-2019-suaracomrisna.jpg" alt="Gambar 1">
      <img src="assets/img/68492bed288db.jpg" alt="Gambar 2">
      <img src="assets/img/1749723903_1395849458p.jpg" alt="Gambar 3">
      <img src="assets/img/festival-sate-matang-aceh-jjl2-dom.webp" alt="Gambar 4">
    </div>

  </section>

  <section class="hero2">
    <div class="hero-content2">
      <div class="hero-text2">
        <h3>Festival Kuliner Nusantara 2025 hadir kembali dengan skala yang lebih besar, lebih meriah, dan lebih menggugah selera! Diselenggarakan di jantung kota Bandung selama tiga hari penuh, festival ini mempersembahkan lebih dari 100 booth makanan dari seluruh penjuru Indonesia dan mancanegara.
          Mulai dari cita rasa pedas khas Padang, kelembutan gudeg Yogyakarta, hingga kelezatan nasi Mandhi dari Timur Tengah – semua bisa Anda nikmati hanya dalam satu tempat. Tahun ini, kami juga menghadirkan berbagai zona kuliner internasional, termasuk masakan Jepang, Korea, India, Arab, dan Western food yang pastinya menambah keragaman rasa.
        </h3>
      </div>
    </div>
  </section>

  <main class="main-content">
    <input type="text" id="search" placeholder="Cari acara...">


    <!-- Hasil pencarian tampil di sini -->
    <div id="result" class="event-grid">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        function loadData(query = '') {
          $.ajax({
            url: "search_ajax.php",
            method: "POST",
            data: {
              query: query
            },
            success: function(data) {
              $('#result').html(data);
            }
          });
        }

        $('#search').on('keyup', function() {
          let searchTerm = $(this).val();
          loadData(searchTerm);
        });
      });
    </script>

</body>

</html>