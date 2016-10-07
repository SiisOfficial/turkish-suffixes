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
 * Version: 1.4.1
 */
var Turkce = {
    /*
     |--------------------------------------------------------------------------
     | Turkish Case Suffixes For JavaScript
     |--------------------------------------------------------------------------
     |
     |   Should work with all browsers.
     |
     |   --------
     |
     |   Tüm tarayıcılarda çalışıyor olmalı.
     |
     */

    nounPhraseEnds: /oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|ığı$|ıgı$|oglu$|okulu$|odası$|leri$/i,
    vowel: /[oueiöüaıOUEİÖÜAI]/,
    vowelE: /[oueiöüaıOUEİÖÜAI]$/,
    vowelG: /[oueiöüaıOUEİÖÜAI]/g,

    //  This is the simplest & fastest solution for now.
    //  I really don't want to check last noun of given var noun,
    //  bacause (for example vive) last noun can be a Turkish brand or something.
    //  I'd suggest you to use var fake (like Turkce.accusativeCase("yıv", "view");).
    //
    //  Only for some brands, people, products, etc.
    pronounces: {
        'apple': 'pıl',
        'google': 'gıl',
        'twitter': 'tır',
        'youtube': 'tup',
        'chrome': 'rom',
        'developer': 'pır',
        'appledeveloper': 'pır',
        'googledeveloper': 'pır',
        'facebookdeveloper': 'pır',
        'iphone': 'fon',
        'ipad': 'ped',
        'watch': 'voç',
        'php': 'çpi',
        'steam': 'tim',
        'valve': 'alv',
        'facebookmessenger': 'cır',
        'messenger': 'cır',
        'snapchat': 'çet',
        'chat': 'çet',
        'skype': 'ayp',
        'unity': 'iti',
        'spotify': 'fay',
        'htc': 'ysi',
        'half-life': 'ayf',
        'halflife': 'ayf',
        'htcvive': 'avy',
        '9gag': 'geg',
        'tv': 'ivi',
        'appletv': 'ivi',
        'usa': 'sey',
        'googlemaps': 'eps',
        'maps': 'eps',
        'cern': 'örn',
        'adobe': 'dob',
        'imdb': 'ibi',
        'italy': 'ali',
        'store': 'tor',
        'appstore': 'tor',
        'playstore': 'tor',
        'elonmusk': 'ask',
        'einstein': 'ayn',
        'xcode': 'kod',
        'github': 'hab',
        'bitbucket': 'kıt',
        'slipknot': 'nat',
        'gameofthrones': 'ons',
        'beethoven': 'vın',
        '$': 'lar',
        '€': 'uro',
        '₺': 'ele'
    },

    /**
     * Checks the fake variable if it's undefined.
     * If so, sets it's default value to false.
     *
     * @param v
     * @returns {boolean || string}
     */
    isFake: function(v) {
        return (typeof v == "undefined" ? false : v);
    },

    /**
     * Checks the noun if it has a pronounce in pronounces
     *
     * @param n
     * @returns {boolean || string}
     */
    checkHasPronounce: function(n) {
        n = n.replace(/ /g, "").toLowerCase();
        var pronounce;

        if((n.substr(0, 1) == "#" || n.substr(0, 1) == "@") && (pronounce = Turkce.pronounces[n.substr(1)])) {
            return pronounce;
        } else if(pronounce = Turkce.pronounces[n]) {
            return pronounce;
        }

        return false;
    },

    /**
     * Accusative case
     *
     * @param noun
     * @param fake (integer/string if it's a fake noun): this is for pronounce usage
     * @returns {string}
     */
    belirtmeHali: function(noun, fake) {
        noun = noun.toString().trim();
        fake = Turkce.isFake(fake);
        var fake_;

        if(!fake && (fake_ = Turkce.checkHasPronounce(noun))) {
            fake = noun;
            noun = fake_;
        }

        //  Check the ending if it's a number
        if(/\d$/.test(noun)) return this.processForNumber(this.belirtmeHali, noun);

        var last_letter      = noun.substr(-1, 1),
            last_3_letter    = noun.substr(-3, 3),
            nouns            = noun.split(' '),
            noun_length      = nouns.length,
            last_noun_length = nouns[noun_length - 1].length;

        if(fake !== false) noun = fake;

        var blending = "";
        if((Turkce.vowel.test(last_letter) || (/[çÇ]/.test(last_3_letter) && Turkce.vowelE.test(last_letter))) && !/[ğçĞÇ]/.test(last_letter) && !/^çü|^ÇÜ|^ÇÖ|^çö/.test(last_3_letter)) blending = "y";
        if((Turkce.nounPhraseEnds.test(nouns[noun_length - 1]) && last_noun_length > 6)) blending = "n";

        var vovels = last_3_letter.match(Turkce.vowelG),
            suffix = "i";

        if(vovels == null) return (noun + "'" + blending + suffix);

        if(/[öüÖÜ]/.test(vovels[(vovels.length) - 1])) suffix = "ü";
        if(/[aıAI]/.test(vovels[(vovels.length) - 1])) suffix = "ı";
        if(/[ouOU]/.test(vovels[(vovels.length) - 1])) suffix = "u";

        return (noun + "'" + blending + suffix);
    },
    accusativeCase: function(noun, fake) {
        return this.belirtmeHali(noun, fake);
    },

    /**
     * Dative case
     *
     * @param noun
     * @param fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @returns {string}
     */
    yonelmeHali: function(noun, fake) {
        noun = noun.toString().trim();
        fake = Turkce.isFake(fake);
        var fake_;

        if(!fake && (fake_ = Turkce.checkHasPronounce(noun))) {
            fake = noun;
            noun = fake_;
        }

        //  Check the ending if it's a number
        if(/\d$/.test(noun)) return this.processForNumber(this.yonelmeHali, noun);

        var last_letter      = noun.substr(-1, 1),
            last_3_letter    = noun.substr(-3, 3),
            nouns            = noun.split(' '),
            noun_length      = nouns.length,
            last_noun_length = nouns[noun_length - 1].length;

        if(fake !== false) noun = fake;

        var blending = "";
        if((Turkce.vowel.test(last_letter) || (/[çÇ]/.test(last_3_letter) && Turkce.vowelE.test(last_letter))) && !/[ğçĞÇ]/.test(last_letter) && !/^çü|^ÇÜ|^ÇÖ|^çö/.test(last_3_letter)) blending = "y";
        if((Turkce.nounPhraseEnds.test(nouns[noun_length - 1]) && last_noun_length > 6)) blending = "n";

        var vovels = last_3_letter.match(Turkce.vowelG),
            suffix = "e";

        if(vovels == null) return (noun + "'" + blending + suffix);

        if(/[ouaıOUAI]/.test(vovels[(vovels.length) - 1])) suffix = "a";

        return (noun + "'" + blending + suffix);

    },
    dativeCase: function(noun, fake) {
        return this.yonelmeHali(noun, fake);
    },

    /**
     * Locative case
     *
     * @param noun
     * @param fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @returns {string}
     */
    bulunmaHali: function(noun, fake) {
        noun = noun.toString().trim();
        fake = Turkce.isFake(fake);
        var fake_;

        if(!fake && (fake_ = Turkce.checkHasPronounce(noun))) {
            fake = noun;
            noun = fake_;
        }

        //  Check the ending if it's a number
        if(/\d$/.test(noun)) return this.processForNumber(this.bulunmaHali, noun);

        var last_letter      = noun.substr(-1, 1),
            last_3_letter    = noun.substr(-3, 3),
            last_2_letter    = noun.substr(-2, 2),
            nouns            = noun.split(' '),
            noun_length      = nouns.length,
            last_noun_length = nouns[noun_length - 1].length;

        if(fake !== false) noun = fake;

        var blending = "";
        if((Turkce.nounPhraseEnds.test(nouns[noun_length - 1]) && last_noun_length > 6)) blending = "n";

        var suffix  = "d",
            suffix_ = "e";
        if(/[pçktfşhPÇKTFŞH]/.test(last_2_letter)) suffix = "t";
        if(/[ğĞ]/.test(last_letter)) suffix = "d";
        if(/ş|s|ç/i.test(last_2_letter)) suffix = "t";
        if(Turkce.vowel.test(last_letter)) suffix = "d";
        if(/şk|ŞK/.test(last_3_letter)) suffix_ = "a";

        var vovels = last_3_letter.match(Turkce.vowelG);

        if(vovels == null) return (noun + "'" + blending + suffix + suffix_);

        if(/[ouaıOUAI]/.test(vovels[(vovels.length) - 1])) suffix_ = "a";
        if(/[öüeiÖÜEİ]/.test(vovels[(vovels.length) - 1])) suffix_ = "e";

        return (noun + "'" + blending + suffix + suffix_);
    },
    locativeCase: function(noun, fake) {
        return this.bulunmaHali(noun, fake);
    },

    /**
     * Ablative case
     *
     * @param noun
     * @param fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @returns {string}
     */
    ayrilmaHali: function(noun, fake) {
        noun = noun.toString().trim();
        fake = Turkce.isFake(fake);
        var fake_;

        if(!fake && (fake_ = Turkce.checkHasPronounce(noun))) {
            fake = noun;
            noun = fake_;
        }

        //  Check the ending if it's a number
        if(/\d$/.test(noun)) return this.processForNumber(this.ayrilmaHali, noun);

        var last_letter      = noun.substr(-1, 1),
            last_3_letter    = noun.substr(-3, 3),
            last_2_letter    = noun.substr(-2, 2),
            nouns            = noun.split(' '),
            noun_length      = nouns.length,
            last_noun_length = nouns[noun_length - 1].length;

        if(fake !== false) noun = fake;

        var blending = "";
        if((Turkce.nounPhraseEnds.test(nouns[noun_length - 1]) && last_noun_length > 6)) blending = "n";

        var suffix  = "d",
            suffix_ = "e";
        if(/[pçktfşhPÇKTFŞH]/.test(last_2_letter)) suffix = "t";
        if(/[ğĞ]/.test(last_letter)) suffix = "d";
        if(/ş|s|ç/i.test(last_2_letter)) suffix = "t";
        if(Turkce.vowel.test(last_letter)) suffix = "d";
        if(/şk|ŞK/.test(last_3_letter)) suffix_ = "a";

        var vovels = last_3_letter.match(Turkce.vowelG);

        if(vovels == null) return (noun + "'" + blending + suffix + suffix_ + "n");

        if(/[ouaıOUAI]/.test(vovels[(vovels.length) - 1])) suffix_ = "a";
        if(/[öüeiÖÜEİ]/.test(vovels[(vovels.length) - 1])) suffix_ = "e";

        return (noun + "'" + blending + suffix + suffix_ + "n");
    },
    ablativeCase: function(noun, fake) {
        return this.ayrilmaHali(noun, fake);
    },

    /**
     * Genitive case
     *
     * @param noun
     * @param fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @returns {string}
     */
    sahiplikHali: function(noun, fake) {
        noun = noun.toString().trim();
        fake = Turkce.isFake(fake);
        var fake_;

        if(!fake && (fake_ = Turkce.checkHasPronounce(noun))) {
            fake = noun;
            noun = fake_;
        }

        //  Check the ending if it's a number
        if(/\d$/.test(noun)) return this.processForNumber(this.sahiplikHali, noun);

        var last_letter   = noun.substr(-1, 1),
            last_3_letter = noun.substr(-3, 3);

        if(fake !== false) noun = fake;

        var blending = "";
        if(Turkce.vowel.test(last_letter)) blending = "n";

        var vovels = last_3_letter.match(Turkce.vowelG),
            suffix = "i";

        if(vovels == null) return (noun + "'" + blending + suffix + "n");

        if(/[öüÖÜ]/.test(vovels[(vovels.length) - 1])) suffix = "ü";
        if(/[aıAI]/.test(vovels[(vovels.length) - 1])) suffix = "ı";
        if(/[ouOU]/.test(vovels[(vovels.length) - 1])) suffix = "u";

        return (noun + "'" + blending + suffix + "n");
    },
    genitiveCase: function(noun, fake) {
        return this.sahiplikHali(noun, fake);
    },


    /**
     * Comitative case
     *
     * @param noun
     * @param fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @returns {string}
     */
    vasitaHali: function(noun, fake) {
        noun = noun.toString().trim();
        fake = Turkce.isFake(fake);
        var fake_;

        if(!fake && (fake_ = Turkce.checkHasPronounce(noun))) {
            fake = noun;
            noun = fake_;
        }

        //  Check the ending if it's a number
        if(/\d$/.test(noun)) return this.processForNumber(this.vasitaHali, noun);

        var last_letter   = noun.substr(-1, 1),
            last_3_letter = noun.substr(-3, 3);

        if(fake !== false) noun = fake;

        var blending = "";
        if(Turkce.vowel.test(last_letter)) blending = "y";

        var vovels = last_3_letter.match(Turkce.vowelG),
            suffix = "e";

        if(vovels == null) return (noun + "'" + blending + "l" + suffix);

        if(/[ouaıOUAI]/.test(vovels[(vovels.length) - 1])) suffix = "a";

        return (noun + "'" + blending + "l" + suffix);
    },
    comitativeCase: function(noun, fake) {
        return this.vasitaHali(noun, fake);
    },

    /**
     * Conjunction  (I'm not sure if this is the correct meaning of this)
     *
     * @param noun
     * @param fake (integer/string if it's a fake noun): this is for pronounce usage
     *
     * @returns {string}
     */
    dahiBaglac: function(noun, fake) {
        noun = noun.toString().trim();
        fake = Turkce.isFake(fake);
        var fake_;

        if(!fake && (fake_ = Turkce.checkHasPronounce(noun))) {
            fake = noun;
            noun = fake_;
        }

        //  Check the ending if it's a number
        if(/\d$/.test(noun)) return this.processForNumber(this.dahiBaglac, noun);

        var last_3_letter = noun.substr(-3, 3);

        if(fake !== false) noun = fake;

        var blending = "d",
            vovels   = last_3_letter.match(Turkce.vowelG),
            suffix   = "e";

        if(vovels == null) return (noun + " " + blending + suffix);

        if(/[ouaıOUAI]/.test(vovels[(vovels.length) - 1])) suffix = "a";

        return (noun + " " + blending + suffix);
    },
    conjunction: function(noun, fake) {
        return this.dahiBaglac(noun, fake);
    },

    /**
     * Ordinal Number
     *
     * @param number
     * @param integer (if it's a integer, use "'", otherwise don't.)
     *
     * !Warning: Don't give integer when you directly call this method, because it'll override the number with your integer.
     *           This is mostly for internal use (see processForNumber())
     *
     * @returns {string}
     */
    siraSayi: function(number, integer) {
        number  = number.toString().trim();
        integer = Turkce.isFake(integer);

        //  Check the ending if it's a number
        if(/\d$/.test(number)) return this.processForNumber(this.siraSayi, number);

        var last_letter   = number.substr(-1, 1);
        var last_3_letter = number.substr(-3, 3);

        //  Check if the ending with "ört", if so make it "örd" (only for "dört")
        if(last_3_letter.toLowerCase() == "ört") number = number.substr(0, number.length - 1) + (last_letter == "t" ? "d" : "D");

        if(integer !== false) number = integer;

        var blending = "i",
            vovels   = last_3_letter.match(Turkce.vowelG),
            suffix   = "i";

        if(vovels == null) return (number + (integer ? "'" : "") + blending + "nc" + suffix);

        if(/[öüÖÜ]/.test(vovels[(vovels.length) - 1])) suffix = "ü";
        if(/[aıAI]/.test(vovels[(vovels.length) - 1])) suffix = "ı";
        if(/[ouOU]/.test(vovels[(vovels.length) - 1])) suffix = "u";

        if(!Turkce.vowel.test(last_letter)) blending = suffix; else blending = "";

        return (number + (integer ? "'" : "") + blending + "nc" + suffix);
    },
    ordinalNumber: function(number, integer) {
        return this.siraSayi(number);
    },

    /**
     * Distributive
     *
     * @param number
     * @param integer (if it's a integer, use "'", otherwise don't.)
     *
     * !Warning: Don't give integer when you directly call this method, because it'll override the number with your integer.
     *           This is mostly for internal use (see processForNumber())
     *
     * @returns {string}
     */
    ulestirme: function(number, integer) {
        number  = number.toString().trim();
        integer = Turkce.isFake(integer);

        //  Check the ending if it's a number
        if(/\d$/.test(number)) return this.processForNumber(this.ulestirme, number);

        var last_letter   = number.substr(-1, 1);
        var last_3_letter = number.substr(-3, 3);

        //  Check if the ending with "ört", if so make it "örd" (only for "dört")
        if(last_3_letter.toLowerCase() == "ört") number = number.substr(0, number.length - 1) + (last_letter == "t" ? "d" : "D");

        if(integer !== false) number = integer;

        var blending = "",
            vovels   = last_3_letter.match(Turkce.vowelG),
            suffix   = "e";

        if(vovels == null) return (number + (integer ? "'" : "") + blending + suffix + "r");

        if(/[ouaıOUAI]/.test(vovels[(vovels.length) - 1])) suffix = "a";

        if(Turkce.vowel.test(last_letter)) blending = "ş";

        return (number + (integer ? "'" : "") + blending + suffix + "r");
    },
    distributive: function(number, integer) {
        return this.ulestirme(number);
    },

    /**
     * This is for the numbers. It returns callback function with given number's pronounce
     *
     * @param callback
     * @param noun
     * @returns {string}
     */
    processForNumber: function(callback, noun) {
        if(typeof callback == "undefined") callback = this.belirtmeHali;

        var last_number = noun.split('/\D/');
        last_number     = last_number[last_number.length - 1];

        if(last_number == 0) {
            // it is directly zero
            return callback("fır", noun);
        }

        //  We don't need a full word, last 3 letters'd be enough
        var endings      = {
            '1': 'bir',
            '2': 'iki',
            '3': 'üç',
            '4': 'ört',
            '5': 'beş',
            '6': 'ltı',
            '7': 'edi',
            '8': 'kiz',
            '9': 'kuz',
            '10': 'on',
            '20': 'rmi',
            '30': 'tuz',
            '40': 'ırk',
            '50': 'lli',
            '60': 'mış',
            '70': 'miş',
            '80': 'sen',
            '90': 'san'
        };
        //  last number's length
        var digit_length = last_number.length;

        //  Check last number
        var last_1_letter = noun.substr(-1, 1),
            last_1_number = last_1_letter.split('/^\D/');
        last_1_number     = last_1_number[last_1_number.length - 1];
        if(last_1_number != "0") return callback(endings[last_1_number], noun);

        //  Check last two numbers
        var last_2_letter = noun.substr(-2, 2),
            last_2_number = last_2_letter.split('/^\D/');
        last_2_number     = last_2_number[last_2_number.length - 1];
        if(last_2_number != "00") return callback(endings[last_2_number], noun);

        //  Check last three numbers
        var last_3_letter = noun.substr(-3, 3),
            last_3_number = last_3_letter.split('/^\D/');
        last_3_number     = last_3_number[last_3_number.length - 1];
        if(last_3_number != "000") return callback("yüz", noun);

        //  Check last four numbers
        var last_4_letter = noun.substr(-4, 4),
            last_4_number = last_4_letter.split('/^\D/');
        last_4_number     = last_4_number[last_4_number.length - 1];
        if(last_4_number != "0000" || digit_length < 7) return callback("bin", noun);

        //  Check for the rest
        if(digit_length >= 7) {
            // if this is 8, 11, 14, etc.
            if((digit_length + 1) % 3 == 0) {
                if(digit_length % 2 == 0) {
                    return callback("yon", noun);
                } else {
                    return callback("yar", noun);
                }
            } else if(digit_length % 3 == 0 || (digit_length + 2) % 3 == 0) {
                if(digit_length % 2 == 0) {
                    return callback("yar", noun);
                } else {
                    return callback("yon", noun);
                }
            }
        }

        return callback(noun);
    }
};