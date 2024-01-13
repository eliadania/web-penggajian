<?php
    require 'conn.php';
    
    $id_divisi = $_GET['id_divisi'];

    $rekapGaji = "SELECT * FROM rekapitulasi_gaji as r
    JOIN master_personil as p ON r.id_personil = p.id_personil
    JOIN master_divisi as d ON d.id_divisi = r.id_divisi
    WHERE r.id_divisi = $id_divisi";
    $resultGaji = mysqli_query($conn, $rekapGaji);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lihat Detail Gaji</title>
</head>
<body>
    <div class="main-card">
        <button type="submit"><a href="index.php">Kembali</a></button>
        <div class="card-header">
            <div class="card-title">Lihat Detail Gaji</div>
        </div>
        <div id="card-content">
            <table>
                <tr>
                    <th>ID Rekap</th>
                    <th>Nama Personil</th>
                    <th>Divisi</th>
                    <th>Total Gaji</th>
                    <th>Periode</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($resultGaji)): ?>
                <tr>
                    <td><?php echo $row['id_rekap'] ?></td>
                    <td><?php echo $row['nama'] ?></td>
                    <td><?php echo $row['nama_divisi'] ?></td>
                    <td><?php echo $row['total_gaji'] ?></td>
                    <td><?php echo $row['periode'] ?></td>
                <?php endwhile; ?>
            <br>
        </div>
    </div>
</body>
</html>