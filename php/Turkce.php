<?php

/**
 * Author: A. Utku Sipahioğlu (http://teorikdeli.com)
 * Company: Siis (https://siis.com.tr | https://siisgames.com) & Blay Games (https://blaygames.com)
 *
 * License: MIT
 * https://github.com/SiisOfficial/turkish-suffixes
 *
 * Demo & detailed usage: https://siis.com.tr/turkish-suffixes
 *
 * Version: 1.6
 */

class Turkce
{
	/*
	|--------------------------------------------------------------------------
	| Turkish Case Suffixes Class For PHP
	|--------------------------------------------------------------------------
	|
	|   Should work with PHP >=5.4 up to PHP 8.x.
	|
	|   --------
	|
	|   PHP 5.4 ve PHP 8.x sürümlerinde çalışıyor olmalı.
	|
	*/

	private static $nounPhraseEnds = '/(*UTF8)(oğlu|esi|aşı|işi|eşi|ağı|isi|iği|ığı|ıgı|oglu|okulu|leri|ları|lari|üğü|kısmı|kismi|bölümü|bolumu|merkezi|[aıeiouöü]s[ıiuü])$/ui';

	//  This is a backup solution for noun phrases.
	//  We'll directly look for the last word.
	//  If $nouns count is more than one
	//  and $last_noun (word) is in this array,
	//  it's probably a noun phrase.
	private static $nounPhraseWords = [
		"okulu",
		"odası",
		"güzeli",
		"paneli",
		"suyu",
		"denizi",
		"gölü",
		"yolu",
		"lisesi",
		"oğlu",
		"kısmı",
		"bölümü",
		"merkezi",
		"ünitesi"
	];

	//  Thin vowel exceptions (words with back vowels that take front-vowel suffixes)
	private static $thinVowelExceptions = [
		"saat",
		"rol",
		"gol",
		"alkol",
		"kalp",
		"petrol",
		"santral",
		"hilal",
		"terminal",
		"moral",
		"general",
		"festival",
		"sembol",
		"kontrol",
		"protokol"
	];

	private static $vowelRegex = '/(*UTF8)[oueiöüaıOUEİÖÜAI]/u';

	//  Single letters for acronyms without vowels (TDK, TRT, 1B, etc.)
	private static $singleLetters = [
		"a" => "a", "b" => "be", "c" => "ce", "ç" => "çe", "d" => "de",
		"e" => "e", "f" => "fe", "g" => "ge", "ğ" => "ğe", "h" => "he",
		"ı" => "ı", "i" => "i", "j" => "je", "k" => "ke", "l" => "le",
		"m" => "me", "n" => "ne", "o" => "o", "ö" => "ö", "p" => "pe",
		"r" => "re", "s" => "se", "ş" => "şe", "t" => "te", "u" => "u",
		"ü" => "ü", "v" => "ve", "y" => "ye", "z" => "ze",
		"q" => "kü", "w" => "ve", "x" => "iks"
	];

