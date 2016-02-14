<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Turkish Suffixes Demo</title>
</head>
<body>
<form method="get" action="">
    <input type="text" name="i" value="<?= $_GET['i'] ?>" placeholder="İsim yaz..." x-webkit-speech>
    <button type="submit">wubba lubba dub dub</button>
    <a href="?stress=test">Stress Test</a>
</form>
<?php
require_once("../php/Turkce.php");

$rapokisi = array(
    "Siis",
    "Utku Sipahioğlu",
    "Alper Özgün Yeşil",
    "Burak Köksal",
    "Çağlar Şahin",
    "Merve Kurt",
    "Gizem Bor",
    "Anıl Şen",
    "Fatoş Yılmaz",
    "Görkem Karagöz",
    "Ömer Aybakır",
    "Nevcan Yanık",
    "Pelin Sürgit",
    "Fulya Ulutürk",
    "Tuğçe Altuntaş",
    "Tuğçe Şahpaz",
    "Kubilay Sağlam",
    "Teorik Deli",
    "Melis Karabulut",
    "Ümra Yıldırım",
    "Furkan Demirci",
    "Burcu Zülal Türker",
    "Mavi Deniz Yapar",
    "Gizem Pakyürek",
    "Ellis Bexter",
    "Mert Duygun",
    "Hasan Maratuk",
    "Çiğdem Elif Çelik",
    "Yağmur Işık",
    "Soner Altın",
    "Erkan Kerti",
    "Zafer Elçik",
    "Aykut Guncan",
    "Maksude Ozturk",
    "Maksude Oztürk",
    "Nur Kübra özkan",
    "Dilan Kaygusuz",
    "Burak Karabey",
    "Barış Gürbüz",
    "Ulaş Erdegör",
    "Damla Özsargın",
    "Müge Bora Bayraktar",
    "Elif Akgün",
    "Yunus Ocak",
    "Tuğba Boz",
    "Andaç Yaşar",
    "Fatih Uluçay",
    "MercAn Cebe",
    "Cemre Dağ",
    "Duygu Akyürek",
    "Zeynep Ünal",
    "Betül İlkbaş",
    "Buket Başol",
    "Simge Çakır",
    "Merih Akgünay",
    "Gizem Nida Çınar",
    "Birsel Çatık",
    "Can Aslan",
    "Ece Köken",
    "Başak",
    "Doğukan Tüzün",
    "Yağmur",
    "Erkan Pınarbaşı",
    "Betül",
    "Çağlar",
    "Beste Gökoğlu",
    "Işıl",
    "Can",
    "Nuriye",
    "Özlem Ergün",
    "Ayşegül",
    "Flört",
    "Sis",
    "Sena Akti",
    "Sencer Türkiş",
    "Ateş",
    "Anıl Özkeleş",
    "Fatoş",
    "Sina Tanış",
    "Fersun Çelikiş",
    "Neşe",
    "Kadir Aşk",
    "İmran Başbuğ",
    "Başak Savaşçı",
    "Bulut Barutçu",
    "Veli Baltacı",
    "Ege Atıcı",
    "Burcu Öztuna",
    "Belgin Koca",
    "Nesrin Tuna",
    "Ahmet Bolu",
    "Gülçin Sarı",
    "Zehra Gül Konya",
    "İsmail Bora",
    "Gönenç Ünlü",
    "Elif İrem Koç",
    "Esra Aydoğdu",
    "Mustafa Özaytaç",
    "Ümra",
    "Büşra",
    "Buğra",
    "Su",
    "Cüneyt Gelibolu",
    "İzmir Üniversitesi",
    "İzmir",
    "Üniversite",
    "Mustafa Kemal Atatürk",
    "Türkiye",
    "Amerika Birleşik Devletleri",
    "Birleşik Krallık"
);

if(isset($_GET['i'])) {
    $isim = ucwords($_GET['i']);    //  !Warning: There is a bug for "i" letter when uppercase it to "İ". PHP makes "i" to "I".

    $ilk = preg_split("/ /", microtime());
    $ilk = $ilk[0] + $ilk[1];

    makeBlock($isim);

    $son = preg_split("/ /", microtime());
    $son = $son[0] + $son[1];

    echo "<p>" . ($son - $ilk) . " seconds for " . $isim . "</p>";
}

if(isset($_GET['stress'])) {
    $ilk = preg_split("/ /", microtime());
    $ilk = $ilk[0] + $ilk[1];

    for($i = 0; $i < count($rapokisi); $i++) {
        $isim = ucwords($rapokisi[$i]);   //  !Warning: There is a bug for "i" letter when uppercase it to "İ". PHP makes "i" to "I".
        makeBlock($isim);
    }

    $son = preg_split("/ /", microtime());
    $son = $son[0] + $son[1];

    echo "<p>" . ($son - $ilk) . " seconds for <b>" . count($rapokisi) . "</b> names</p>";
}

function makeBlock($isim) {
    echo "<blockquote>";
    echo "<b>Belirtme (Accusative) :</b> " . Turkce::belirtmeHali($isim) . "<br>";
    echo "<b>Yönelme (Dative) :</b> " . Turkce::yonelmeHali($isim) . "<br>";
    echo "<b>Bulunma (Locative) :</b> " . Turkce::bulunmaHali($isim) . "<br>";
    echo "<b>Ayrılma (Ablative) :</b> " . Turkce::ayrilmaHali($isim) . "<br>";
    echo "<b>Sahiplik (Genitive) :</b> " . Turkce::sahiplikHali($isim) . "<br>";
    echo "<b>Vasıta (Comitative) :</b> " . Turkce::vasitaHali($isim) . "<br>";
    echo "<b>Dahi Bağlacı (Conjunction) :</b> " . Turkce::dahiBaglac($isim) . "<br>";
    echo "</blockquote>";
}

?>
</body>
</html>
