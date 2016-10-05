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
