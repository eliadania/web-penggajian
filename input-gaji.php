<?php
    require 'conn.php';

    $id_divisi = $_GET['id_divisi'];

    $sql = "SELECT id_personil FROM penempatan_personil WHERE id_divisi = '$id_divisi'";
    $resultPersonil = mysqli_query($conn, $sql);

    if(isset($_POST['submit'])) {
        foreach($_POST['jumlah_hari'] as $id_personil => $jumlah_hari) {
            $getRumusGaji = "SELECT rumus_gaji FROM master_divisi WHERE id_divisi = '$id_divisi'";
            $rumusGaji = mysqli_query($conn, $getRumusGaji);
            while ($row = mysqli_fetch_assoc($rumusGaji)) {
                $rumus_gaji = $row['rumus_gaji'];
            }

            $jumlah_jam = $_POST['jumlah_jam'][$id_personil];
            $insentif = $_POST['insentif'][$id_personil];

            if ($insentif == null) {$insentif = 0;}
            if ($jumlah_jam == null) {$jumlah_jam = 0;}

            $resultTotalGaji = eval("return $rumus_gaji;");

            $sqlInsertHitungGaji = "INSERT INTO hitung_gaji (id_personil, id_divisi, jumlah_jam, jumlah_hari, insentif)
                            VALUES ('$id_personil', '$id_divisi', '$jumlah_jam', '$jumlah_hari', '$insentif')";
            mysqli_query($conn, $sqlInsertHitungGaji);


            $sqlGetPeriode = "SELECT periode FROM divisi_per_periode WHERE id_divisi = $id_divisi";
            $resultPeriode = mysqli_query($conn, $sqlGetPeriode);
            while ($row =  mysqli_fetch_assoc($resultPeriode)) {
                $periode = $row['periode'];
            }

            $sqlInsertRekapitulasiGaji = "INSERT INTO rekapitulasi_gaji
            (id_personil, id_divisi, rumus_gaji, total_gaji, periode)
            VALUES ($id_personil, $id_divisi, '$rumus_gaji', $resultTotalGaji, '$periode');";
            mysqli_query($conn, $sqlInsertRekapitulasiGaji);

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Input Gaji</title>
</head>
<body>
    <div class="main-card">
        <button type="submit"><a href="index.php">Kembali</a></button>
        <div class="card-header">
            <div class="card-title">Input Gaji</div>
        </div>
        <div class="card-content">
            <form method="POST">
                <table>
                    <tr>
                        <th>Nama Personil</th>
                        <th>Jumlah Jam</th>
                        <th>Jumlah Hari</th>
                        <th>Insentif</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($resultPersonil)): ?>
                    <?php
                    $id_personil = $row['id_personil'];
                    $sqlPersonil = "SELECT nama FROM master_personil WHERE id_personil = '$id_personil'";
                    $resultNamaPersonil = mysqli_query($conn, $sqlPersonil);
                    $personilRow = mysqli_fetch_assoc($resultNamaPersonil);
                    $nama = $personilRow['nama'];
                    ?>
                    <tr>
                        <td><?php echo $nama ?></td>
                        <td>
                            <input type="text" name="jumlah_jam[<?php echo $id_personil ?>]"
                            <?php echo $id_divisi == 1 ? 'required' : ''; ?>>
                        </td>
                        <td>
                            <input type="text" name="jumlah_hari[<?php echo $id_personil ?>]"
                            <?php echo $id_divisi == 2 ? 'required' : ''; ?>>
                        </td>
                        <td>
                            <input type="text" name="insentif[<?php echo $id_personil ?>]"
                            <?php echo $id_divisi == 2 ? 'required' : ''; ?>>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
                <br>
                <button type="submit" name="submit" value="Submit">Submit</button>
            </form>
        </div>
        <div id="card-content">
            <table>
                <tr>
                    <th>Nama Personil</th>
                    <th>Nama Divisi</th>
                    <th>Jumlah Jam</th>
                    <th>Jumlah Hari</th>
                    <th>Insentif</th>
                    <th>Aksi</th>
                </tr>
                <?php 
                $sql = "SELECT * FROM hitung_gaji as h
                JOIN master_personil as p ON h.id_personil = p.id_personil
                JOIN master_divisi as d ON d.id_divisi = h.id_divisi
                WHERE h.id_divisi = $id_divisi";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)):
                ?>
                <tr>
                    <td><?php echo $row['nama'] ?></td>
                    <td><?php echo $row['nama_divisi'] ?></td>
                    <td><?php echo $row['jumlah_jam'] ?></td>
                    <td><?php echo $row['jumlah_hari'] ?></td>
                    <td><?php echo $row['insentif'] ?></td>
                    <td><button type="submit"><a href="edit-gaji.php?id_personil=<?php echo $row['id_personil'] ?>&id_divisi=<?php echo $row['id_divisi'] ?>">Edit</a></button></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
