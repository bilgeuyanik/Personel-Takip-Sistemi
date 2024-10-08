<?php
$host = "localhost";
$kullanici = "root";
$sifre = "";
$veritabani = "uyeler";

$baglanti = mysqli_connect($host, $kullanici, $sifre, $veritabani);
mysqli_set_charset($baglanti, "UTF8");

if(!$baglanti){
    die ("veri tabanı bağlantı  işlemi başarısız".mysqli_connect_eror());
}

?>
