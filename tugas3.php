<!DOCTYPE html>
<html>
<head>
    <title>MENGHITUNG NILAI</title>
</head>
<body>
    <center>
    <h1>Form Input Nilai</h1>
    <form method="post" action="">
        <label for="nis">Nama:</label>
        <input type="text" name="nama" id="nama" required><br><br>

        <label for="nilai1">Nilai 1:</label>
        <input type="number" name="nilai1" id="nilai1" required><br><br>
         
        <label for="nilai2">Nilai 2:</label>
        <input type="number" name="nilai2" id="nilai2" required><br><br>
        
        <label for="nilai3">Nilai 3:</label>
        <input type="number" name="nilai3" id="nilai3" required><br><br>
        
        <label for="nilai4">Nilai 4:</label>
        <input type="number" name="nilai4" id="nilai4" required><br><br>
        
        <label for="nilai5">Nilai 5:</label>
        <input type="number" name="nilai5" id="nilai5" required><br><br>
        
        <label for="nilai6">Nilai 6:</label>
        <input type="number" name="nilai6" id="nilai6" required><br><br>
        
        <input type="submit" value="Submit">
    </form>

<?php

class Nilai {
    private $nama;
    private $nilai1;
    private $nilai2;
    private $nilai3;
    private $nilai4;
    private $nilai5;
    private $nilai6;

    public function __construct($nama, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6) {
        $this->nama = $nama;
        $this->nilai1 = $nilai1;
        $this->nilai2 = $nilai2;
        $this->nilai3 = $nilai3;
        $this->nilai4 = $nilai4;
        $this->nilai5 = $nilai5;
        $this->nilai6 = $nilai6;
    }

    public function nama() {
        return $this->nama;
    }

    public function total() {
        return $this->nilai1 + $this->nilai2 + $this->nilai3 + $this->nilai4 + $this->nilai5 + $this->nilai6;
    }

    public function ratarata() {
        $rata = ($this->nilai1 + $this->nilai2 + $this->nilai3 + $this->nilai4 + $this->nilai5 + $this->nilai6)/6;
        return round($rata);
    }

    public function nilaimax() {
        return max($this->nilai1, $this->nilai2, $this->nilai3, $this->nilai4, $this->nilai5, $this->nilai6);
    }

    public function nilaimin() {
        return min($this->nilai1, $this->nilai2, $this->nilai3, $this->nilai4, $this->nilai5, $this->nilai6);
    }

    public function grade() {
        $rata = $this->ratarata();

        if ($rata > 90) {
            return "A";
        } elseif ($rata > 80) {
            return "B";
        } elseif ($rata > 70) {
            return "C";
        } elseif ($rata > 0) {
            return "D";
        }
    }
}

include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nama = $_POST['nama'];
    $nilai1 = $_POST['nilai1'];
    $nilai2 = $_POST['nilai2'];
    $nilai3 = $_POST['nilai3'];
    $nilai4 = $_POST['nilai4'];
    $nilai5 = $_POST['nilai5'];
    $nilai6 = $_POST['nilai6'];

    $nilaihasil = new Nilai($nama, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6);

    $sql = "INSERT INTO `nilai`(`nama`, `nilai1`, `nilai2`, `nilai3`, `nilai4`, `nilai5`, `nilai6`) VALUES ('$nama','$nilai1','$nilai2','$nilai3','$nilai4','$nilai5','$nilai6')";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "Berhasil";
    } else {
        echo "Gagal";
    }

   
    echo "<br><br>";
    echo "Nama: " . $nilaihasil->nama();
    echo "<br>";
    echo "Total: " . $nilaihasil->total();
    echo "<br>";
    echo "Rata-Rata: " . $nilaihasil->ratarata();
    echo "<br>";
    echo "Nilai Max: " . $nilaihasil->nilaimax();
    echo "<br>";
    echo "Nilai Min: " . $nilaihasil->nilaimin();
    echo "<br>";
    echo "Grade Penilaian: " . $nilaihasil->grade();

    echo "<br><br>";
    echo "<a href='tampil.php'>Lihat Daftar Nilai</a>";
    echo "<br>";
    echo "<a href='hapus.php?nis=$nama'>Hapus Nilai</a>";
}
?>

</center>
</body>
</html>