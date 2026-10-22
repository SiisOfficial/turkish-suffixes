<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Turkish Suffixes PHP Demo</title>
</head>
<body>
<form method="get" action="">
    <input type="text" name="i" value="<?= isset($_GET['i']) ? htmlspecialchars($_GET['i']) : '' ?>" placeholder="İsim yaz...">
    <button type="submit">wubba lubba dub dub</button>
    <a href="?stress=test">Stress Test</a>
</form>
<?php
require_once("../php/Turkce.php");

$Nouns = array(
    // Tarihi & Tanınmış Kişiler
    "Mustafa Kemal Atatürk",
    "Barış Manço",
    "Kemal Sunal",
    "Aziz Sancar",
    "Cahit Arf",
    "Yaşar Kemal",
    "Nazım Hikmet",
    "Haluk Bilginer",

    // Kısa & Tek Heceli İsimler
    "Su",
    "Ali",
    "Can",
    "Cem",
    "Ece",
    "Efe",
    "Ela",
    "Ada",
    "Nil",
    "Nur",
    "Gül",
    "Tan",
    "Alp",

    // -oğlu ve Tamlama Soyisimleri / Ünvanlar
    "Sipahioğlu",
    "Hacıoğlu",
    "Velioğlu",
    "Çobanoğlu",
    "İmamoğlu",
    "Köroğlu",
    "Dede Korkut",
    "Bilge Kağan",

    // Şehirler & Coğrafi Yer Adları
    "Türkiye",
    "İstanbul",
    "Ankara",
    "İzmir",
    "Eskişehir",
    "Çanakkale",
    "Van Gölü",
    "Ağrı Dağı",
    "Tuz Gölü",
    "Karadeniz",
    "Boğaziçi",

    // Yaygın Türkçe İsimler
    "Ahmet",
    "Mehmet",
    "Ayşe",
    "Fatma",
    "Mustafa",
    "Zeynep",
    "Emre",
    "Burak",
    "Çağlar",
    "Tuğçe",
    "Yağmur",
    "Gökçe",
    "Oğuz",
    "Alperen",
    "Göktürk",

    // Teknoloji & Markalar
    "Apple",
    "Google",
    "Twitter",
    "YouTube",
    "Chrome",
    "Steam",
    "Valve",
    "Discord",
    "Twitch",
    "Netflix",
    "Spotify",
    "Unity",
    "Skype",
    "Snapchat",
    "Adobe",
    "GitHub",
    "Bitbucket",
    "PayPal",
    "Xbox",
    "PlayStation",
    "Nintendo Switch",
    "Steam Deck",
    "Nvidia",
    "OpenAI",
    "ChatGPT",
    "Gemini",
    "Claude",
    "Copilot",
    "TikTok",
    "Threads",
    "Reels",
    "Shorts",
    "Uber",
    "IMDb",
    "CERN",

    // Cihazlar & İşletim Sistemleri
    "iPhone",
    "iPad",
    "Apple Watch",
    "Mac",
    "MacBook",
    "macOS",
    "iOS",
    "iPadOS",
    "visionOS",
    "watchOS",
    "tvOS",
    "Android",
    "Windows",
    "Linux",
    "SteamOS",

    // Kısaltmalar & Alfanümerik Kodlar / Bloklar
    "TDK",
    "TRT",
    "TBMM",
    "KDV",
    "ODTÜ",
    "İTÜ",
    "TÜBİTAK",
    "GPS",
    "PDF",
    "1B",
    "2C",
    "3D",
    "4A",
    "10F",
    "Blok A",
    "Daire 3B",

    // İnce Ünlü İstisnaları (Büyük Ünlü Uyumunu Bozanlar)
    "Saat",
    "Rol",
    "Gol",
    "Alkol",
    "Kalp",
    "Petrol",
    "Santral",
    "Hilal",
    "Terminal",
    "Moral",
    "General",
    "Festival",
    "Sembol",
    "Kontrol",
    "Protokol",

    // İsim Tamlamaları (Kaynaştırma Harfi 'n' Alanlar)
    "Soyunma Odası",
    "Yoğun Bakım Ünitesi",
    "Ayma Kısmı",
    "Giriş Kapısı",
    "Çocuk Parkı",
    "Otobüs Terminali",
    "Halk Kütüphanesi",
    "Kültür Merkezi",
    "Emniyet Müdürlüğü",
    "Sağlık Ocağı",
    "Fen Lisesi",
    "Anadolu Lisesi",
    "Devlet Hastanesi",
    "Bilgisayar Mühendisliği",
    "Uzay İstasyonu",
    "Güneş Sistemi",
    "Futbol Kulübü",
    "Öğretmenler Odası",
    "Deniz Yolu",
    "Kaza Raporu",

    // Kurgusal Diyarlar & Fantastik / Bilimkurgu Mekanları
    "Gondor",
    "Mordor",
    "Rivendell",
    "Hogwarts",
    "Winterfell",
    "Valyria",
    "Azeroth",
    "Stormwind",
    "Orgrimmar",
    "Tatooine",
    "Coruscant",
    "Cybertron",
    "Gotham",
    "Metropolis",
    "Arrakis",
    "Caladan",
    "Rivia",
    "Kaer Morhen",
    "Tristram",
    "Sanctuary",
    "Night City",
    "Novigrad",
    "Whiterun",
    "Moria",
    "Rohan",
    "Isengard",
    "Narnia",
    "Wakanda",
    "Atlantis",
    "Krypton",

    // Kurgusal Varlıklar & Karakter Sınıfları
    "Elf",
    "Ork",
    "Hobbit",
    "Ejderha",
    "Gryphon",
    "Centaur",
    "Pegasus",
    "Cyborg",
    "Droid",
    "Sith",
    "Jedi",
    "Titan",
    "Golem",
    "Phoenix",
    "Vampir",

    // Sert Sessizle Biten Kelimeler & Tırnaklı Testler
    "\"Matrix\"",
    "'Inception'",
    "\"Star Wars\"",
    "'Dune'",
    "Aşk",
    "Dert",
    "Kitap",
    "Renk",
    "Ağaç",
    "Bulut",
    "Kutup",
    "Hukuk",
    "Park",
    "Kart",
    "Kilit",
    "Dünya",
    "World",

    // Semboller & Para Birimleri
    "₺",
    "€",
    "$",
    "£",
    "¥",
    "TL",
    "+",

    // Sayılar
    0,
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
    14,
    20,
    24,
    30,
    40,
    44,
    50,
    60,
    70,
    74,
    80,
    90,
    100,
    104,
    200,
    500,
    1000,
    1923,
    2024,
    2026,
    10000,
    50000,
    100000,
    1000000,
    1000000000,
    1000000000000
);

