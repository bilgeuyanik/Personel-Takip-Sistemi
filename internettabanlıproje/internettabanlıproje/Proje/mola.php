<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mola Sistemi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .yesil {
            background-color: green;
            color: white;
        }
        .kirmizi {
            background-color: red;
            color: white;
        }
        h1, h2, h3 {
            color: #333;
        }
       
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: calc(25% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 24%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;}
    </style>
</head>
<body>


<h3>Mola Bilgisi Girişi</h3>
<form action="" method="post">
    <label for="ad_soyad">Ad Soyad:</label><br>
    <input type="text" id="ad_soyad" name="ad_soyad" required><br>
    <label for="saat_araligi">Saat Aralığı:</label><br>
    <input type="text" id="saat_araligi" name="saat_araligi" required><br><br>
    <input type="submit" name="submit" value="Kaydet">
</form>

<?php
$vt_sunucu = "localhost";
$vt_kullanici = "root";
$vt_sifre = "";
$vt_adi = "mola_sistemi";

$baglan = mysqli_connect($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);

if ($baglan->connect_error) {
    die("Veri tabanına bağlanılamadı: " . $baglan->connect_error);
}

$sql_check = "SELECT COUNT(*) AS count FROM mola_saatleri";
$result_check = $baglan->query($sql_check);
$row_check = $result_check->fetch_assoc();
if ($row_check['count'] == 0) {
    $saatler = array(
        "09:00-10:00",
        "10:00-11:00",
        "11:00-12:00",
        "12:00-13:00",
        "13:00-14:00",
        "14:00-15:00",
        "15:00-16:00",
        "16:00-17:00"
    );
    foreach ($saatler as $saat) {
        $sql_insert = "INSERT INTO mola_saatleri (saat_araligi) VALUES ('$saat')";
        $baglan->query($sql_insert);
    }
}

if(isset($_POST['submit'])){
    $ad_soyad = $_POST['ad_soyad'];
    $saat_araligi = $_POST['saat_araligi'];
    
    $sql_check = "SELECT * FROM mola_saatleri WHERE saat_araligi = '$saat_araligi' AND alindi_mi = true";
    $result_check = $baglan->query($sql_check);
    
    if ($result_check->num_rows > 0) {
        echo "<p>Bu saat aralığı zaten alınmış. Lütfen başka bir saat aralığı seçin.</p>";
    } else {
        $sql_update = "UPDATE mola_saatleri SET alindi_mi = true, ad_soyad = '$ad_soyad' WHERE saat_araligi = '$saat_araligi'";
        if ($baglan->query($sql_update) === TRUE) {
            echo "<p>Mola bilgileri başarıyla kaydedildi.</p>";
        } else {
            echo "<p>Hata: " . $sql_update . "<br>" . $baglan->error . "</p>";
        }
    }
}

echo "<h3>Personel Mola Bilgileri</h3>";
echo "<table>
        <thead>
            <tr>
                <th>Ad_Soyad</th>
                <th>Saat Aralığı</th>
                <th>Mola Alındı</th>
            </tr>
        </thead>
        <tbody>";
        
$sql_select = "SELECT id, saat_araligi, ad_soyad, alindi_mi FROM mola_saatleri";
$result = $baglan->query($sql_select);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $mola_alindi_class = $row["alindi_mi"] ? "yesil" : "kirmizi";
        $mola_alindi_text = $row["alindi_mi"] ? "Evet" : "Hayır";
        echo "<tr>
                <td>" . $row["ad_soyad"] . "</td>
                <td>" . $row["saat_araligi"] . "</td>
                <td class='$mola_alindi_class'>" . $mola_alindi_text . "</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='3'>Veri bulunamadı.</td></tr>";
}
echo "</tbody></table>";

$baglan->close();
?>

</body>
</html>
