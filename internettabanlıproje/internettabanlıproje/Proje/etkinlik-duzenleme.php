<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "uyeler";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $satis_miktari = $_POST['satis_miktari'];

    
    $sql = "INSERT INTO satislar (ad, soyad, satis_miktari) VALUES ('$ad', '$soyad', '$satis_miktari')";

    if ($conn->query($sql) === TRUE) {
        echo "Yeni kayıt başarıyla eklendi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

   
    if (isset($_POST['hedef_satis'])) {
        $hedefSatisMiktari = intval($_POST['hedef_satis']);
        $sql = "INSERT INTO hedefler (hedef_satis) VALUES ('$hedefSatisMiktari')";
        if ($conn->query($sql) === FALSE) {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    }
}


$sql = "SELECT * FROM hedefler ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hedefSatisMiktari = $row['hedef_satis'];
} else {
    $hedefSatisMiktari = 0;
}


$sql = "SELECT SUM(satis_miktari) AS toplam_satis FROM satislar";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$toplamSatisMiktari = $row['toplam_satis'];


if ($toplamSatisMiktari >= $hedefSatisMiktari) {
    $hedefDurumu = "Hedefe Ulaşıldı";
} else {
    $hedefDurumu = "Hedefe Ulaşılmadı";
}


echo "<h3>$hedefDurumu</h3>";
echo "<p>Toplam Satış Miktarı: $toplamSatisMiktari</p>";


if ($toplamSatisMiktari >= $hedefSatisMiktari) {
    echo "<h4>Etkinlik Seçenekleri:</h4>";
    echo "<ul>";
    echo "<li>Kahvaltı Organizasyonu</li>";
    echo "<li>Bowling Turnuvası</li>";
    echo "<li>Sinema Günü</li>";
    echo "</ul>";
} else {
   
    echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
    echo "<label for='hedef_satis'>Hedef Satış Miktarını Belirleyin:</label>";
    echo "<input type='number' name='hedef_satis' id='hedef_satis' value='$hedefSatisMiktari'>";
    echo "<input type='submit' value='Hedefi Belirle'>";
    echo "</form>";
    echo "<p>Hedefe ulaşmak için daha fazla satış yapılması gerekiyor.</p>";
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satış Ekleme Formu ve Satışlar Tablosu</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Satış Ekleme Formu</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Ad: <input type="text" name="ad"><br>
        Soyad: <input type="text" name="soyad"><br>
        Satış Miktarı: <input type="text" name="satis_miktari"><br>
        <input type="submit" value="Kaydet">
    </form>
    
    <h2>Aylık Hedef Belirleme</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    Hedef: <input type="text" name="hedef"><br>
        <input type="submit" value="Kaydet">
    </form>
    <h2>Satışlar Tablosu</h2>
    <table>
        <tr>
            <th>Ad</th>
            <th>Soyad</th>
            <th>Satış Miktarı</th>
        </tr>
        <?php
       
        $conn = new mysqli($servername, $username, $password, $database);

        
        if ($conn->connect_error) {
            die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
        }

        
        $sql = "SELECT ad, soyad, satis_miktari FROM satislar";
        $result = $conn->query($sql);

        $toplamSatisMiktari = 0; 

        if ($result->num_rows > 0) {
           
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ad"] . "</td><td>" . $row["soyad"] . "</td><td>" . $row["satis_miktari"] . "</td></tr>";
                
                
                $toplamSatisMiktari += $row["satis_miktari"];
            }
        } else {
            echo "<tr><td colspan='3'>Kayıt bulunamadı.</td></tr>";
        }

        
        echo "<tr><td colspan='2'><strong>Toplam Satış Miktarı</strong></td><td><strong>$toplamSatisMiktari</strong></td></tr>";

        
        $conn->close();
        ?>
    </table>
</body>
</html>
