<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye Ekle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            display: flex;
            flex-direction: column;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            color: #007bff;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        .videolar {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .video {
            flex: 0 0 48%;
        }

        .video iframe {
            width: 100%;
            height: 200px;
        }
        .egitim-sayfası table {
    width: 100%;
    border-collapse: collapse;
}
.egitim-videolar {
    padding-top: 30px;
    display: flex;
    justify-content: center;
    max-width: 800px; 
    margin: 2 auto; 

.video {
    width: 100%;
    max-width: 400px; 
    margin: 0 10px; 
}

  
    </style>
</head>
<body>

<div class="container">
    <h2>Üye Ekle</h2>
    <form method="post">
        <label for="ad">Ad:</label>
        <input type="text" id="ad" name="ad"><br>
        <label for="soyad">Soyad:</label><br>
        <input type="text" id="soyad" name="soyad"><br>
        <label for="saglik_bilgisi">Eğitim Bilgisi:</label><br>
        <input type="text" id="saglik_bilgisi" name="saglik_bilgisi"><br><br>
        <input type="submit" value="Kaydet">
    </form>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "uyeler";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ad = $_POST["ad"];
        $soyad = $_POST["soyad"];
        $saglik_bilgisi = $_POST["saglik_bilgisi"];

        $sql = "INSERT INTO saglik_durumu (ad, soyad, saglik_bilgisi) VALUES ('$ad', '$soyad', '$saglik_bilgisi')";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    }

    $sql = "SELECT * FROM saglik_durumu";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Üyeler</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Ad</th><th>Soyad</th><th>Eğitim Bilgisi</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["ad"] . "</td><td>" . $row["soyad"] . "</td><td>" . $row["saglik_bilgisi"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Veritabanında hiç üye bulunmamaktadır.</p>";
    }

    $conn->close();
    ?>
</div>

<section class="videolar">

    <div class="egitim-videolar">
        <div class="video">
            <h5>İlk Yardım Eğitimi</h5>
            <iframe src="https://www.youtube.com/embed/eYLu7dh6nUI?si=SAwwEL_bConTdjUC" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="video">
            <h5>Proje Yönetimi</h5>
            <iframe src="https://www.youtube.com/embed/RFn-Tu2ypDM?si=VjKiiJwcExaR4LYB" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="video">
            <h5>Etkili İletişim</h5>
            <iframe src="https://www.youtube.com/embed/xv6drBKCJ4U?si=f07wpSHsTaUI6_dT"  frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="video">
            <h5>Zaman Yönetimi</h5>
            <iframe src="https://www.youtube.com/embed/uJJOjEiJLo8?si=eZL-gSWUd3EhFhWm"  frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

</section>

</body>
</html>
