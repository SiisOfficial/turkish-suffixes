# turkish-suffixes
_**A PHP Class for proper noun suffixes in Turkish Language.**_

This project is ~5 years old. I wrote all the functions and variables in Turkish back then. We'll update the project for a better readability.

Because of the PHP's UTF-8 case-insensitive bug, this Class may not be work correctly for uppercase names. We'll update it later.

Should work with PHP >=4.0.6, but we recommend PHP >=5

_Not tested with PHP 7!_

_(May not work as perfect as a Turkish/Literature teacher, because the Turkish Language is very complicated when using suffixes.)_

--

_**Türkçe'deki özel isim hal ekleri (ve dahi bağlacı) için bir PHP Sınıfı.**_

Bu proje yaklaşık 5 senelik. Zamanında Türkçe olarak ve kendimce kısaltmalarla yazdım; ama yakın bir zamanda daha anlaşılır olması için güncelleyeceğiz.

PHP'deki UTF-8 karakterlerdeki küçük/büyük harf duyarlılığı ile ilgili bug'ı yüzünden büyük harfli tüm isimlere ekleri doğru getirmeyebilir. Yakında güncelleyeceğiz.

PHP 4.0.6 ve sonrasında çalışıyor olmalı; fakat PHP 5 ve yukarısı önerilir.

_PHP 7 ile test edilmedi!_

_(Lütfen tüm isimlerde kusursuz sonuç veremeyeceğini unutmayın. Türkçe zor bir dil ve aslında bu ekler getirilirken ismin tamlama olup olmamasına da bakılması gerekiyor. Yapmış olduğumuz sınıf, ismin tamlama olup olmadığını sadece tahmin etmeye çalışıyor; ancak, haliyle, tüm isimlerle test etmedim.)_

# Usage | Kullanım

_For full usage example and performance info, please see the demo file._

It's actually very easy, just include Turkce Class to your php file, like:

`require_once("Turkce.php");`

and then use it for a name like this (all functions are static):

`Turkce::bulunmaHali("Utku");`

and Turkce Class returns "Utku" as:

`Utku'da`

That's all folks!

--

_Lütfen tam kullanım örnekleri ve performans bilgisi için demo dosyasına göz atın._

Aslında oldukça basit, sadece Turkce sınıfını php dosyanıza dahil edin, mesela:

`require_once("Turkce.php");`

sonra bir isme uygulamak için, şu şekilde kullanın (tüm fonksiyonlar statik):

`Turkce::bulunmaHali("Utku");`

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


# Thanks | Teşekkür

Thank you, for your interest. Thank you future contributors, for your future contributions. Thank you Müge Bora Bayraktar, for helping me.

--

Öncelikle ilgin için sana teşekkür ederiz, buraya kadar yorduk seni.
Ardından gelecekte katkı sağlayacak kişilere, sağlayacakları katkılar için teşekkür ederiz.
Son olarak da Müge Bora Bayraktar'a yardımları için teşekkür ederiz.