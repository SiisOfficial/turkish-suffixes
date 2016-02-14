<?php

/**
 * Created by IntelliJ IDEA.
 * Author: A. Utku Sipahioğlu (http://teorikdeli.com)
 * Company: Siis (http://siis.com.tr | http://siisgames.com)
 *
 * License: MIT
 * https://github.com/SiisOfficial/turkish-suffixes
 *
 * Version: 1.0
 */
class Turkce {

    /*
    |--------------------------------------------------------------------------
    | Turkish Case Suffixes Class
    |--------------------------------------------------------------------------
    |
    |   This project is ~5 years old. I wrote all the functions and variables in
    |   Turkish back then. We'll update the project for a better readability.
    |
    |   Because of the PHP's UTF-8 case-insensitive bug, this Class may not be
    |   work correctly for uppercase names. We'll update it later.
    |
    |   Should work with PHP >=4.0.6, but we recommend PHP >=5.
    |   Not tested with PHP 7.
    |
    |   --------
    |
    |   Bu proje yaklaşık 5 senelik. Zamanında Türkçe olarak ve kendimce kısaltmalarla
    |   yazdım; ama yakın bir zamanda daha anlaşılır olması için güncelleyeceğim.
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
     * @param  string $isim
     *
     * @return string
     */
    public static function belirtmeHali($isim) {
        $rpr  = mb_substr($isim, -1, 1, 'utf-8');
        $rpr2 = mb_substr($isim, -3, 3, 'utf-8');
        $sism = preg_split('/ /', $isim);
        $iSa  = count($sism);
        $iKu  = strlen($sism[$iSa - 1]);

        $kayna = "";
        if((preg_match('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $rpr) || (preg_match('/(*UTF8)[çÇ]/', $rpr2) && preg_match('/(*UTF8)[oueiöüaıOUEİÖÜAI]$/', $rpr))) && !preg_match('/(*UTF8)[ğçĞÇ]/', $rpr) && !preg_match('/(*UTF8)^çü|^ÇÜ|^ÇÖ|^çö/', $rpr2)) $kayna = "y";
        if((preg_match('/(*UTF8)oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|oglu$|okulu$|odası$|leri$/i', $sism[$iSa - 1]) && $iKu > 5)) $kayna = "n";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $rpr2, $sh);

        $kharf = "";
        if(preg_match('/(*UTF8)[eiEİ]/', $sh[0][count($sh[0]) - 1])) $kharf = "i";
        if(preg_match('/(*UTF8)[öüÖÜ]/', $sh[0][count($sh[0]) - 1])) $kharf = "ü";
        if(preg_match('/(*UTF8)[aıAI]/', $sh[0][count($sh[0]) - 1])) $kharf = "ı";
        if(preg_match('/(*UTF8)[ouOU]/', $sh[0][count($sh[0]) - 1])) $kharf = "u";

        return ($isim . "'" . $kayna . $kharf);
    }

    /**
     * Dative case
     *
     * @param  string $isim
     *
     * @return string
     */
    public static function yonelmeHali($isim) {
        $rpr  = mb_substr($isim, -1, 1, 'utf-8');
        $rpr2 = mb_substr($isim, -3, 3, 'utf-8');
        $sism = preg_split('/ /', $isim);
        $iSa  = count($sism);
        $iKu  = strlen($sism[$iSa - 1]);

        $kayna = "";
        if((preg_match('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $rpr) || (preg_match('/(*UTF8)[çÇ]/', $rpr2) && preg_match('/(*UTF8)[oueiöüaıOUEİÖÜAI]$/', $rpr))) && !preg_match('/(*UTF8)[ğçĞÇ]/', $rpr) && !preg_match('/(*UTF8)^çü|^ÇÜ|^ÇÖ|^çö/', $rpr2)) $kayna = "y";
        if((preg_match('/(*UTF8)oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|oglu$|okulu$|odası$|leri$/i', $sism[$iSa - 1]) && $iKu > 5)) $kayna = "n";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $rpr2, $sh);

        $kharf = "";
        if(preg_match('/(*UTF8)[ouaıOUAI]/', $sh[0][count($sh[0]) - 1])) $kharf = "a";
        if(preg_match('/(*UTF8)[öüeiÖÜEİ]/', $sh[0][count($sh[0]) - 1])) $kharf = "e";

        return ($isim . "'" . $kayna . $kharf);
    }

    /**
     * Locative case
     *
     * @param  string $isim
     *
     * @return string
     */
    public static function bulunmaHali($isim) {
        $rpr  = mb_substr($isim, -1, 1, 'utf-8');
        $rpr2 = mb_substr($isim, -3, 3, 'utf-8');
        $rpr3 = mb_substr($isim, -2, 2, 'utf-8');
        $sism = preg_split('/ /', $isim);
        $iSa  = count($sism);
        $iKu  = strlen($sism[$iSa - 1]);

        $kayna = "";
        if((preg_match('/(*UTF8)oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|oglu$|okulu$|odası$|leri$/i', $sism[$iSa - 1]) && $iKu > 5)) $kayna = "n";

        $kharf  = "d";
        $kharf_ = "";
        if(preg_match('/(*UTF8)[pçktfşhPÇKTFŞH]/', $rpr3)) $kharf = "t";
        if(preg_match('/(*UTF8)[ğĞ]/', $rpr)) $kharf = "d";
        if(preg_match('/(*UTF8)ş|s|ç/', $rpr3)) $kharf = "t";
        if(preg_match('/(*UTF8)[aıoueiöüOUEİÖÜAI]/', $rpr)) $kharf = "d";
        if(preg_match('/(*UTF8)şk|ŞK/', $rpr2)) $kharf_ = "a";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $rpr2, $sh);

        if(preg_match('/(*UTF8)[ouaıOUAI]/', $sh[0][count($sh[0]) - 1])) $kharf_ = "a";
        if(preg_match('/(*UTF8)[öüeiÖÜEİ]/', $sh[0][count($sh[0]) - 1])) $kharf_ = "e";

        return ($isim . "'" . $kayna . $kharf . $kharf_);
    }

    /**
     * Ablative case
     *
     * @param  string $isim
     *
     * @return string
     */
    public static function ayrilmaHali($isim) {
        $rpr  = mb_substr($isim, -1, 1, 'utf-8');
        $rpr2 = mb_substr($isim, -3, 3, 'utf-8');
        $rpr3 = mb_substr($isim, -2, 2, 'utf-8');
        $sism = preg_split('/ /', $isim);
        $iSa  = count($sism);
        $iKu  = strlen($sism[$iSa - 1]);

        $kayna = "";
        if((preg_match('/(*UTF8)oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|oglu$|okulu$|odası$|leri$/i', $sism[$iSa - 1]) && $iKu > 5)) $kayna = "n";

        $kharf  = "d";
        $kharf_ = "";
        if(preg_match('/(*UTF8)[pçktfşhPÇKTFŞH]/', $rpr3)) $kharf = "t";
        if(preg_match('/(*UTF8)[ğĞ]/', $rpr)) $kharf = "d";
        if(preg_match('/(*UTF8)ş|s|ç|Ş|S|Ç/', $rpr3)) $kharf = "t";
        if(preg_match('/(*UTF8)[aıoueiöüOUEİÖÜAI]/', $rpr)) $kharf = "d";
        if(preg_match('/(*UTF8)şk|ŞK/', $rpr2)) $kharf_ = "a";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $rpr2, $sh);

        if(preg_match('/(*UTF8)[ouaıOUAI]/', $sh[0][count($sh[0]) - 1])) $kharf_ = "a";
        if(preg_match('/(*UTF8)[öüeiÖÜEİ]/', $sh[0][count($sh[0]) - 1])) $kharf_ = "e";

        return ($isim . "'" . $kayna . $kharf . $kharf_ . "n");
    }

    /**
     * Genitive case
     *
     * @param  string $isim
     *
     * @return string
     */
    public static function sahiplikHali($isim) {
        $rpr  = mb_substr($isim, -1, 1, 'utf-8');
        $rpr2 = mb_substr($isim, -3, 3, 'utf-8');

        $kayna = "";
        if(preg_match('/(*UTF8)[aıoueiöüOUEİÖÜAI]/', $rpr)) $kayna = "n";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $rpr2, $sh);

        $kharf = "";
        if(preg_match('/(*UTF8)[eiEİ]/', $sh[0][count($sh[0]) - 1])) $kharf = "i";
        if(preg_match('/(*UTF8)[öüÖÜ]/', $sh[0][count($sh[0]) - 1])) $kharf = "ü";
        if(preg_match('/(*UTF8)[aıAI]/', $sh[0][count($sh[0]) - 1])) $kharf = "ı";
        if(preg_match('/(*UTF8)[ouOU]/', $sh[0][count($sh[0]) - 1])) $kharf = "u";

        return ($isim . "'" . $kayna . $kharf . "n");
    }

    /**
     * Comitative case
     *
     * @param  string $isim
     *
     * @return string
     */
    public static function vasitaHali($isim) {
        $rpr  = mb_substr($isim, -1, 1, 'utf-8');
        $rpr2 = mb_substr($isim, -3, 3, 'utf-8');

        $kayna = "";
        if(preg_match('/(*UTF8)[aıoueiöüOUEİÖÜAI]/', $rpr)) $kayna = "y";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $rpr2, $sh);

        $kharf = "";
        if(preg_match('/(*UTF8)[ouaıOUAI]/', $sh[0][count($sh[0]) - 1])) $kharf = "a";
        if(preg_match('/(*UTF8)[öüeiÖÜEİ]/', $sh[0][count($sh[0]) - 1])) $kharf = "e";

        return ($isim . "'" . $kayna . "l" . $kharf);
    }

    /**
     * Conjunction  (I'm not sure if this is true meaning of this)
     *
     * @param  string $isim
     *
     * @return string
     */
    public static function dahiBaglac($isim) {
        $rpr2  = mb_substr($isim, -3, 3, 'utf-8');
        $kayna = "d";

        preg_match_all('/(*UTF8)[oueiöüaıOUEİÖÜAI]/', $rpr2, $sh);

        $kharf = "";
        if(preg_match('/(*UTF8)[eiEİöüÖÜ]/', $sh[0][count($sh[0]) - 1])) $kharf = "e";
        if(preg_match('/(*UTF8)[aıAIouOU]/', $sh[0][count($sh[0]) - 1])) $kharf = "a";

        return ($isim . " " . $kayna . $kharf);
    }

}