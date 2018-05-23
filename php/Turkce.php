<?php

/**
 * Created by IntelliJ IDEA.
 * Author: A. Utku Sipahioğlu (http://teorikdeli.com)
 * Company: Siis (http://siis.com.tr | http://siisgames.com)
 *
 * License: MIT
 * https://github.com/SiisOfficial/turkish-suffixes
 *
 * Demo & detailed usage: http://siis.com.tr/turkish-suffixes
 *
 * Version: 1.5
 */
class Turkce {
    /*
    |--------------------------------------------------------------------------
    | Turkish Case Suffixes Class For PHP
    |--------------------------------------------------------------------------
    |
    |   Should work with PHP >=5.
    |   Not tested with PHP 7.
    |
    |   --------
    |
    |   PHP 5 ve sonrasında çalışıyor olmalı.
    |   PHP 7 ile test edilmedi.
    |
    */

    private static $nounPhraseEnds = '/(*UTF8)oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|ığı$|ıgı$|oglu$|okulu$|leri$|ları$|lari$|üğü$/i';

    //  This is a backup solution for noun phrases.
    //  We'll directly look for the last word.
    //  If $nouns count is more than one
    //  and $last_noun (word) is in this array,
    //  it's probably a noun phrase.
    private static $nounPhraseWords = [
        'okulu',
        'odası',
        'güzeli',
        'paneli',
        'suyu',
        'denizi',
        'gölü',
        'yolu',
        'lisesi',

        'oğlu'  //  oğlu diye soyisim olur mu ki?
    ];
    private static $vowel           = '/(*UTF8)[oueiöüaıOUEİÖÜAI]/';
    private static $vowelE          = '/(*UTF8)[oueiöüaıOUEİÖÜAI]$/';

    //  This is the simplest & fastest solution for now.
    //  I really don't want to check last noun of given $noun,
    //  bacause (for example vive) last noun can be a Turkish brand or something.
    //  I'd suggest you to use $fake (like Turkce::accusativeCase("yıv", "view");).
    //
    //  Only for some brands, people, products, etc.
    private static $pronounces = [
        'apple' => 'pıl',
        'google' => 'gıl',
        'twitter' => 'tır',
        'youtube' => 'tup',
        'chrome' => 'rom',
        'developer' => 'pır',
        'appledeveloper' => 'pır',
        'googledeveloper' => 'pır',
        'facebookdeveloper' => 'pır',
        'googlecardboard' => 'ord',
        'cardboard' => 'ord',
        'iphone' => 'fon',
        'ipad' => 'ped',
        'watch' => 'voç',
        'appleiphone' => 'fon',
        'appleipad' => 'ped',
        'applewatch' => 'voç',
        'imessage' => 'sıc',
        'php' => 'çpi',
        'steam' => 'tim',
        'valve' => 'alv',
        'facebookmessenger' => 'cır',
        'messenger' => 'cır',
        'snapchat' => 'çet',
        'chat' => 'çet',
        'skype' => 'ayp',
        'unity' => 'iti',
        'spotify' => 'fay',
        'htc' => 'ysi',
        'half-life' => 'ayf',
        'halflife' => 'ayf',
        'htcvive' => 'avy',
        '9gag' => 'geg',
        'tv' => 'ivi',
        'appletv' => 'ivi',
        'usa' => 'sey',
        'googlemaps' => 'eps',
        'maps' => 'eps',
        'cern' => 'örn',
        'adobe' => 'dob',
        'imdb' => 'ibi',
        'italy' => 'ali',
        'store' => 'tor',
        'appstore' => 'tor',
        'playstore' => 'tor',
        'elonmusk' => 'ask',
        'einstein' => 'ayn',
        'xcode' => 'kod',
        'github' => 'hab',
        'bitbucket' => 'kıt',
        'slipknot' => 'nat',
        'ironmaiden' => 'dın',
        'slayer' => 'yır',
        'gameofthrones' => 'ons',
        'thesimpsons' => 'ıns',
        'familyguy' => 'gay',
        'starwars' => 'ors',
        'darthvader' => 'dır',
        'beethoven' => 'vın',
        'vr' => 'yar',
        'playstationvr' => 'yar',
        'gearvr' => 'yar',
        'googlevr' => 'yar',
        'steamvr' => 'yar',
        'osvr' => 'yar',
        'vrfirst' => 'öst',
        'unrealengine' => 'cin',
        'cryengine' => 'cin',
        '$' => 'lar',
        '€' => 'uro',
        '₺' => 'ele',
    ];

