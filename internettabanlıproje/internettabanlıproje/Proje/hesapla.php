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
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
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
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Personel Aylık Maaş Hesaplama</h2>
    <form method="post" action="">
        
        <label for="ad_soyad">Ad Soyad:</label>
        <input type="text" name="ad_soyad" id="ad_soyad" required><br>

        <label for="saatlik_ucret">Saatlik Ücret (TL):</label>
        <input type="number" name="saatlik_ucret" id="saatlik_ucret" min="0" required><br>

        <label for="haftaici_calisma_saati">Hafta İçi Çalışma Saati:</label>
        <input type="number" name="haftaici_calisma_saati" id="haftaici_calisma_saati" min="0" required><br>

        <label for="haftasonu_calisma_saati">Hafta Sonu Çalışma Saati:</label>
        <input type="number" name="haftasonu_calisma_saati" id="haftasonu_calisma_saati" min="0" required><br>

        <label for="satis">Müşteri Sayısı :</label>
        <input type="number" name="satis" id="satis" min="0" required><br>

        <label for="yol_ucreti">Yol Ücreti (TL):</label>
        <input type="number" name="yol_ucreti" id="yol_ucreti" min="0"><br>

        <label for="yemek_ucreti">Yemek Ücreti (TL):</label>
        <input type="number" name="yemek_ucreti" id="yemek_ucreti" min="0"><br>

        <input type="submit" name="calculate" value="Hesapla">
    </form>

    <?php
    $vt_sunucu = "localhost";
    $vt_kullanici = "root";
    $vt_sifre = "";
    $vt_adi = "maas_hesaplama";

    $baglan = mysqli_connect($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);

    if(isset($_POST['calculate'])) {
        $ad_soyad = $_POST['ad_soyad'];
        $saatlik_ucret = $_POST['saatlik_ucret'];
        $haftaici_calisma_saati= $_POST['haftaici_calisma_saati'];
        $haftasonu_calisma_saati = $_POST['haftasonu_calisma_saati'];
        $satis = $_POST['satis'];
        $yol_ucreti = isset($_POST['yol_ucreti']) ? $_POST['yol_ucreti'] : 0;
        $yemek_ucreti = isset($_POST['yemek_ucreti']) ? $_POST['yemek_ucreti'] : 0;

        $hafta_ici_ucret = $saatlik_ucret * $haftaici_calisma_saati;
        $hafta_sonu_ucret = $saatlik_ucret * 1.5 * $haftasonu_calisma_saati;

        $yol_yemek_ucreti = $yol_ucreti + $yemek_ucreti;

        $toplam_ucret = $hafta_ici_ucret + $hafta_sonu_ucret;

        $prim = 0;
        if($satis > 1000) {
            $prim = 2500; 
        }

        $Maas = $toplam_ucret + $yol_yemek_ucreti + $prim;

        $sql = "INSERT INTO maas (ad_soyad, hafta_ici_ucret, hafta_sonu_ucret, prim, yol_yemek_ucreti, Maas) VALUES ('$ad_soyad', '$hafta_ici_ucret', '$hafta_sonu_ucret', '$prim', '$yol_yemek_ucreti', '$Maas')";
        
        if (mysqli_query($baglan, $sql)) {
          
        } else {
            echo "Veri eklenirken bir hata oluştu: " . mysqli_error($baglan);
        }
    }

    $tablo_sorgusu = "SELECT * FROM maas";
    $tablo_sonucu = mysqli_query($baglan, $tablo_sorgusu);

    echo "<h2>Aylık Maaşlar Tablosu</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Ad Soyad</th><th>Hafta İçi Ücret</th><th>Hafta Sonu Ücret</th><th>Prim</th><th>Yol ve Yemek Ücreti</th><th>Net Maaş</th></tr>";
    while($satir = mysqli_fetch_assoc($tablo_sonucu)) {
        echo "<tr>";
        echo "<td>" . $satir['ad_soyad'] . "</td>";
        echo "<td>" . $satir['hafta_ici_ucret'] . "</td>";
        echo "<td>" . $satir['hafta_sonu_ucret'] . "</td>";
        echo "<td>" . $satir['prim'] . "</td>";
        echo "<td>" . $satir['yol_yemek_ucreti'] . "</td>";
        echo "<td>" . $satir['Maas'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_close($baglan);
    ?>
</body>
</html>
