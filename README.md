# turkish-suffixes
_**A PHP/C# Class & JS Functions for proper noun and number suffixes in Turkish Language.**_

Should work with PHP >=5, .NET >=2.0 and with all browsers

_Not tested with PHP 7!_

_(May not work as perfect as a Turkish/Literature teacher, because the Turkish Language is very complicated when using suffixes.)_

--

_**Türkçe'deki özel isim ve sayılardaki hal ekleri (ve dahi bağlacı) için bir PHP Sınıfı.**_

PHP >=5'te, .NET >=2.0'da ve tüm tarayıcılarda çalışıyor olmalı.

_PHP 7 ile test edilmedi!_

_(Lütfen tüm isimlerde kusursuz sonuç veremeyeceğini unutmayın. Türkçe zor bir dil ve aslında bu ekler getirilirken ismin tamlama olup olmamasına da bakılması gerekiyor. Yapmış olduğumuz sınıf, ismin tamlama olup olmadığını sadece tahmin etmeye çalışıyor; ancak, haliyle, tüm isimlerle test etmedim.)_

# Usage | Kullanım

_For full usage example and performance info, please see the demo files or check http://siis.com.tr/turkish-suffixes page._

It's actually very easy, just include Turkce to you project, like:

_PHP_
`require_once("Turkce.php");`

_JavaScript_
`<script src="Turkce.min.js"></script>`

and then use it for a name like this (all functions are static for PHP/C#):

_PHP_
`Turkce::bulunmaHali("Utku");` or `Turkce::locativeCase("Utku");`

_C#_
`Turkce.bulunmaHali("Utku");` or `Turkce.locativeCase("Utku");`

_JavaScript_
`Turkce.bulunmaHali("Utku");` or `Turkce.locativeCase("Utku");`

and Turkce Class/Functions returns "Utku" as:

`Utku'da`

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
`Turkce::bulunmaHali("Utku");` veya `Turkce::locativeCase("Utku");`

_C#_
`Turkce.bulunmaHali("Utku");` veya `Turkce.locativeCase("Utku");`

_JavaScript_
`Turkce.bulunmaHali("Utku");` veya `Turkce.locativeCase("Utku");`

ve Turkce sınıfı "Utku" ismini şu hale getirsin:

`Utku'da`

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
