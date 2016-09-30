<?php

/**
 * Created by IntelliJ IDEA.
 * Author: A. Utku Sipahioğlu (http://teorikdeli.com)
 * Company: Siis (http://siis.com.tr | http://siisgames.com)
 *
 * License: MIT
 * https://github.com/SiisOfficial/turkish-suffixes
 *
 * Version: 1.2
 */
class Turkce {

    /*
    |--------------------------------------------------------------------------
    | Turkish Case Suffixes Class
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

    /**
     * Accusative case
     *
     * @param  string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage: this is for pronounce usage
     *
     * @return string
     */
    public static function belirtmeHali($noun, $fake = false) {
        $noun = trim($noun);

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter      = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter    = mb_substr($noun, -3, 3, 'utf-8');
        $nouns            = preg_split('/ /', $noun);
        $noun_length      = count($nouns);
        $last_noun_length = strlen($nouns[$noun_length - 1]);

        $blending = "";
        if((preg_match('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_letter) || (preg_match('/(*UTF8)[çÇ]/', $last_3_letter) && preg_match('/(*UTF8)[oueiöüaıOUEİÖÜAI]$/', $last_letter))) && !preg_match('/(*UTF8)[ğçĞÇ]/', $last_letter) && !preg_match('/(*UTF8)^çü|^ÇÜ|^ÇÖ|^çö/', $last_3_letter)) $blending = "y";
        if((preg_match('/(*UTF8)oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|oglu$|okulu$|odası$|leri$/i', $nouns[$noun_length - 1]) && $last_noun_length > 5)) $blending = "n";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_3_letter, $sh);

        $suffix = "i";

        if(count($sh[0]) == 0) return ($noun . "'" . $blending . $suffix);

        if(preg_match('/(*UTF8)[öüÖÜ]/', $sh[0][count($sh[0]) - 1])) $suffix = "ü";
        if(preg_match('/(*UTF8)[aıAI]/', $sh[0][count($sh[0]) - 1])) $suffix = "ı";
        if(preg_match('/(*UTF8)[ouOU]/', $sh[0][count($sh[0]) - 1])) $suffix = "u";

        if($fake !== false) $noun = $fake;
        return ($noun . "'" . $blending . $suffix);
    }

    public static function accusativeCase($noun, $fake = false) {
        return self::belirtmeHali($noun, $fake);
    }

    /**
     * Dative case
     *
     * @param  string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function yonelmeHali($noun, $fake = false) {
        $noun = trim($noun);

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter      = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter    = mb_substr($noun, -3, 3, 'utf-8');
        $nouns            = preg_split('/ /', $noun);
        $noun_length      = count($nouns);
        $last_noun_length = strlen($nouns[$noun_length - 1]);

        $blending = "";
        if((preg_match('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_letter) || (preg_match('/(*UTF8)[çÇ]/', $last_3_letter) && preg_match('/(*UTF8)[oueiöüaıOUEİÖÜAI]$/', $last_letter))) && !preg_match('/(*UTF8)[ğçĞÇ]/', $last_letter) && !preg_match('/(*UTF8)^çü|^ÇÜ|^ÇÖ|^çö/', $last_3_letter)) $blending = "y";
        if((preg_match('/(*UTF8)oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|oglu$|okulu$|odası$|leri$/i', $nouns[$noun_length - 1]) && $last_noun_length > 5)) $blending = "n";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_3_letter, $sh);

        $suffix = "e";

        if(count($sh[0]) == 0) return ($noun . "'" . $blending . $suffix);

        if(preg_match('/(*UTF8)[ouaıOUAI]/', $sh[0][count($sh[0]) - 1])) $suffix = "a";

        if($fake !== false) $noun = $fake;
        return ($noun . "'" . $blending . $suffix);
    }

    public static function dativeCase($noun, $fake = false) {
        return self::yonelmeHali($noun, $fake);
    }

    /**
     * Locative case
     *
     * @param  string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function bulunmaHali($noun, $fake = false) {
        $noun = trim($noun);

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter      = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter    = mb_substr($noun, -3, 3, 'utf-8');
        $last_2_letter    = mb_substr($noun, -2, 2, 'utf-8');
        $nouns            = preg_split('/ /', $noun);
        $noun_length      = count($nouns);
        $last_noun_length = strlen($nouns[$noun_length - 1]);

        $blending = "";
        if((preg_match('/(*UTF8)oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|oglu$|okulu$|odası$|leri$/i', $nouns[$noun_length - 1]) && $last_noun_length > 5)) $blending = "n";

        $suffix  = "d";
        $suffix_ = "e";
        if(preg_match('/(*UTF8)[pçktfşhPÇKTFŞH]/', $last_2_letter)) $suffix = "t";
        if(preg_match('/(*UTF8)[ğĞ]/', $last_letter)) $suffix = "d";
        if(preg_match('/(*UTF8)ş|s|ç/', $last_2_letter)) $suffix = "t";
        if(preg_match('/(*UTF8)[aıoueiöüOUEİÖÜAI]/', $last_letter)) $suffix = "d";
        if(preg_match('/(*UTF8)şk|ŞK/', $last_3_letter)) $suffix_ = "a";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_3_letter, $sh);

        if(count($sh[0]) == 0) return ($noun . "'" . $blending . $suffix . $suffix_);

        if(preg_match('/(*UTF8)[ouaıOUAI]/', $sh[0][count($sh[0]) - 1])) $suffix_ = "a";
        if(preg_match('/(*UTF8)[öüeiÖÜEİ]/', $sh[0][count($sh[0]) - 1])) $suffix_ = "e";

        if($fake !== false) $noun = $fake;
        return ($noun . "'" . $blending . $suffix . $suffix_);
    }

    public static function locativeCase($noun, $fake = false) {
        return self::bulunmaHali($noun, $fake);
    }

    /**
     * Ablative case
     *
     * @param  string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function ayrilmaHali($noun, $fake = false) {
        $noun = trim($noun);

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter      = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter    = mb_substr($noun, -3, 3, 'utf-8');
        $last_2_letter    = mb_substr($noun, -2, 2, 'utf-8');
        $nouns            = preg_split('/ /', $noun);
        $noun_length      = count($nouns);
        $last_noun_length = strlen($nouns[$noun_length - 1]);

        $blending = "";
        if((preg_match('/(*UTF8)oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|oglu$|okulu$|odası$|leri$/i', $nouns[$noun_length - 1]) && $last_noun_length > 5)) $blending = "n";

        $suffix  = "d";
        $suffix_ = "e";
        if(preg_match('/(*UTF8)[pçktfşhPÇKTFŞH]/', $last_2_letter)) $suffix = "t";
        if(preg_match('/(*UTF8)[ğĞ]/', $last_letter)) $suffix = "d";
        if(preg_match('/(*UTF8)ş|s|ç|Ş|S|Ç/', $last_2_letter)) $suffix = "t";
        if(preg_match('/(*UTF8)[aıoueiöüOUEİÖÜAI]/', $last_letter)) $suffix = "d";
        if(preg_match('/(*UTF8)şk|ŞK/', $last_3_letter)) $suffix_ = "a";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_3_letter, $sh);

        if(count($sh[0]) == 0) return ($noun . "'" . $blending . $suffix . $suffix_ . "n");

        if(preg_match('/(*UTF8)[ouaıOUAI]/', $sh[0][count($sh[0]) - 1])) $suffix_ = "a";
        if(preg_match('/(*UTF8)[öüeiÖÜEİ]/', $sh[0][count($sh[0]) - 1])) $suffix_ = "e";

        if($fake !== false) $noun = $fake;
        return ($noun . "'" . $blending . $suffix . $suffix_ . "n");
    }

    public static function ablativeCase($noun, $fake = false) {
        return self::ayrilmaHali($noun, $fake);
    }

    /**
     * Genitive case
     *
     * @param  string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function sahiplikHali($noun, $fake = false) {
        $noun = trim($noun);

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter   = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');

        $blending = "";
        if(preg_match('/(*UTF8)[aıoueiöüOUEİÖÜAI]/', $last_letter)) $blending = "n";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_3_letter, $sh);

        $suffix = "i";

        if(count($sh[0]) == 0) return ($noun . "'" . $blending . $suffix . "n");

        if(preg_match('/(*UTF8)[öüÖÜ]/', $sh[0][count($sh[0]) - 1])) $suffix = "ü";
        if(preg_match('/(*UTF8)[aıAI]/', $sh[0][count($sh[0]) - 1])) $suffix = "ı";
        if(preg_match('/(*UTF8)[ouOU]/', $sh[0][count($sh[0]) - 1])) $suffix = "u";

        if($fake !== false) $noun = $fake;
        return ($noun . "'" . $blending . $suffix . "n");
    }

    public static function genitiveCase($noun, $fake = false) {
        return self::sahiplikHali($noun, $fake);
    }

    /**
     * Comitative case
     *
     * @param  string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function vasitaHali($noun, $fake = false) {
        $noun = trim($noun);

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_letter   = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');

        $blending = "";
        if(preg_match('/(*UTF8)[aıoueiöüOUEİÖÜAI]/', $last_letter)) $blending = "y";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_3_letter, $sh);

        $suffix = "e";

        if(count($sh[0]) == 0) return ($noun . "'" . $blending . "l" . $suffix);

        if(preg_match('/(*UTF8)[ouaıOUAI]/', $sh[0][count($sh[0]) - 1])) $suffix = "a";

        if($fake !== false) $noun = $fake;
        return ($noun . "'" . $blending . "l" . $suffix);
    }

    public static function comitativeCase($noun, $fake = false) {
        return self::vasitaHali($noun, $fake);
    }

    /**
     * Conjunction  (I'm not sure if this is the correct meaning of this)
     *
     * @param  string $noun
     * @param bool $fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @return string
     */
    public static function dahiBaglac($noun, $fake = false) {
        $noun = trim($noun);

        //  Check the ending if it's a number
        if(preg_match('/\d$/', $noun)) return self::processForNumber(__FUNCTION__, $noun);

        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');
        $blending      = "d";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_3_letter, $sh);

        $suffix = "e";

        if(count($sh[0]) == 0) return ($noun . " " . $blending . $suffix);

        if(preg_match('/(*UTF8)[aıAIouOU]/', $sh[0][count($sh[0]) - 1])) $suffix = "a";

        if($fake !== false) $noun = $fake;
        return ($noun . " " . $blending . $suffix);
    }

    public static function conjunction($noun, $fake = false) {
        return self::dahiBaglac($noun, $fake);
    }

    /**
     * This is for the numbers. It returns $callback function with given number's pronounce
     *
     * @param string $callback
     * @param $noun
     * @return mixed
     */
    public static function processForNumber($callback = 'belirtmeHali', $noun) {
        $last_number = end(preg_split('/\D/', $noun));

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
            '90' => 'san',
        ];

        //  last number's length
        $digit_length = strlen($last_number);

        //  Check last number
        $last_1_letter = mb_substr($noun, -1, 1, 'utf-8');
        $last_1_number = end(preg_split('/^\D/', $last_1_letter));
        if($last_1_number != "0") return call_user_func('self::' . $callback, $endings[intval($last_1_number)], $noun);


        //  Check last two numbers
        $last_2_letter = mb_substr($noun, -2, 2, 'utf-8');
        $last_2_number = end(preg_split('/^\D/', $last_2_letter));
        if($last_2_number != "00") return call_user_func('self::' . $callback, $endings[intval($last_2_number)], $noun);

        //  Check last three numbers
        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');
        $last_3_number = end(preg_split('/^\D/', $last_3_letter));
        if($last_3_number != "000") return call_user_func('self::' . $callback, "yüz", $noun);

        //  Check last four numbers
        $last_4_letter = mb_substr($noun, -4, 4, 'utf-8');
        $last_4_number = end(preg_split('/^\D/', $last_4_letter));
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