	//  This is the simplest & fastest solution for now.
	//  I really don't want to check last noun of given $noun,
	//  bacause (for example vive) last noun can be a Turkish brand or something.
	//  I'd suggest you to use $fake (like Turkce::accusativeCase("yıv", "view");).
	//
	//  Only for some brands, people, products, etc.
	private static $pronounces = [
		"apple" => "pıl",
		"google" => "gıl",
		"twitter" => "tır",
		"youtube" => "tup",
		"chrome" => "rom",
		"developer" => "pır",
		"board" => "ord",
		"cardboard" => "ord",
		"iphone" => "fon",
		"ipad" => "ped",
		"watch" => "voç",
		"imessage" => "sıc",
		"mac" => "mek",
		"macbook" => "buk",
		"php" => "çpi",
		"steam" => "tim",
		"valve" => "alv",
		"messenger" => "cır",
		"snapchat" => "çet",
		"chat" => "çet",
		"skype" => "ayp",
		"unity" => "iti",
		"spotify" => "fay",
		"htc" => "ysi",
		"half-life" => "ayf",
		"halflife" => "ayf",
		"htcvive" => "avy",
		"9gag" => "geg",
		"tv" => "ivi",
		"usa" => "sey",
		"maps" => "eps",
		"cern" => "örn",
		"adobe" => "dob",
		"imdb" => "ibi",
		"italy" => "ali",
		"store" => "tor",
		"appstore" => "tor",
		"playstore" => "tor",
		"psn" => "esen",
		"xboxlive" => "ayv",
		"einstein" => "ayn",
		"xcode" => "kod",
		"github" => "hab",
		"bitbucket" => "kıt",
		"slipknot" => "nat",
		"maiden" => "dın",
		"slayer" => "yır",
		"thrones" => "ons",
		"simpsons" => "ıns",
		"guy" => "gay",
		"wars" => "ors",
		"vader" => "dır",
		"beethoven" => "vın",
		"vr" => "yar",
		"ar" => "yar",
		"station" => "şın",
		"steamvr" => "yar",
		"osvr" => "yar",
		"first" => "öst",
		"engine" => "cin",
		"cryengine" => "cin",
		"$" => "lar",
		"€" => "uro",
		"₺" => "ele",
		"¥" => "yen",
		"£" => "lin",
		"tl" => "ele",
		"+" => "tı",
		"ios" => "ayoes",
		"macos" => "oes",
		"tvos" => "oes",
		"watchos" => "oes",
		"ipados" => "oes",
		"visionos" => "oes",
		"android" => "yid",
		"windows" => "dovs",
		"steamos" => "oes",
		"linux" => "nuks",
		"deck" => "dek",
		"frame" => "reym",
		"machine" => "şin",
		"switch" => "viç",
		"center" => "tır",
		"services" => "sız",
		"support" => "port",
		"supporter" => "tır",
		"discord" => "kord",
		"paypal" => "pal",
		"street" => "rit",
		"game" => "geym",
		"play" => "ley",
		"blay" => "ley",
		"playstation" => "şın",
		"xbox" => "baks",
		"series" => "riz",
		"edition" => "şın",
		"max" => "meks",
		"plus" => "plas",
		"ai" => "eyay",
		"openai" => "eyay",
		"chatgpt" => "piti",
		"gpt" => "piti",
		"gemini" => "nay",
		"claude" => "klod",
		"copilot" => "lıt",
		"threads" => "reds",
		"tiktok" => "tok",
		"reels" => "ılz",
		"shorts" => "şorts",
		"twitch" => "viç",
		"netflix" => "fliks",
		"nvidia" => "vidya"
	];

	public static function filterAndTrim($noun)
	{
		return trim(preg_replace('/[^0-9a-zA-ZğĞüÜöÖşŞıİçÇ\s₺€$¥£]/u', '', (string)$noun));
	}

	public static function substr($noun, $charLength)
	{
		$len = mb_strlen((string)$noun, 'utf-8');
		if($len === 0)
			return "";
		return $charLength >= $len ? $noun : mb_substr($noun, $len - $charLength, $charLength, 'utf-8');
	}

	private static function toTurkishLower($text)
	{
		$text = strtr((string)$text, ["İ" => "i", "I" => "ı"]);
		return mb_strtolower($text, 'utf-8');
	}

	private static function checkHasPronounce($n)
	{
		$n = trim((string)$n);
		if($n === '')
			return null;

		$words = preg_split('/\s+/u', $n);
		$lastWord = self::toTurkishLower(end($words));

		if((mb_substr($lastWord, 0, 1, 'utf-8') === '#' || mb_substr($lastWord, 0, 1, 'utf-8') === '@') && mb_strlen($lastWord, 'utf-8') > 1)
		{
			$key = mb_substr($lastWord, 1, null, 'utf-8');
			if(isset(self::$pronounces[$key]))
				return self::$pronounces[$key];
		}

		if(isset(self::$pronounces[$lastWord]))
			return self::$pronounces[$lastWord];

		if(preg_match('/(^|\d+|[\s\-_])([a-zA-ZğĞüÜöÖşŞıİçÇ])$/u', $n, $matches))
		{
			$char = self::toTurkishLower($matches[2]);
			if(isset(self::$singleLetters[$char]))
				return self::$singleLetters[$char];
		}

		// Acronym without vowels fallback (TDK, TRT, etc.)
		if(mb_strlen($lastWord, 'utf-8') > 1 && !preg_match(self::$vowelRegex, $lastWord))
		{
			$lastChar = mb_substr($lastWord, -1, 1, 'utf-8');
			if(isset(self::$singleLetters[$lastChar]))
				return self::$singleLetters[$lastChar];
		}

		return null;
	}

