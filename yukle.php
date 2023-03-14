<?php
/*
$FILES[]
TMP_NAME /DOSYANIN GEÇİCİ OLARAK BULUNDUĞU KONUM
NAME /DOSYASIN ADI
SİZE /DOSYANIN BÜYÜKLÜĞÜ
TYPE /DOSYANIN MİME TİPİ = FARKLI UZANTILARDAKİ DOSYALARI TANIMLAMAK İÇİN
is_uploaded_file() / dosyanın  yüklenio yğklenmediğini kontrol için
move_uploaded_file() /geçici kısımda istediğimiz bir konuma taşımak için
*/
$maxBoyut = 500000;
$dosyaUzantisi = substr($_FILES["dosya"]["name"], -4, 4);
$dosyaAdi = rand(0, 99999999) . $dosyaUzantisi;
$dosyaYolu = "dosya/" . $dosyaAdi;

if ($_FILES["dosya"]["size"] > $maxBoyut) {
    echo "dosya boyutu en fazla 500 kb olabilir";
} else {

    $d = $_FILES["dosya"]["type"];
    if ($d == "image/jpeg" || $d == "image/png" || $d == "image/gif") { //sadece resim dosyası ile

        if (is_uploaded_file($_FILES["dosya"]["tmp_name"])) {

            $tasi = move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaYolu);
            if ($tasi) {
                echo "{$dosyaAdi} adlı dosya başarı ile yüklendi <br /> 
 <img src='http://localhost/firstproject/dosyayuklemeislemi/{$dosyaYolu}' alt='' />";
            } else {
                echo "dosya taşınırken bir sorun oluştu";
            }

        } else {
            echo "dosya yüklenirken bir sorun oluştu.";
        }
    } else {
        echo "dosya formatı gif -  png ya da jpg formatında olmalıdır";
    }
}