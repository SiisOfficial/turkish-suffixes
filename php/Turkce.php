<?php

/**
 * Created by IntelliJ IDEA.
 * Author: A. Utku Sipahioğlu (http://teorikdeli.com)
 * Company: Siis (http://siis.com.tr | http://siisgames.com)
 *
 * License: MIT
 * https://github.com/SiisOfficial/turkish-suffixes
 *
 * Version: 1.1
 */
class Turkce {

    /*
    |--------------------------------------------------------------------------
    | Turkish Case Suffixes Class
    |--------------------------------------------------------------------------
    |
    |   Because of the PHP's UTF-8 case-insensitive bug, this Class may not be
    |   work correctly for uppercase names. We'll update it later.
    |
    |   Should work with PHP >=4.0.6, but we recommend PHP >=5.
    |   Not tested with PHP 7.
    |
    |   --------
    |
    |   PHP'deki UTF-8 karakterlerdeki küçük/büyük harf duyarlılığı ile ilgili sıkıntı
    |   yüzünden büyük harfli tüm isimlere ekleri doğru getirmeyebilir. Yakında
    |   güncelleyeceğiz.
    |
    |   PHP 4.0.6 ve sonrasında çalışıyor olmalı; fakat PHP 5 ve yukarısı önerilir.
    |   PHP 7 ile test edilmedi.
    |
    */

    /**
     * Accusative case
     *
     * @param  string $noun
     *
     * @return string
     */
    public static function belirtmeHali($noun) {
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

        if(preg_match('/(*UTF8)[eiEİ]/', $sh[0][count($sh[0]) - 1])) $suffix = "i"; //  probably will be removed in next version.
        if(preg_match('/(*UTF8)[öüÖÜ]/', $sh[0][count($sh[0]) - 1])) $suffix = "ü";
        if(preg_match('/(*UTF8)[aıAI]/', $sh[0][count($sh[0]) - 1])) $suffix = "ı";
        if(preg_match('/(*UTF8)[ouOU]/', $sh[0][count($sh[0]) - 1])) $suffix = "u";

        return ($noun . "'" . $blending . $suffix);
    }

    public static function accusativeCase($noun) {
        return self::belirtmeHali($noun);
    }

    /**
     * Dative case
     *
     * @param  string $noun
     *
     * @return string
     */
    public static function yonelmeHali($noun) {
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

        if(preg_match('/(*UTF8)[öüeiÖÜEİ]/', $sh[0][count($sh[0]) - 1])) $suffix = "e"; //  probably will be removed in next version.
        if(preg_match('/(*UTF8)[ouaıOUAI]/', $sh[0][count($sh[0]) - 1])) $suffix = "a";

        return ($noun . "'" . $blending . $suffix);
    }

    public static function dativeCase($noun) {
        return self::yonelmeHali($noun);
    }

    /**
     * Locative case
     *
     * @param  string $noun
     *
     * @return string
     */
    public static function bulunmaHali($noun) {
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

        return ($noun . "'" . $blending . $suffix . $suffix_);
    }

    public static function locativeCase($noun) {
        return self::bulunmaHali($noun);
    }

    /**
     * Ablative case
     *
     * @param  string $noun
     *
     * @return string
     */
    public static function ayrilmaHali($noun) {
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

        return ($noun . "'" . $blending . $suffix . $suffix_ . "n");
    }

    public static function ablativeCase($noun) {
        return self::ayrilmaHali($noun);
    }

    /**
     * Genitive case
     *
     * @param  string $noun
     *
     * @return string
     */
    public static function sahiplikHali($noun) {
        $last_letter   = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');

        $blending = "";
        if(preg_match('/(*UTF8)[aıoueiöüOUEİÖÜAI]/', $last_letter)) $blending = "n";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_3_letter, $sh);

        $suffix = "i";

        if(count($sh[0]) == 0) return ($noun . "'" . $blending . $suffix . "n");

        if(preg_match('/(*UTF8)[eiEİ]/', $sh[0][count($sh[0]) - 1])) $suffix = "i"; //  probably will be removed in next version.
        if(preg_match('/(*UTF8)[öüÖÜ]/', $sh[0][count($sh[0]) - 1])) $suffix = "ü";
        if(preg_match('/(*UTF8)[aıAI]/', $sh[0][count($sh[0]) - 1])) $suffix = "ı";
        if(preg_match('/(*UTF8)[ouOU]/', $sh[0][count($sh[0]) - 1])) $suffix = "u";

        return ($noun . "'" . $blending . $suffix . "n");
    }

    public static function genitiveCase($noun) {
        return self::sahiplikHali($noun);
    }

    /**
     * Comitative case
     *
     * @param  string $noun
     *
     * @return string
     */
    public static function vasitaHali($noun) {
        $last_letter   = mb_substr($noun, -1, 1, 'utf-8');
        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');

        $blending = "";
        if(preg_match('/(*UTF8)[aıoueiöüOUEİÖÜAI]/', $last_letter)) $blending = "y";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_3_letter, $sh);

        $suffix = "e";

        if(count($sh[0]) == 0) return ($noun . "'" . $blending . "l" . $suffix);

        if(preg_match('/(*UTF8)[öüeiÖÜEİ]/', $sh[0][count($sh[0]) - 1])) $suffix = "e"; //  probably will be removed in next version.
        if(preg_match('/(*UTF8)[ouaıOUAI]/', $sh[0][count($sh[0]) - 1])) $suffix = "a";

        return ($noun . "'" . $blending . "l" . $suffix);
    }

    public static function comitativeCase($noun) {
        return self::vasitaHali($noun);
    }

    /**
     * Conjunction  (I'm not sure if this is the correct meaning of this)
     *
     * @param  string $noun
     *
     * @return string
     */
    public static function dahiBaglac($noun) {
        $last_3_letter = mb_substr($noun, -3, 3, 'utf-8');
        $blending      = "d";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $last_3_letter, $sh);

        $suffix = "e";

        if(count($sh[0]) == 0) return ($noun . " " . $blending . $suffix);

        if(preg_match('/(*UTF8)[eiEİöüÖÜ]/', $sh[0][count($sh[0]) - 1])) $suffix = "e"; //  probably will be removed in next version.
        if(preg_match('/(*UTF8)[aıAIouOU]/', $sh[0][count($sh[0]) - 1])) $suffix = "a";

        return ($noun . " " . $blending . $suffix);
    }

    public static function conjunction($noun) {
        return self::dahiBaglac($noun);
    }

}
