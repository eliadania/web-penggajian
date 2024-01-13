<?php
    require 'conn.php';
    
    $id_personil    = $_GET['id_personil'];
    $id_divisi      = $_GET['id_divisi'];

    $sql            = "SELECT * FROM hitung_gaji WHERE id_personil = '$id_personil' AND id_divisi = '$id_divisi'";
    $result         = mysqli_query($conn, $sql);
    $row            = mysqli_fetch_assoc($result);

    $jumlah_jam     = $row['jumlah_jam'];
    $jumlah_hari    = $row['jumlah_hari'];
    $insentif       = $row['insentif'];

    if (isset($_POST['submit'])) {
        $jumlah_jam     = $_POST['jumlah_jam'];
        $jumlah_hari    = $_POST['jumlah_hari'];
        $insentif       = $_POST['insentif'];

        $sql = "UPDATE hitung_gaji
        SET jumlah_jam = '$jumlah_jam',
        jumlah_hari = '$jumlah_hari',
        insentif = '$insentif'
        WHERE id_personil = $id_personil AND id_divisi = $id_divisi";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Data berhasil diubah";
        } else {
            echo "Gagal mengubah data";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Data Gaji</title>
</head>
<body>
    <div class="main-card">
        <button type="submit"><a href="input-gaji.php?id_divisi=<?php echo $row['id_divisi'] ?>">Kembali</a></button>
        <div class="card-header">
            <div class="card-title">Edit Data Gaji</div>
        </div>
        <div class="card-content">
            <form action="edit-gaji.php?id_personil=<?php echo $row['id_personil'] ?>&id_divisi=<?php echo $row['id_divisi'] ?> " method="POST">
                <input type="hidden" name="id_personil" value="<?php echo $id_personil; ?>">
                <input type="hidden" name="id_divisi" value="<?php echo $id_divisi; ?>">
                
                <label for="jumlah_jam">Jumlah Jam</label>
                <input type="number" id="jumlah_jam" name="jumlah_jam" value="<?php echo $jumlah_jam; ?>">

                <label for="jumlah_hari">Jumlah Hari</label>
                <input type="number" id="jumlah_hari" name="jumlah_hari" value="<?php echo $jumlah_hari; ?>">

                <label for="insentif">Insentif</label>
                <input type="number" id="insentif" name="insentif" value="<?php echo $insentif; ?>">

                <button type="submit" name="submit" value="Submit">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>