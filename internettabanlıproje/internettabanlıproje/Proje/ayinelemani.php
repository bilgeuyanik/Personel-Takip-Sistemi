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

<form method="POST" action="ayinelemani.php">
    <label for="ad_soyad">Ad Soyad:</label>
    <input type="text" id="ad_soyad" name="ad_soyad" required>
    
    <label for="satis_sayisi">Satış Sayısı:</label>
    <input type="number" id="satis_sayisi" name="satis_sayisi" required>
    
    <input type="submit" name="calculate" value="Hesapla">
</form>

<form method="POST" action="ayinelemani.php">
    <input type="submit" name="select_employee" value="Ayın Personeli Seç">
</form>

<?php
$vt_sunucu = "localhost";
$vt_kullanici = "root";
$vt_sifre = "";
$vt_adi = "maas_hesaplama";

$baglan = mysqli_connect($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);

if(isset($_POST['select_employee'])) {
    $en_yuksek_satis_sayisi_sorgusu = "SELECT MAX(satis_sayisi) AS max_satis FROM ayin_elemani";
    $en_yuksek_satis_sayisi_sonucu = mysqli_query($baglan, $en_yuksek_satis_sayisi_sorgusu);
    $en_yuksek_satis_sayisi_satiri = mysqli_fetch_assoc($en_yuksek_satis_sayisi_sonucu);
    $en_yuksek_satis_sayisi = $en_yuksek_satis_sayisi_satiri['max_satis'];

    $en_yuksek_satis_personel_sorgusu = "SELECT ad_soyad FROM ayin_elemani WHERE satis_sayisi = $en_yuksek_satis_sayisi";
    $en_yuksek_satis_personel_sonucu = mysqli_query($baglan, $en_yuksek_satis_personel_sorgusu);
    $en_yuksek_satis_personel_satiri = mysqli_fetch_assoc($en_yuksek_satis_personel_sonucu);
    $en_yuksek_satis_personeli = $en_yuksek_satis_personel_satiri['ad_soyad'];

    echo "<h3>En yüksek satış sayısına sahip personel: $en_yuksek_satis_personeli ($en_yuksek_satis_sayisi)</h3>";
}

if(isset($_POST['calculate'])) {
    if(isset($_POST['satis_sayisi'])) {
        $ad_soyad = $_POST['ad_soyad'];
        $satis_sayisi = $_POST['satis_sayisi'];

        $ekleme_sorgusu = $baglan->prepare("INSERT INTO ayin_elemani (ad_soyad, satis_sayisi) VALUES (?, ?)");

        $ad_soyad = htmlspecialchars($ad_soyad);
        $satis_sayisi = intval($satis_sayisi);

        $ekleme_sorgusu->bind_param("si", $ad_soyad, $satis_sayisi);
        if ($ekleme_sorgusu->execute()) {
        } else {
            echo "Veri eklenirken bir hata oluştu: " . $baglan->error;
        }
    } else {
        echo "Lütfen satış sayısını girin.";
    }
}


$tablo_sorgusu = "SELECT * FROM ayin_elemani";
$tablo_sonucu = mysqli_query($baglan, $tablo_sorgusu);

echo "<h2>Ayın Elemanı Seçimi</h2>";
echo "<table>";
echo "<tr><th>Ad Soyad</th><th>Toplam Satış Sayısı</th></tr>";
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
