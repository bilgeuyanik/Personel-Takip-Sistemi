<?php
include("baglanti.php");

if(isset($_POST["Giriş"])){
    $kimlik = $_POST["kullanici_tc"]; 
    $parola = $_POST["parola"]; 

    $sorgu = "SELECT * FROM kullanici WHERE kullanici_tc = '$kimlik' AND sifre = '$parola'";
    $sonuc = $baglanti->query($sorgu);
    if($sonuc->num_rows > 0){
       
        echo "<script>alert('Giriş başarılı.')</script>";
        
        header("Location: index2.php");
        exit; 
    } else {
        
        echo "<script>alert('Kullanıcı adı veya şifre yanlış.')</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaydol Formu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup-form">
        <form   method="POST" >
            <h2>İnovatif Personel Takip ve Teşvik Platformu</h2>

            <img src="icon.png" alt="logo" width="80" height="80" style="margin-top: 20px;"/>
            <h1>Giriş Sayfası</h1>
            <input type="text" placeholder="T.C Kimlik Numarası" class="txt" name ="kullanici_tc">
            <input type="password" placeholder="Şifre" class="txt" name ="parola">
            <input type="submit" value="Giriş" class="signup-btn" name ="Giriş">
        </form>
    </div>
</body>
</html>
