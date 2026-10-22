## 1.6.0 (2026-10-22)
Features:

- Added thin vowel exceptions support (e.g., Saat'e, Rol'e, Gol'ü, Alkol'e, Kalp'e, Petrol'e, Terminal'e, Sembol'e, Kontrol'e).
- Added automatic pronunciation fallback for all-consonant acronyms and initialisms (e.g., TDK'ye, TRT'ye, TBMM'ye, KDV'ye).
- Added single letter and alphanumeric block/class support (e.g., 1B'ye, Apt 3D'ye, Kan Grubu A'ya).
- Added short aliases across all three languages: yi(), ye(), de(), den(), nin(), ile(), dahi(), nci(), er().
- Added extension method support for C# ("Ahmet".BelirtmeHali(), "Ankara".Ye(), 2.Er()).
- Added Unity 6 and modern .NET support, including Unity Localization Formatter (csharp/TurkceFormatter.cs).
- Added smart trailing quote detection: strings already ending with quotes (" or ') no longer receive redundant apostrophes (e.g., "Matrix"e).

Bugfixes:

- Fixed Issue #1: Compound noun phrase suffixes now correctly use the buffer letter n instead of y for possessive compound endings (e.g., Soyunma Odası'na, Ayma Kısmı'na, Yoğun Bakım Ünitesi'ne).
- Fixed distributive alias calling siraSayi instead of ulestirme in PHP and JS.
- Fixed KeyNotFoundException in C# ProcessForNumber when processing numbers ending in double or triple zeros (100, 2500, etc.).
- Fixed FilterAndTrim regex accidentally removing currency symbols.
- Fixed string literal regex split bug in JavaScript processForNumber.

Performance:
- Modernized C# class for zero-allocation character checks, compiled regexes, and HashSet lookups friendly to Unity GC.
- Optimized PHP UTF-8 multi-byte traversal for PHP 8.x compatibility.

## 1.4.1 (2016-10-07)
Features:

- Added full-js-demo.html (http://siis.com.tr/turkish-suffixes page) for detailed usage and demo.

Bugfixes:

- Fixed ordinalNumber function in JS.

## 1.4 (2016-10-06)
Features:

- Added pronounce check (with hashtag and mention support) for some brands, people, products, etc. for proper suffixes.

Bugfixes:

- Fixed suffix letter for genitive case in JS.
- Fixed problems with distributive and ordinal number methods in C#.

## 1.3 (2016-10-05)

Features:

- Added distributive and ordinal number methods.
- added support for JavaScript🤘🏻
- added support for C#🤘🏻

Bugfixes:

- Fixed a problem for some short words which are contains Turkish letters.
- Added support for "-ığı" suffix.

Changes:

- some long and repetitive regex patterns defined as variables.
- changed $sh variable name to $vowels
- updated readme file.

## 1.2 (2016-09-30)

Features:

- added support for numbers.
- added support for pronounce usage. You can use it like this (last 3 letters of pronounce would be enough): `Turkce::bulunmaHali("epıl", "Apple");` or `Turkce::locativeCase("epıl", "Apple");`
- added .gitignore file.

Bugfixes:

- Tested for PHP's UTF-8 case-insensitive bug and it's working well

Performance:

- Removed logical control for predefined suffix letters.

Changes:

- updated readme file.
- updated demo file for pronounce usage example.

## 1.1 (2016-01-02)

Features:

- added support to use methods with English method names (like `Turkce::locativeCase("Noun");`).

Bugfixes:

- fixed an error for nouns with last 3 letters are consonant (and this gives a little extra performance =)).

Changes:

- updated variable names to English.
- updated readme file.

## 1.0 (2016-02-14)

- initial commit.
