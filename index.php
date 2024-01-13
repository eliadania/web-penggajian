<?php
    require 'conn.php';

    $divisi = "SELECT * FROM master_divisi";
    $resultDivisi = mysqli_query($conn, $divisi);
    $divisiOptions = "";
    while ($row = mysqli_fetch_assoc($resultDivisi)) {
        $divisiOptions .= "<option value='{$row['nama_divisi']}'>{$row['nama_divisi']}</option>";
    }

    if (isset($_POST['submit'])) {
        $selectedDivisi = $_POST['divisi'];
        $tanggalPeriode = $_POST['tanggal'];
        
        $sql = "SELECT id_divisi FROM master_divisi WHERE nama_divisi = '$selectedDivisi'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $idDivisi = $row['id_divisi'];
    
        $sql = "INSERT INTO divisi_per_periode (id_divisi, nama_divisi, periode) VALUES ('$idDivisi', '$selectedDivisi', '$tanggalPeriode')";
        if (mysqli_query($conn, $sql)) {
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    $divPerPeriode = "SELECT * FROM divisi_per_periode";
    $resultPeriode = mysqli_query($conn, $divPerPeriode);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pencatatan Gaji</title>
</head>
<body>
    <div class="main-card">
        <div class="card-header">
            <div class="card-title">Pencatatan Gaji</div>
        </div>
        <div class="card-content">
            <div class="flex-container">
                <div class="left-card">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Divisi</div>
                    </div>
                    <div class="card-content">
                        <form method='POST'>
                            <label for="divisi">Divisi</label> <br>
                            <select name="divisi" id="divisi">
                                <<?php echo $divisiOptions; ?>
                            </select> <br>
                            <label for="tanggal">Tanggal Periode</label> <br>
                            <input type="date" name="tanggal" id="tanggal"> <br>
                            <button type="submit" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="right-card">
                    <div class="card-header">
                        <div class="card-title">Periode Tersimpan dari Form Tambah Divisi</div>
                    </div>
                    <div class="card-content">
                        <table>
                            <tr>
                                <th>Divisi</th>
                                <th>Periode</th>
                                <th>Aksi</th>
                            </tr>
                            <?php while ($row = mysqli_fetch_assoc($resultPeriode)): ?>
                            <tr>
                                <td><?php echo $row['nama_divisi'] ?></td>
                                <td><?php echo $row['periode'] ?></td>
                                <td>
                                    <button type="submit"><a href="input-gaji.php?id_divisi=<?php echo $row['id_divisi'] ?>">Input Gaji</a></button>
                                    <button type="submit"><a href="lihat-detail.php?id_divisi=<?php echo $row['id_divisi'] ?>">Lihat Detail</a></button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </table>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>