if(isset($_GET['i'])) {
    $noun = $_GET['i'];

    $first_time = preg_split("/ /", microtime());
    $first_time = $first_time[0] + $first_time[1];

    makeBlock($noun);

    $last_time = preg_split("/ /", microtime());
    $last_time = $last_time[0] + $last_time[1];

    echo "<p>" . ($last_time - $first_time) . " seconds for " . htmlspecialchars($noun) . "</p>";
}

if(isset($_GET['stress'])) {
    $first_time = preg_split("/ /", microtime());
    $first_time = $first_time[0] + $first_time[1];

    for($i = 0; $i < count($Nouns); $i++) {
        $noun = $Nouns[$i];
        makeBlock($noun);
    }

    $last_time = preg_split("/ /", microtime());
    $last_time = $last_time[0] + $last_time[1];

    echo "<p>" . ($last_time - $first_time) . " seconds for <b>" . count($Nouns) . "</b> names</p>";
}

function makeBlock($noun) {
    if($noun == "World") {
        echo "<blockquote>";
        echo "<b>Belirtme (Accusative) :</b> " . Turkce::accusativeCase("öld", $noun) . "<br>";
        echo "<b>Yönelme (Dative) :</b> " . Turkce::yonelmeHali("öld", $noun) . "<br>";
        echo "<b>Bulunma (Locative) :</b> " . Turkce::bulunmaHali("öld", $noun) . "<br>";
        echo "<b>Ayrılma (Ablative) :</b> " . Turkce::ayrilmaHali("öld", $noun) . "<br>";
        echo "<b>Sahiplik (Genitive) :</b> " . Turkce::sahiplikHali("öld", $noun) . "<br>";
        echo "<b>Vasıta (Comitative) :</b> " . Turkce::vasitaHali("öld", $noun) . "<br>";
        echo "<b>Dahi Bağlacı (Conjunction) :</b> " . Turkce::dahiBaglac("öld", $noun) . "<br>";
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
        echo "<b>Dahi Bağlacı (Conjunction) :</b> " . Turkce::dahiBaglac($noun) . "<br>";
        echo "<b>Sıra Sayı (Ordinal Number) :</b> " . Turkce::siraSayi($noun) . "<br>";
        echo "<b>Üleştirme (Distributive) :</b> " . Turkce::ulestirme($noun) . "<br>";
        echo "</blockquote>";
    }
}
?>
</body>
</html>