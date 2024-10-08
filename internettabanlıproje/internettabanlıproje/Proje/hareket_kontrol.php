<?php
include 'baglanti.php';


if(isset($_POST['basla'])) {
   
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];

    $sql_baslangic = "INSERT INTO hareket_kontrol (ad, soyad, is_baslama_saati) VALUES ('$ad', '$soyad', NOW())";
   
    if ($baglanti->query($sql_baslangic) === TRUE) {
    } else {
        echo "Hata: " . $sql_baslangic . "<br>" . $baglanti->error;
    }
}

if(isset($_POST['bitir'])) {
   
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];

    $sql_bitis = "UPDATE hareket_kontrol SET is_bitis_saati = NOW() WHERE ad = '$ad' AND soyad = '$soyad'";

    if ($baglanti->query($sql_bitis) === TRUE) {
    } else {
        echo "Hata: " . $sql_bitis . "<br>" . $baglanti->error;
    }
}

$baglanti->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personel İş Zamanı Kaydı</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #f5f5f5;
        }
        form {
            width: 50%;
            margin: 20px auto;
            text-align: center;
        }
        input[type="text"], input[type="submit"] {
            padding: 8px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <h2>Personel İş Zamanı Kaydı</h2>
    <form action="hareket_kontrol.php" method="post">
        <label for="ad">Ad:</label>
        <input type="text" id="ad" name="ad" required><br><br>
        <label for="soyad">Soyad:</label>
        <input type="text" id="soyad" name="soyad" required><br><br>
        <input type="submit" name="basla" value="Başla">
        <input type="submit" name="bitir" value="Bitir">
    </form><?php
    
    include 'baglanti.php';

    
    $sql = "SELECT ad, soyad, is_baslama_saati, is_bitis_saati FROM hareket_kontrol";
    $result = $baglanti->query($sql);

    echo "<h2>Personel İş Zamanı Tablosu</h2>";
    echo "<table>";
    echo "<tr><th>Ad</th><th>Soyad</th><th>İş Başlangıç Saati</th><th>İş Bitiş Saati</th></tr>";

    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["ad"]."</td><td>".$row["soyad"]."</td><td>".$row["is_baslama_saati"]."</td><td>".$row["is_bitis_saati"]."</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Veri bulunamadı.</td></tr>";
    }
    echo "</table>";

    $baglanti->close();
    ?>
</body>
</html>
