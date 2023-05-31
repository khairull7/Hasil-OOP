<?php
include "koneksi.php";

class tampil {
    public $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function data() {
        $sql = "SELECT * FROM nilai";
        $query = mysqli_query($this->conn, $sql);
        return $query;
    }

    public function rata($data) {
        $nilai1 = $data["nilai1"];
        $nilai2 = $data["nilai2"];
        $nilai3 = $data["nilai3"];
        $nilai4 = $data["nilai4"];
        $nilai5 = $data["nilai5"];
        $nilai6 = $data["nilai6"];
        $rata = ($nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 + $nilai6) / 6;
        return round($rata);
    }
}

$nilai = new tampil($conn);
$query = $nilai->data();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tampil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            padding-top: 50px;
        }
        h1 {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <h1>DAFTAR NILAI</h1>
        </center>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nilai 1</th>
                    <th>Nilai 2</th>
                    <th>Nilai 3</th>
                    <th>Nilai 4</th>
                    <th>Nilai 5</th>
                    <th>Nilai 6</th>
                    <th>Rata-Rata</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query) > 0) : ?>
                    <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td><?= $data["nama"]; ?></td>
                            <td><?= $data["nilai1"]; ?></td>
                            <td><?= $data["nilai2"]; ?></td>
                            <td><?= $data["nilai3"]; ?></td>
                            <td><?= $data["nilai4"]; ?></td>
                            <td><?= $data["nilai5"]; ?></td>
                            <td><?= $data["nilai6"]; ?></td>
                            <?php
                            $rata = $nilai->rata($data);
                            ?>
                            <td><?= $rata; ?></td>
                            <td><a href="hapus.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm">Hapus</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>