    /**
     * Checks the noun if it has a pronounce in $pronounces
     *
     * @param $n
     * @return bool || string
     */
    private static function checkHasPronounce($n) {
        $n = strtolower(str_replace(' ', '', $n));

        if((substr($n, 0, 1) == "#" || substr($n, 0, 1) == "@")) {
            $pronounce = isset(self::$pronounces[substr($n, 1)]) ? self::$pronounces[substr($n, 1)] : false;
        } else {
            $pronounce = isset(self::$pronounces[$n]) ? self::$pronounces[$n] : false;
        }

        return $pronounce;
    }

    /**
     * Accusative case
     *
     * @param string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     * @return string
     */
    public static function belirtmeHali($noun, $fake = false) {
        $noun = trim($noun);

        if(!$fake && ($fake_ = self::checkHasPronounce($noun))) {
            $fake = $noun;
            $noun = $fake_;
        }

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter      = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter    = mb_substr($noun, -3, 3, 'utf-8');
        $nouns            = preg_split('/ /', $noun);
        $last_noun        = $nouns[count($nouns) - 1];
        $last_noun_length = mb_strlen($last_noun, 'utf-8');

        if($fake !== false) $noun = $fake;

        $blending = "";
        if((preg_match(self::$vowel, $last_letter) || (preg_match('/(*UTF8)[çÇ]/', $last_3_letter) && preg_match(self::$vowelE, $last_letter))) && !preg_match('/(*UTF8)[ğçĞÇ]/', $last_letter) && !preg_match('/(*UTF8)^çü|^ÇÜ|^ÇÖ|^çö/', $last_3_letter)) $blending = "y";
        if(preg_match(self::$nounPhraseEnds, $last_noun) && $last_noun_length > 6 || (in_array(mb_strtolower($last_noun), self::$nounPhraseWords) && count($nouns) > 1)) $blending = "n";

        preg_match_all(self::$vowel, $last_3_letter, $vowels);

        $suffix = "i";
        if(count($vowels[0]) == 0) return ($noun . "'" . $blending . $suffix);

        if(preg_match('/(*UTF8)[öüÖÜ]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "ü";
        if(preg_match('/(*UTF8)[aıAI]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "ı";
        if(preg_match('/(*UTF8)[ouOU]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "u";

        return ($noun . "'" . $blending . $suffix);
    }

    public static function accusativeCase($noun, $fake = false) {
        return self::belirtmeHali($noun, $fake);
    }

    /**
     * Dative case
     *
     * @param string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function yonelmeHali($noun, $fake = false) {
        $noun = trim($noun);

        if(!$fake && $fake_ = self::checkHasPronounce($noun)) {
            $fake = $noun;
            $noun = $fake_;
        }

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter      = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter    = mb_substr($noun, -3, 3, 'utf-8');
        $nouns            = preg_split('/ /', $noun);
        $last_noun        = $nouns[count($nouns) - 1];
        $last_noun_length = mb_strlen($last_noun, 'utf-8');

        if($fake !== false) $noun = $fake;

        $blending = "";
        if((preg_match(self::$vowel, $last_letter) || (preg_match('/(*UTF8)[çÇ]/', $last_3_letter) && preg_match(self::$vowelE, $last_letter))) && !preg_match('/(*UTF8)[ğçĞÇ]/', $last_letter) && !preg_match('/(*UTF8)^çü|^ÇÜ|^ÇÖ|^çö/', $last_3_letter)) $blending = "y";
        if(preg_match(self::$nounPhraseEnds, $last_noun) && $last_noun_length > 6 || (in_array(mb_strtolower($last_noun), self::$nounPhraseWords) && count($nouns) > 1)) $blending = "n";

        preg_match_all(self::$vowel, $last_3_letter, $vowels);

        $suffix = "e";
        if(count($vowels[0]) == 0) return ($noun . "'" . $blending . $suffix);

        if(preg_match('/(*UTF8)[ouaıOUAI]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "a";

        return ($noun . "'" . $blending . $suffix);
    }

    public static function dativeCase($noun, $fake = false) {
        return self::yonelmeHali($noun, $fake);
    }

    /**
     * Locative case
     *
     * @param string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function bulunmaHali($noun, $fake = false) {
        $noun = trim($noun);

        if(!$fake && $fake_ = self::checkHasPronounce($noun)) {
            $fake = $noun;
            $noun = $fake_;
        }

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter      = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter    = mb_substr($noun, -3, 3, 'utf-8');
        $last_2_letter    = mb_substr($noun, -2, 2, 'utf-8');
        $nouns            = preg_split('/ /', $noun);
        $last_noun        = $nouns[count($nouns) - 1];
        $last_noun_length = mb_strlen($last_noun, 'utf-8');

        if($fake !== false) $noun = $fake;

        $blending = "";
        if(preg_match(self::$nounPhraseEnds, $last_noun) && $last_noun_length > 6 || (in_array(mb_strtolower($last_noun), self::$nounPhraseWords) && count($nouns) > 1)) $blending = "n";

        $suffix  = "d";
        $suffix_ = "e";
        if(preg_match('/(*UTF8)[pçktfşhPÇKTFŞH]/', $last_2_letter)) $suffix = "t";
        if(preg_match('/(*UTF8)[ğĞ]/', $last_letter)) $suffix = "d";
        if(preg_match('/(*UTF8)ş|s|ç/i', $last_2_letter)) $suffix = "t";
        if(preg_match(self::$vowel, $last_letter)) $suffix = "d";
        if(preg_match('/(*UTF8)şk|ŞK/', $last_3_letter)) $suffix_ = "a";

        preg_match_all(self::$vowel, $last_3_letter, $vowels);

        if(count($vowels[0]) == 0) return ($noun . "'" . $blending . $suffix . $suffix_);

        if(preg_match('/(*UTF8)[ouaıOUAI]/', $vowels[0][count($vowels[0]) - 1])) $suffix_ = "a";
        if(preg_match('/(*UTF8)[öüeiÖÜEİ]/', $vowels[0][count($vowels[0]) - 1])) $suffix_ = "e";

        return ($noun . "'" . $blending . $suffix . $suffix_);
    }

    public static function locativeCase($noun, $fake = false) {
        return self::bulunmaHali($noun, $fake);
    }

    /**
     * Ablative case
     *
     * @param string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function ayrilmaHali($noun, $fake = false) {
        $noun = trim($noun);

        if(!$fake && $fake_ = self::checkHasPronounce($noun)) {
            $fake = $noun;
            $noun = $fake_;
        }

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter      = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter    = mb_substr($noun, -3, 3, 'utf-8');
        $last_2_letter    = mb_substr($noun, -2, 2, 'utf-8');
        $nouns            = preg_split('/ /', $noun);
        $last_noun        = $nouns[count($nouns) - 1];
        $last_noun_length = mb_strlen($last_noun, 'utf-8');

        if($fake !== false) $noun = $fake;

        $blending = "";
        if(preg_match(self::$nounPhraseEnds, $last_noun) && $last_noun_length > 6 || (in_array(mb_strtolower($last_noun), self::$nounPhraseWords) && count($nouns) > 1)) $blending = "n";

        $suffix  = "d";
        $suffix_ = "e";
        if(preg_match('/(*UTF8)[pçktfşhPÇKTFŞH]/', $last_2_letter)) $suffix = "t";
        if(preg_match('/(*UTF8)[ğĞ]/', $last_letter)) $suffix = "d";
        if(preg_match('/(*UTF8)ş|s|ç/i', $last_2_letter)) $suffix = "t";
        if(preg_match(self::$vowel, $last_letter)) $suffix = "d";
        if(preg_match('/(*UTF8)şk|ŞK/', $last_3_letter)) $suffix_ = "a";

        preg_match_all(self::$vowel, $last_3_letter, $vowels);

        if(count($vowels[0]) == 0) return ($noun . "'" . $blending . $suffix . $suffix_ . "n");

        if(preg_match('/(*UTF8)[ouaıOUAI]/', $vowels[0][count($vowels[0]) - 1])) $suffix_ = "a";
        if(preg_match('/(*UTF8)[öüeiÖÜEİ]/', $vowels[0][count($vowels[0]) - 1])) $suffix_ = "e";

        return ($noun . "'" . $blending . $suffix . $suffix_ . "n");
    }

    public static function ablativeCase($noun, $fake = false) {
        return self::ayrilmaHali($noun, $fake);
    }

    /**
     * Genitive case
     *
     * @param string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function sahiplikHali($noun, $fake = false) {
        $noun = trim($noun);

        if(!$fake && $fake_ = self::checkHasPronounce($noun)) {
            $fake = $noun;
            $noun = $fake_;
        }

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter   = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');

        if($fake !== false) $noun = $fake;

        $blending = "";
        if(preg_match(self::$vowel, $last_letter)) $blending = "n";

        preg_match_all(self::$vowel, $last_3_letter, $vowels);

        $suffix = "i";
        if(count($vowels[0]) == 0) return ($noun . "'" . $blending . $suffix . "n");

        if(preg_match('/(*UTF8)[öüÖÜ]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "ü";
        if(preg_match('/(*UTF8)[aıAI]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "ı";
        if(preg_match('/(*UTF8)[ouOU]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "u";

        return ($noun . "'" . $blending . $suffix . "n");
    }

    public static function genitiveCase($noun, $fake = false) {
        return self::sahiplikHali($noun, $fake);
    }

    /**
     * Comitative case
     *
     * @param string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function vasitaHali($noun, $fake = false) {
        $noun = trim($noun);

        if(!$fake && $fake_ = self::checkHasPronounce($noun)) {
            $fake = $noun;
            $noun = $fake_;
        }

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter   = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');

        if($fake !== false) $noun = $fake;

        $blending = "";
        if(preg_match(self::$vowel, $last_letter)) $blending = "y";

        preg_match_all(self::$vowel, $last_3_letter, $vowels);

        $suffix = "e";
        if(count($vowels[0]) == 0) return ($noun . "'" . $blending . "l" . $suffix);

        if(preg_match('/(*UTF8)[ouaıOUAI]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "a";

        return ($noun . "'" . $blending . "l" . $suffix);
    }

    public static function comitativeCase($noun, $fake = false) {
        return self::vasitaHali($noun, $fake);
    }

    /**
     * Conjunction  (I'm not sure if this is the correct meaning of this)
     *
     * @param string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function dahiBaglac($noun, $fake = false) {
        $noun = trim($noun);

        if(!$fake && $fake_ = self::checkHasPronounce($noun)) {
            $fake = $noun;
            $noun = $fake_;
        }

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');

        if($fake !== false) $noun = $fake;

        preg_match_all(self::$vowel, $last_3_letter, $vowels);

        $blending = "d";
        $suffix   = "e";
        if(count($vowels[0]) == 0) return ($noun . " " . $blending . $suffix);

        if(preg_match('/(*UTF8)[aıAIouOU]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "a";

        return ($noun . " " . $blending . $suffix);
    }

    public static function conjunction($noun, $fake = false) {
        return self::dahiBaglac($noun, $fake);
    }

    /**
     * Ordinal Number
     *
     * @param string $number
     * @param bool $integer (if it's a integer, use "'", otherwise don't.)
     *
     * !Warning: Don't give $integer when you directly call this method, because it'll override the $number with your $integer.
     *           This is mostly for internal use (see processForNumber())
     *
     * @return string
     */
    public static function siraSayi($number, $integer = false) {
        $number = trim($number);

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $number)) return self::processForNumber(__FUNCTION__, $number);

        $last_letter   = mb_substr($number, -1, 1, 'utf-8');
        $last_3_letter = mb_substr($number, -3, 3, 'utf-8');

        //  Check if the ending with "ört", if so make it "örd" (only for "dört")
        if(mb_strtolower($last_3_letter, 'utf-8') == "ört") $number = mb_substr($number, 0, mb_strlen($number) - 1, 'utf-8') . ($last_letter == "t" ? "d" : "D");

        if($integer !== false) $number = $integer;

        $blending = "i";
        preg_match_all(self::$vowel, $last_3_letter, $vowels);
        $suffix = "i";

        if(count($vowels[0]) == 0) return ($number . ($integer ? "'" : "") . $blending . "nc" . $suffix);

        if(preg_match('/(*UTF8)[öüÖÜ]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "ü";
        if(preg_match('/(*UTF8)[aıAI]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "ı";
        if(preg_match('/(*UTF8)[ouOU]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "u";

        if(!preg_match(self::$vowel, $last_letter)) $blending = $suffix; else $blending = "";

        return ($number . ($integer ? "'" : "") . $blending . "nc" . $suffix);
    }

    public static function ordinalNumber($number, $integer = false) {
        return self::siraSayi($number, $integer);
    }

    /**
     * Distributive
     *
     * @param string $number
     * @param bool $integer (if it's a integer, use "'", otherwise don't.)
     *
     * !Warning: Don't give $integer when you directly call this method, because it'll override the $number with your $integer.
     *           This is mostly for internal use (see processForNumber())
     *
     * @return string
     */
    public static function ulestirme($number, $integer = false) {
        $number = trim($number);

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $number)) return self::processForNumber(__FUNCTION__, $number);

        $last_letter   = mb_substr($number, -1, 1, 'utf-8');
        $last_3_letter = mb_substr($number, -3, 3, 'utf-8');

        //  Check if the ending with "ört", if so make it "örd" (only for "dört")
        if(mb_strtolower($last_3_letter, 'utf-8') == "ört") $number = mb_substr($number, 0, mb_strlen($number) - 1, 'utf-8') . ($last_letter == "t" ? "d" : "D");

        if($integer !== false) $number = $integer;

        $blending = "";
        preg_match_all(self::$vowel, $last_3_letter, $vowels);
        $suffix = "e";

        if(count($vowels[0]) == 0) return ($number . ($integer ? "'" : "") . $blending . $suffix . "r");

        if(preg_match('/(*UTF8)[aıAIouOU]/', $vowels[0][count($vowels[0]) - 1])) $suffix = "a";

        if(preg_match(self::$vowel, $last_letter)) $blending = "ş";

        return ($number . ($integer ? "'" : "") . $blending . $suffix . "r");
    }

    public static function distributive($number, $integer = false) {
        return self::siraSayi($number, $integer);
    }

    /**
     * This is for the numbers. It returns $callback function with given number's pronounce
     *
     * @param string $callback
     * @param $noun
     * @return mixed
     */
    public static function processForNumber($callback = 'belirtmeHali', $noun) {
        $last_number = preg_split('/\D/', $noun);
        $last_number = $last_number[count($last_number) - 1];

        if($last_number == 0) {
            // it is directly zero
            return call_user_func('self::' . $callback, "fır", $noun);
        }

        //  We don't need a full word, last 3 letters'd be enough
        $endings = [
            '1' => 'bir',
            '2' => 'iki',
            '3' => 'üç',
            '4' => 'ört',
            '5' => 'beş',
            '6' => 'ltı',
            '7' => 'edi',
            '8' => 'kiz',
            '9' => 'kuz',
            '10' => 'on',
            '20' => 'rmi',
            '30' => 'tuz',
            '40' => 'ırk',
            '50' => 'lli',
            '60' => 'mış',
            '70' => 'miş',
            '80' => 'sen',
            '90' => 'san'
        ];

        //  last number's length
        $digit_length = mb_strlen($last_number);

        //  Check last number
        $last_1_letter = mb_substr($noun, -1, 1, 'utf-8');
        $last_1_number = preg_split('/^\D/', $last_1_letter);
        $last_1_number = $last_1_number[count($last_1_number) - 1];
        if($last_1_number != "0") return call_user_func('self::' . $callback, $endings[intval($last_1_number)], $noun);


        //  Check last two numbers
        $last_2_letter = mb_substr($noun, -2, 2, 'utf-8');
        $last_2_number = preg_split('/^\D/', $last_2_letter);
        $last_2_number = $last_2_number[count($last_2_number) - 1];
        if($last_2_number != "00") return call_user_func('self::' . $callback, $endings[intval($last_2_number)], $noun);

        //  Check last three numbers
        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');
        $last_3_number = preg_split('/^\D/', $last_3_letter);
        $last_3_number = $last_3_number[count($last_3_number) - 1];
        if($last_3_number != "000") return call_user_func('self::' . $callback, "yüz", $noun);

        //  Check last four numbers
        $last_4_letter = mb_substr($noun, -4, 4, 'utf-8');
        $last_4_number = preg_split('/^\D/', $last_4_letter);
        $last_4_number = $last_4_number[count($last_4_number) - 1];
        if($last_4_number != "0000" || $digit_length < 7) return call_user_func('self::' . $callback, "bin", $noun);

        //  Check for the rest
        if($digit_length >= 7) {
            // if this is 8, 11, 14, etc.
            if(($digit_length + 1) % 3 == 0) {
                if($digit_length % 2 == 0) {
                    return call_user_func('self::' . $callback, "yon", $noun);
                } else {
                    return call_user_func('self::' . $callback, "yar", $noun);
                }
            } elseif($digit_length % 3 == 0 || ($digit_length + 2) % 3 == 0) {
                if($digit_length % 2 == 0) {
                    return call_user_func('self::' . $callback, "yar", $noun);
                } else {
                    return call_user_func('self::' . $callback, "yon", $noun);
                }
            }
        }

        return call_user_func('self::' . $callback, $noun);
    }
}