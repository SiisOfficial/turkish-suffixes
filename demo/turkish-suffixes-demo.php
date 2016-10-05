<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Turkish Suffixes PHP Demo</title>
</head>
<body>
<form method="get" action="">
    <input type="text" name="i" value="<?= $_GET['i'] ?>" placeholder="İsim yaz...">
    <button type="submit">wubba lubba dub dub</button>
    <a href="?stress=test">Stress Test</a>
</form>
<?php
require_once("../php/Turkce.php");

$Nouns = array(
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
    "Birleşik Krallık",
    "World Wide Web",
    "Apple",
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    9,
    10,
    20,
    30,
    40,
    50,
    60,
    70,
    80,
    90,
    100,
    1000,
    1000000,
    1000000000,
    1000000000000
);

if(isset($_GET['i'])) {
    $noun = ucwords($_GET['i']);    //  !Warning: There is a bug for "i" letter when uppercase it to "İ". PHP makes "i" to "I".

    $first_time = preg_split("/ /", microtime());
    $first_time = $first_time[0] + $first_time[1];

    makeBlock($noun);

    $last_time = preg_split("/ /", microtime());
    $last_time = $last_time[0] + $last_time[1];

    echo "<p>" . ($last_time - $first_time) . " seconds for " . $noun . "</p>";
}

if(isset($_GET['stress'])) {
    $first_time = preg_split("/ /", microtime());
    $first_time = $first_time[0] + $first_time[1];

    for($i = 0; $i < count($Nouns); $i++) {
        $noun = ucwords($Nouns[$i]);   //  !Warning: There is a bug for "i" letter when uppercase it to "İ". PHP makes "i" to "I".
        makeBlock($noun);
    }

    $last_time = preg_split("/ /", microtime());
    $last_time = $last_time[0] + $last_time[1];

    echo "<p>" . ($last_time - $first_time) . " seconds for <b>" . count($Nouns) . "</b> names</p>";
}

function makeBlock($noun) {
    if($noun == "Apple") {
        echo "<blockquote>";
        echo "<b>Belirtme (Accusative) :</b> " . Turkce::accusativeCase("pıl", $noun) . "<br>";
        echo "<b>Yönelme (Dative) :</b> " . Turkce::yonelmeHali("pıl", $noun) . "<br>";
        echo "<b>Bulunma (Locative) :</b> " . Turkce::bulunmaHali("pıl", $noun) . "<br>";
        echo "<b>Ayrılma (Ablative) :</b> " . Turkce::ayrilmaHali("pıl", $noun) . "<br>";
        echo "<b>Sahiplik (Genitive) :</b> " . Turkce::sahiplikHali("pıl", $noun) . "<br>";
        echo "<b>Vasıta (Comitative) :</b> " . Turkce::vasitaHali("pıl", $noun) . "<br>";
        echo "<b>Dahi Bağlacı (Conjunction) :</b> " . Turkce::dahiBaglac("pıl", $noun) . "<br>";
        echo "<b>Sıra Sayı (Ordinal Number) :</b> " . Turkce::siraSayi($noun) . "<br>";
        echo "<b>Üleştirme (Distributive) :</b> " . Turkce::ulestirme($noun) . "<br>";
        echo "</blockquote>";
    } else {
        echo "<blockquote>";
        echo "<b>Belirtme (Accusative) :</b> " . Turkce::accusativeCase($noun) . "<br>";
        echo "<b>Yönelme (Dative) :</b> " . Turkce::yonelmeHali($noun) . "<br>";
        echo "<b>Bulunma (Locative) :</b> " . Turkce::bulunmaHali($noun) . "<br>";
        echo "<b>Ayrılma (Ablative) :</b> " . Turkce::ayrilmaHali($noun) . "<br>";
        echo "<b>Sahiplik (Genitive) :</b> " . Turkce::sahiplikHali($noun) . "<br>";
        echo "<b>Vasıta (Comitative) :</b> " . Turkce::vasitaHali($noun) . "<br>";
        echo "<b>Sıra Sayı (Ordinal Number) :</b> " . Turkce::siraSayi($noun) . "<br>";
        echo "<b>Üleştirme (Distributive) :</b> " . Turkce::ulestirme($noun) . "<br>";
        echo "</blockquote>";
    }
}

?>
</body>
</html>