	private static function isNounPhrase($nouns, $last_noun)
	{
		if(count($nouns) <= 1)
			return false;
		$clean = self::toTurkishLower(trim($last_noun));
		return in_array($clean, self::$nounPhraseWords) || preg_match(self::$nounPhraseEnds, $clean);
	}

	private static function isThinException($word)
	{
		$w = self::toTurkishLower(trim($word));
		return in_array($w, self::$thinVowelExceptions);
	}

	private static function getLastVowel($text)
	{
		$len = mb_strlen($text, 'utf-8');
		$vowels = ['a', 'e', 'ı', 'i', 'o', 'ö', 'u', 'ü', 'A', 'E', 'I', 'İ', 'O', 'Ö', 'U', 'Ü'];
		for($i = $len - 1; $i >= 0; $i--)
		{
			$ch = mb_substr($text, $i, 1, 'utf-8');
			if(in_array($ch, $vowels))
				return $ch;
		}

		return null;
	}

	private static function formatOutput($orgNoun, $blending, $suffix)
	{
		$hasQuote = preg_match('/["\']$/u', $orgNoun);
		return $orgNoun . ($hasQuote ? '' : "'") . $blending . $suffix;
	}

	public static function belirtmeHali($noun, $fake = false)
	{
		$orgNoun = trim((string)$noun);
		$noun = self::filterAndTrim($orgNoun);
		$isFake = $fake !== false && $fake !== "";

		if(!$isFake)
		{
			$fake_ = self::checkHasPronounce($noun);
			if($fake_ !== null)
			{
				$fake = $orgNoun;
				$noun = $fake_;
				$isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(preg_match('/\d$/u', $noun))
			return self::processForNumber(__FUNCTION__, $orgNoun);

		$last_letter = self::substr($noun, 1);
		$last_3 = self::substr($noun, 3);
		$nouns = preg_split('/\s+/u', $noun, -1, PREG_SPLIT_NO_EMPTY);
		$last_noun = !empty($nouns) ? end($nouns) : "";

		if($isFake)
			$orgNoun = $fake;

		$blending = "";
		if(mb_strlen($last_letter, 'utf-8') > 0 && preg_match(self::$vowelRegex, $last_letter))
			$blending = "y";

		if(self::isNounPhrase($nouns, $last_noun))
			$blending = "n";

		$suffix = "i";
		if(self::isThinException($last_noun))
		{
			$suffix = "i";
		}
		else
		{
			$last_vowel = self::getLastVowel($last_3);
			if($last_vowel !== null)
			{
				$v = self::toTurkishLower($last_vowel);
				if($v === 'ö' || $v === 'ü')
					$suffix = "ü";
				else if($v === 'a' || $v === 'ı')
					$suffix = "ı";
				else if($v === 'o' || $v === 'u')
					$suffix = "u";
			}
		}

		return self::formatOutput($orgNoun, $blending, $suffix);
	}

	public static function accusativeCase($noun, $fake = false) { return self::belirtmeHali($noun, $fake); }
	public static function yi($noun, $fake = false) { return self::belirtmeHali($noun, $fake); }

	public static function yonelmeHali($noun, $fake = false)
	{
		$orgNoun = trim((string)$noun);
		$noun = self::filterAndTrim($orgNoun);
		$isFake = $fake !== false && $fake !== "";

		if(!$isFake)
		{
			$fake_ = self::checkHasPronounce($noun);
			if($fake_ !== null)
			{
				$fake = $orgNoun;
				$noun = $fake_;
				$isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(preg_match('/\d$/u', $noun))
			return self::processForNumber(__FUNCTION__, $orgNoun);

		$last_letter = self::substr($noun, 1);
		$last_3 = self::substr($noun, 3);
		$nouns = preg_split('/\s+/u', $noun, -1, PREG_SPLIT_NO_EMPTY);
		$last_noun = !empty($nouns) ? end($nouns) : "";

		if($isFake)
			$orgNoun = $fake;

		$blending = "";
		if(mb_strlen($last_letter, 'utf-8') > 0 && preg_match(self::$vowelRegex, $last_letter))
			$blending = "y";

		if(self::isNounPhrase($nouns, $last_noun))
			$blending = "n";

		$suffix = "e";
		if(!self::isThinException($last_noun))
		{
			$last_vowel = self::getLastVowel($last_3);
			if($last_vowel !== null)
			{
				$v = self::toTurkishLower($last_vowel);
				if($v === 'a' || $v === 'ı' || $v === 'o' || $v === 'u')
					$suffix = "a";
			}
		}

		return self::formatOutput($orgNoun, $blending, $suffix);
	}

	public static function dativeCase($noun, $fake = false) { return self::yonelmeHali($noun, $fake); }
	public static function ye($noun, $fake = false) { return self::yonelmeHali($noun, $fake); }

	public static function bulunmaHali($noun, $fake = false)
	{
		$orgNoun = trim((string)$noun);
		$noun = self::filterAndTrim($orgNoun);
		$isFake = $fake !== false && $fake !== "";

		if(!$isFake)
		{
			$fake_ = self::checkHasPronounce($noun);
			if($fake_ !== null)
			{
				$fake = $orgNoun;
				$noun = $fake_;
				$isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(preg_match('/\d$/u', $noun))
			return self::processForNumber(__FUNCTION__, $orgNoun);

		$last_letter = self::substr($noun, 1);
		$last_3 = self::substr($noun, 3);
		$nouns = preg_split('/\s+/u', $noun, -1, PREG_SPLIT_NO_EMPTY);
		$last_noun = !empty($nouns) ? end($nouns) : "";

		if($isFake)
			$orgNoun = $fake;

		$blending = "";
		if(self::isNounPhrase($nouns, $last_noun))
			$blending = "n";

		$suffix = "d";
		$suffix_ = "e";

		if(preg_match('/(*UTF8)[pçktfşhPÇKTFŞH]/u', $last_letter))
			$suffix = "t";
		if(preg_match('/(*UTF8)şk|ŞK/u', $last_3))
			$suffix_ = "a";

		if(!self::isThinException($last_noun))
		{
			$last_vowel = self::getLastVowel($last_3);
			if($last_vowel !== null)
			{
				$v = self::toTurkishLower($last_vowel);
				if($v === 'a' || $v === 'ı' || $v === 'o' || $v === 'u')
					$suffix_ = "a";
				else if($v === 'e' || $v === 'i' || $v === 'ö' || $v === 'ü')
					$suffix_ = "e";
			}
		}

		return self::formatOutput($orgNoun, $blending, $suffix . $suffix_);
	}

	public static function locativeCase($noun, $fake = false) { return self::bulunmaHali($noun, $fake); }
	public static function de($noun, $fake = false) { return self::bulunmaHali($noun, $fake); }

	public static function ayrilmaHali($noun, $fake = false)
	{
		$orgNoun = trim((string)$noun);
		$noun = self::filterAndTrim($orgNoun);
		$isFake = $fake !== false && $fake !== "";

		if(!$isFake)
		{
			$fake_ = self::checkHasPronounce($noun);
			if($fake_ !== null)
			{
				$fake = $orgNoun;
				$noun = $fake_;
				$isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(preg_match('/\d$/u', $noun))
			return self::processForNumber(__FUNCTION__, $orgNoun);

		$last_letter = self::substr($noun, 1);
		$last_3 = self::substr($noun, 3);
		$nouns = preg_split('/\s+/u', $noun, -1, PREG_SPLIT_NO_EMPTY);
		$last_noun = !empty($nouns) ? end($nouns) : "";

		if($isFake)
			$orgNoun = $fake;

		$blending = "";
		if(self::isNounPhrase($nouns, $last_noun))
			$blending = "n";

		$suffix = "d";
		$suffix_ = "e";

		if(preg_match('/(*UTF8)[pçktfşhPÇKTFŞH]/u', $last_letter))
			$suffix = "t";
		if(preg_match('/(*UTF8)şk|ŞK/u', $last_3))
			$suffix_ = "a";

		if(!self::isThinException($last_noun))
		{
			$last_vowel = self::getLastVowel($last_3);
			if($last_vowel !== null)
			{
				$v = self::toTurkishLower($last_vowel);
				if($v === 'a' || $v === 'ı' || $v === 'o' || $v === 'u')
					$suffix_ = "a";
				else if($v === 'e' || $v === 'i' || $v === 'ö' || $v === 'ü')
					$suffix_ = "e";
			}
		}

		return self::formatOutput($orgNoun, $blending, $suffix . $suffix_ . "n");
	}

	public static function ablativeCase($noun, $fake = false) { return self::ayrilmaHali($noun, $fake); }
	public static function den($noun, $fake = false) { return self::ayrilmaHali($noun, $fake); }

	public static function sahiplikHali($noun, $fake = false)
	{
		$orgNoun = trim((string)$noun);
		$noun = self::filterAndTrim($orgNoun);
		$isFake = $fake !== false && $fake !== "";

		if(!$isFake)
		{
			$fake_ = self::checkHasPronounce($noun);
			if($fake_ !== null)
			{
				$fake = $orgNoun;
				$noun = $fake_;
				$isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(preg_match('/\d$/u', $noun))
			return self::processForNumber(__FUNCTION__, $orgNoun);

		$last_letter = self::substr($noun, 1);
		$last_3 = self::substr($noun, 3);
		$nouns = preg_split('/\s+/u', $noun, -1, PREG_SPLIT_NO_EMPTY);
		$last_noun = !empty($nouns) ? end($nouns) : "";

		if($isFake)
			$orgNoun = $fake;

		$blending = "";
		if(mb_strlen($last_letter, 'utf-8') > 0 && preg_match(self::$vowelRegex, $last_letter))
			$blending = "n";

		$suffix = "i";
		if(self::isThinException($last_noun))
		{
			$suffix = "i";
		}
		else
		{
			$last_vowel = self::getLastVowel($last_3);
			if($last_vowel !== null)
			{
				$v = self::toTurkishLower($last_vowel);
				if($v === 'ö' || $v === 'ü')
					$suffix = "ü";
				else if($v === 'a' || $v === 'ı')
					$suffix = "ı";
				else if($v === 'o' || $v === 'u')
					$suffix = "u";
			}
		}

		return self::formatOutput($orgNoun, $blending, $suffix . "n");
	}

	public static function genitiveCase($noun, $fake = false) { return self::sahiplikHali($noun, $fake); }
	public static function nin($noun, $fake = false) { return self::sahiplikHali($noun, $fake); }

	public static function vasitaHali($noun, $fake = false)
	{
		$orgNoun = trim((string)$noun);
		$noun = self::filterAndTrim($orgNoun);
		$isFake = $fake !== false && $fake !== "";

		if(!$isFake)
		{
			$fake_ = self::checkHasPronounce($noun);
			if($fake_ !== null)
			{
				$fake = $orgNoun;
				$noun = $fake_;
				$isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(preg_match('/\d$/u', $noun))
			return self::processForNumber(__FUNCTION__, $orgNoun);

		$last_letter = self::substr($noun, 1);
		$last_3 = self::substr($noun, 3);
		$nouns = preg_split('/\s+/u', $noun, -1, PREG_SPLIT_NO_EMPTY);
		$last_noun = !empty($nouns) ? end($nouns) : "";

		if($isFake)
			$orgNoun = $fake;

		$blending = "";
		if(mb_strlen($last_letter, 'utf-8') > 0 && preg_match(self::$vowelRegex, $last_letter))
			$blending = "y";

		$suffix = "e";
		if(!self::isThinException($last_noun))
		{
			$last_vowel = self::getLastVowel($last_3);
			if($last_vowel !== null)
			{
				$v = self::toTurkishLower($last_vowel);
				if($v === 'a' || $v === 'ı' || $v === 'o' || $v === 'u')
					$suffix = "a";
			}
		}

		return self::formatOutput($orgNoun, $blending, "l" . $suffix);
	}

	public static function comitativeCase($noun, $fake = false) { return self::vasitaHali($noun, $fake); }
	public static function ile($noun, $fake = false) { return self::vasitaHali($noun, $fake); }

	public static function dahiBaglac($noun, $fake = false)
	{
		$orgNoun = trim((string)$noun);
		$noun = self::filterAndTrim($orgNoun);
		$isFake = $fake !== false && $fake !== "";

		if(!$isFake)
		{
			$fake_ = self::checkHasPronounce($noun);
			if($fake_ !== null)
			{
				$fake = $orgNoun;
				$noun = $fake_;
				$isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(preg_match('/\d$/u', $noun))
			return self::processForNumber(__FUNCTION__, $orgNoun);

		$last_3 = self::substr($noun, 3);
		$nouns = preg_split('/\s+/u', $noun, -1, PREG_SPLIT_NO_EMPTY);
		$last_noun = !empty($nouns) ? end($nouns) : "";

		if($isFake)
			$orgNoun = $fake;

		$blending = "d";
		$suffix = "e";

		if(!self::isThinException($last_noun))
		{
			$last_vowel = self::getLastVowel($last_3);
			if($last_vowel !== null)
			{
				$v = self::toTurkishLower($last_vowel);
				if($v === 'a' || $v === 'ı' || $v === 'o' || $v === 'u')
					$suffix = "a";
			}
		}

		return $orgNoun . " " . $blending . $suffix;
	}

	public static function conjunction($noun, $fake = false) { return self::dahiBaglac($noun, $fake); }
	public static function dahi($noun, $fake = false) { return self::dahiBaglac($noun, $fake); }

	public static function siraSayi($number, $integer = false)
	{
		$number = trim((string)$number);
		$isFake = $integer !== false && $integer !== "";

		//  Check the ending if it's a number
		if(preg_match('/\d$/u', $number))
			return self::processForNumber(__FUNCTION__, $number);

		$last_letter = self::substr($number, 1);
		$last_3 = self::substr($number, 3);

		//  Check if the ending with "ört", if so make it "örd" (only for "dört")
		if(self::toTurkishLower($last_3) === "ört")
			$number = mb_substr($number, 0, mb_strlen($number, 'utf-8') - 1, 'utf-8') . ($last_letter === "t" ? "d" : "D");

		if($isFake)
			$number = $integer;

		$last_vowel = self::getLastVowel($last_3);
		$suffix = "i";

		if($last_vowel !== null)
		{
			$v = self::toTurkishLower($last_vowel);
			if($v === 'ö' || $v === 'ü')
				$suffix = "ü";
			else if($v === 'a' || $v === 'ı')
				$suffix = "ı";
			else if($v === 'o' || $v === 'u')
				$suffix = "u";
		}

		$blending = (mb_strlen($last_letter, 'utf-8') > 0 && !preg_match(self::$vowelRegex, $last_letter)) ? $suffix : "";
		return $number . ($isFake ? "'" : "") . $blending . "nc" . $suffix;
	}

	public static function ordinalNumber($number, $integer = false) { return self::siraSayi($number, $integer); }
	public static function nci($number, $integer = false) { return self::siraSayi($number, $integer); }

	public static function ulestirme($number, $integer = false)
	{
		$number = trim((string)$number);
		$isFake = $integer !== false && $integer !== "";

		//  Check the ending if it's a number
		if(preg_match('/\d$/u', $number))
			return self::processForNumber(__FUNCTION__, $number);

		$last_letter = self::substr($number, 1);
		$last_3 = self::substr($number, 3);

		//  Check if the ending with "ört", if so make it "örd" (only for "dört")
		if(self::toTurkishLower($last_3) === "ört")
			$number = mb_substr($number, 0, mb_strlen($number, 'utf-8') - 1, 'utf-8') . ($last_letter === "t" ? "d" : "D");

		if($isFake)
			$number = $integer;

		$blending = "";
		$last_vowel = self::getLastVowel($last_3);
		$suffix = "e";

		if($last_vowel !== null)
		{
			$v = self::toTurkishLower($last_vowel);
			if($v === 'a' || $v === 'ı' || $v === 'o' || $v === 'u')
				$suffix = "a";
		}

		if(mb_strlen($last_letter, 'utf-8') > 0 && preg_match(self::$vowelRegex, $last_letter))
			$blending = "ş";

		return $number . ($isFake ? "'" : "") . $blending . $suffix . "r";
	}

	public static function distributive($number, $integer = false) { return self::ulestirme($number, $integer); }
	public static function er($number, $integer = false) { return self::ulestirme($number, $integer); }

	private static function processForNumber($callback = 'belirtmeHali', $noun = '')
	{
		$filteredNoun = self::filterAndTrim($noun);
		$lastNumberArray = preg_split('/\D+/u', (string)$filteredNoun);
		$lastNumber = "";

		for($i = count($lastNumberArray) - 1; $i >= 0; $i--)
		{
			if($lastNumberArray[$i] !== "")
			{
				$lastNumber = $lastNumberArray[$i];
				break;
			}
		}

		if($lastNumber === "0")
		{
			// it is directly zero
			return call_user_func([__CLASS__, $callback], "fır", $noun);
		}

		//  We don't need a full word, last 3 letters'd be enough
		$endings = [
			"1" => "bir",
			"2" => "iki",
			"3" => "üç",
			"4" => "ört",
			"5" => "beş",
			"6" => "ltı",
			"7" => "edi",
			"8" => "kiz",
			"9" => "kuz",
			"10" => "on",
			"20" => "rmi",
			"30" => "tuz",
			"40" => "ırk",
			"50" => "lli",
			"60" => "mış",
			"70" => "miş",
			"80" => "sen",
			"90" => "san"
		];

		//  last number's length
		$digitLength = mb_strlen($lastNumber, 'utf-8');

		//  Check last number
		$last1 = self::substr($lastNumber, 1);
		if($last1 !== "0" && isset($endings[$last1]))
			return call_user_func([__CLASS__, $callback], $endings[$last1], $noun);

		//  Check last two numbers
		$last2 = self::substr($lastNumber, 2);
		if($last2 !== "00" && isset($endings[$last2]))
			return call_user_func([__CLASS__, $callback], $endings[$last2], $noun);

		//  Check last three numbers
		$last3 = self::substr($lastNumber, 3);
		if($last3 !== "000")
			return call_user_func([__CLASS__, $callback], "yüz", $noun);

		//  Check last four numbers
		$last4 = self::substr($lastNumber, 4);
		if($last4 !== "0000" || $digitLength < 7)
			return call_user_func([__CLASS__, $callback], "bin", $noun);

		//  Check for the rest
		// if this is 8, 11, 14, etc.
		if(($digitLength + 1) % 3 === 0)
			return call_user_func([__CLASS__, $callback], $digitLength % 2 === 0 ? "yon" : "yar", $noun);

		if($digitLength % 3 === 0 || ($digitLength + 2) % 3 === 0)
			return call_user_func([__CLASS__, $callback], $digitLength % 2 === 0 ? "yar" : "yon", $noun);

		return call_user_func([__CLASS__, $callback], $noun, "");
	}
}