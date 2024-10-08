<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personel Aylık Maaş Hesaplama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            width: 400px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<h2>Personel Satış Sayısı</h2>

<form method="POST" action="">
    <label for="hedef">Hedef Satış Sayısı:</label>
    <input type="number" id="hedef" name="hedef" required>
    
    <input type="submit" name="calculate" value="Hesapla">
</form>

<?php
$vt_sunucu = "localhost";
$vt_kullanici = "root";
$vt_sifre = "";
$vt_adi = "maas_hesaplama";

$baglan = mysqli_connect($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);

if(isset($_POST['calculate'])) {
    if(isset($_POST['hedef'])) {
        $hedef = $_POST['hedef'];

        $toplam_satis_sayisi = 0;
        $tablo_sorgusu = "SELECT satis_sayisi FROM ayin_elemani";
        $tablo_sonucu = mysqli_query($baglan, $tablo_sorgusu);
        while($satir = mysqli_fetch_assoc($tablo_sonucu)) {
            $toplam_satis_sayisi += $satir['satis_sayisi'];
        }

        if ($toplam_satis_sayisi >= $hedef) {
            echo "<h3>Hedefe ulaşıldı!</h3>";
            echo "<form method='POST' action='kaydet.php'>";
            echo "<label for='etkinlik'>Etkinlik Seç:</label>";
            echo "<select id='etkinlik' name='etkinlik'>";
            echo "<option value=''>-- Seçiniz --</option>";
            echo "<option value='ödül'>Kahvaltı Organizasyonu</option>";
            echo "<option value='ödül'>Bowling Turnuvası</option>";
            echo "<option value='ödül'>Açık Hava Sineması</option>";
            echo "<option value='ödül'>Piknik</option>";

            echo "</select>";
            echo "<input type='hidden' name='hedef_ulasildi' value='1'>";
            echo "<input type='submit' name='save' value='Kaydet'>";
            echo "</form>";
        } else {
            echo "<h3>Hedefe ulaşılamadı.</h3>";
        }
    } else {
        echo "Lütfen hedef satış sayısını girin.";
    }
}

$tablo_sorgusu = "SELECT * FROM ayin_elemani";
$tablo_sonucu = mysqli_query($baglan, $tablo_sorgusu);

echo "<h2>Ayın Elemanı Satışları</h2>";
echo "<table>";
echo "<tr><th>Ad Soyad</th><th>Satış Sayısı</th></tr>";
while($satir = mysqli_fetch_assoc($tablo_sonucu)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($satir['ad_soyad']) . "</td>";
    echo "<td>" . $satir['satis_sayisi'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($baglan);
?>

</body>
</html>
