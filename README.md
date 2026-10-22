# turkish-suffixes
_**A PHP/C# Class & JS Functions for proper noun and number suffixes in Turkish Language.**_

Should work with PHP >=5.4 up to PHP 8.x, .NET >=2.0, modern .NET, Unity (including Unity 6), and all modern browsers.

_(May not work as perfect as a Turkish/Literature teacher, because the Turkish Language is very complicated when using suffixes.)_

--

_**Türkçe'deki özel isim ve sayılardaki hal ekleri (ve dahi bağlacı) için PHP, C# ve JavaScript kütüphanesi.**_

PHP >=5.4 ve PHP 8.x sürümlerinde, .NET >=2.0 ve modern .NET'te, Unity'de (Unity 6 dahil) ve tüm modern tarayıcılarda sorunsuz çalışır.

_(Lütfen tüm isimlerde kusursuz sonuç veremeyeceğini unutmayın. Türkçe zor bir dil ve aslında bu ekler getirilirken ismin tamlama olup olmamasına da bakılması gerekiyor. Yapmış olduğumuz sınıf, ismin tamlama olup olmadığını sadece tahmin etmeye çalışıyor; ancak, haliyle, tüm isimlerle test etmedim.)_

# Features | Özellikler

- **Full Turkish Case Support:** Belirtme (`-i`), Yönelme (`-e`), Bulunma (`-de`), Ayrılma (`-den`), Sahiplik (`-in`), Vasıta (`ile`), Dahi Bağlacı (`da/de`), Sıra Sayıları (`-nci`), Üleştirme (`-er`).
- **Compound Noun Detection (İsim Tamlamaları):** Otomatik kaynaştırma harfi tespiti (`Soyunma Odası'na`, `Ayma Kısmı'na`, `Yoğun Bakım Ünitesi'ne`).
- **Thin Vowel Exceptions (İnce Ünlü İstisnaları):** Büyük ünlü uyumuna uymayan yabancı kökenli kelimeler için doğru ekleme (`Saat'e`, `Rol'e`, `Gol'ü`, `Alkol'e`, `Kalp'e`, `Petrol'e`).
- **Acronyms & Alphanumerics:** Sesli harf içermeyen kısaltmalar ve tek harfli bloklar (`TDK'ye`, `TRT'ye`, `1B'ye`, `Kan Grubu A'ya`).
- **Short Aliases:** Hızlı yazım için kısa metotlar (`.Yi()`, `.Ye()`, `.De()`, `.Den()`, `.Nin()`, `.Ile()`, `.Dahi()`, `.Nci()`, `.Er()`).
- **Unity Localization Support:** Unity Smart String / Formatter eklentisi hazır olarak gelir.

# Usage | Kullanım

_For full usage example and performance info, please see the demo files or check http://siis.com.tr/turkish-suffixes page._

It's actually very easy, just include Turkce to you project, like:

_PHP_
`require_once("Turkce.php");`

_JavaScript_
`<script src="Turkce.min.js"></script>`

and then use it for a name like this (all functions are static for PHP/C#):

_PHP_
`Turkce::bulunmaHali("Utku");` or `Turkce::locativeCase("Utku");` or `Turkce::de("Utku");`

_C#_
`Turkce.bulunmaHali("Utku");` or `Turkce.locativeCase("Utku");` or `Turkce.de("Utku");`

_JavaScript_
`Turkce.bulunmaHali("Utku");` or `Turkce.locativeCase("Utku");` or `Turkce.de("Utku");`

and Turkce Class/Functions returns "Utku" as:

`Utku'da`

#### Unity Localization (Smart Strings)
You can use `csharp/TurkceFormatter.cs` file in your Unity project, and use it directly as a formatter in Smart String:

```text
{player_name:ye()} görev verildi!        -> Ahmet'e görev verildi!
{item_count:er()} paylaştırıldı.         -> 2'şer paylaştırıldı.
{room_name:de()} buluşalım.              -> Soyunma Odası'nda buluşalım.
```

That's all folks!

--

_Lütfen tam kullanım örnekleri ve performans bilgisi için demo dosyalarına ya da http://siis.com.tr/turkish-suffixes sayfasına göz atın._

Aslında oldukça basit, sadece Turkce'yi projenize dahil edin, mesela:

_PHP_
`require_once("Turkce.php");`

_JavaScript_
`<script src="Turkce.js"></script>`

sonra bir isme uygulamak için, şu şekilde kullanın (PHP/C#'ta tüm fonksiyonlar statik):

_PHP_
`Turkce::bulunmaHali("Utku");` veya `Turkce::locativeCase("Utku");` veya `Turkce::de("Utku");`

_C#_
`Turkce.bulunmaHali("Utku");` veya `Turkce.locativeCase("Utku");` veya `Turkce.de("Utku");`

_JavaScript_
`Turkce.bulunmaHali("Utku");` veya `Turkce.locativeCase("Utku");` veya `Turkce.de("Utku");`

ve Turkce sınıfı "Utku" ismini şu hale getirsin:

`Utku'da`

#### Unity Localization (Smart Strings)
`csharp/TurkceFormatter.cs` dosyasını Unity projenize eklediğinizde Smart String içinde doğrudan formatlayıcı olarak kullanabilirsiniz de yani:

```text
{player_name:ye()} görev verildi!        -> Ahmet'e görev verildi!
{item_count:er()} paylaştırıldı.         -> 2'şer paylaştırıldı.
{room_name:de()} buluşalım.              -> Soyunma Odası'nda buluşalım.
```


Bu kadar basit!

# For What? | Neden?

For: `Ali'yi silmek istediğinizden emin misiniz?` or `Ali'nin karnı acıktı.`

Not: `Ali adlı kullanıcıyı silmek istediğinizden emin misiniz?` or `Ali adlı kullanıcının karnı acıktı.`

Or not: `Şu kullanıcıyı silmek istediğinize emin misiniz: Ali` or `Karnı acıktı: Ali`

Briefly: For proper usage of Turkish.

--

Bunun için: `Ali'yi silmek istediğinizden emin misiniz?` veya `Ali'nin karnı acıktı.`

Şu olmasın diye: `Ali adlı kullanıcıyı silmek istediğinizden emin misiniz?` veya  `Ali adlı kullanıcının karnı acıktı.`

Ya da şu: `Şu kullanıcıyı silmek istediğinize emin misiniz: Ali` veya  `Karnı acıktı: Ali`

Özetle: Türkçe'nin daha doğru kullanımı için.

# Bugs | Sorunlar

Didn't noticed any wrong suffix so far; but if you find, please open an issue at least.

--

Şu ana kadar yanlış ek geldiğini görmedik; fakat bulursanız, lütfen en azından bir "issue" oluşturun.


# Notes | Notlar

Not well tested C# Class. It may have performance issues. Please don't hesitate to report bugs.

--

C# sınıfı çok iyi test edilmedi. Performans sorunları olabilir. Lütfen sorunları bildirmekten çekinmeyiniz.

# Thanks | Teşekkür

Thank you, for your interest. Thank you future contributors, for your future contributions. Thank you Müge Bora Bayraktar, for helping me.

--

Öncelikle ilgin için sana teşekkür ederiz, buraya kadar yorduk seni.
Ardından gelecekte katkı sağlayacak kişilere, sağlayacakları katkılar için teşekkür ederiz.
Son olarak da Müge Bora Bayraktar'a yardımları için teşekkür ederiz.
