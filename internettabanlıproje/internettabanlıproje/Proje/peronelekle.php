<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personel Yönetimi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"],
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover,
        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Personel Yönetimi</h1>
        <div id="personel-listesi">
            <?php
            $vt_sunucu = "localhost";
            $vt_kullanici = "root";
            $vt_sifre = "";
            $vt_adi = "personel";

           $baglan = mysqli_connect($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);

            if ($baglan->connect_error) {
                die("Veritabanına bağlanırken hata: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM giris";
            $result = $baglan->query($sql);

            if ($result->num_rows > 0) {
                echo "<table><tr><th>Ad</th><th>Soyad</th><th>TC</th><th>Departman</th><th>Tel No</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Ad"]. "</td><td>" . $row["Soyad"]. "</td><td>" . $row["TC"]. "</td><td>" . $row["departman"]. "</td><td>" . $row["tel_no"]. "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Tabloda kayıt bulunamadı.";
            }
            $baglan->close();
            ?>
        </div>
        <form method="post">
            <label for="Ad">Ad:</label>
            <input type="text" id="Ad" name="Ad" required>
            <label for="Soyad">Soyad:</label>
            <input type="text" id="Soyad" name="Soyad" required>
            <label for="TC">TC:</label>
            <input type="text" id="TC" name="TC" required>
            <label for="departman">Departman:</label>
            <input type="text" id="departman" name="departman" required>
            <label for="tel_no">Tel No:</label>
            <input type="text" id="tel_no" name="tel_no" required>
            <button type="submit" name="ekle_btn">Ekle</button>
            <button type="submit" name="kaldir_btn">Kaldır</button>

        </form>
        
    </div>

    <?php
    if(isset($_POST['ekle_btn'])) {
        $ad = $_POST['Ad'];
        $soyad = $_POST['Soyad'];
        $tc = $_POST['TC'];
        $departman = $_POST['departman'];
        $tel_no = $_POST['tel_no'];

        $baglan = mysqli_connect($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);

        if ($baglan->connect_error) {
            die("Veritabanına bağlanırken hata: " . $baglan->connect_error);
        }

        $sql = "INSERT INTO giris (Ad, Soyad, TC, departman, tel_no) VALUES ('$ad', '$soyad', '$tc', '$departman', '$tel_no')";

        if ($baglan->query($sql) === TRUE) {
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Kayıt eklenirken hata oluştu: " . $baglan->error;
        }

        $baglan->close();
    }

    if(isset($_POST['kaldir_btn'])) {
        $baglan = mysqli_connect($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);

        if ($baglan->connect_error) {
            die("Veritabanına bağlanırken hata: " . $baglan->connect_error);
        }

        $sql = "TRUNCATE TABLE giris";

        if ($baglan->query($sql) === TRUE) {
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Kayıtlar temizlenirken hata oluştu: " . $baglan->error;
        }

        $baglan->close();
    }
    ?>
</body>
</html>
