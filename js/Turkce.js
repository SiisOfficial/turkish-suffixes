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

function toTurkishLowerCase(text) {
    return text.replace(/[Iİ]/g, function (character) {
        return character === "I" ? "ı" : "i";
    }).toLowerCase();
}

var Turkce = {
    /*
    |--------------------------------------------------------------------------
    | Turkish Case Suffixes For JavaScript
    |--------------------------------------------------------------------------
    |
    |   Should work with all modern browsers and Node.js.
    |
    |   --------
    |
    |   Tüm modern tarayıcılarda ve Node.js ortamında çalışıyor olmalı.
    |
    */

    nounPhraseRegex: /(oğlu|esi|aşı|işi|eşi|ağı|isi|iği|ığı|ıgı|oglu|okulu|leri|ları|lari|üğü|kısmı|kismi|bölümü|bolumu|merkezi|[aıeiouöü]s[ıiuü])$/i,

    //  This is a backup solution for noun phrases.
    //  We'll directly look for the last word.
    //  If nouns count is more than one
    //  and last_noun (word) is in this array,
    //  it's probably a noun phrase.
    nounPhraseWords: [
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
    ],

    //  Thin vowel exceptions (words with back vowels that take front-vowel suffixes)
    thinVowelExceptions: [
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
    ],

    vowelRegex: /[oueiöüaıOUEİÖÜAI]/,
    filterRegex: /[^0-9a-zA-ZğĞüÜöÖşŞıİçÇ\s₺€$¥£]/g,

    //  Single letters for acronyms without vowels (TDK, TRT, 1B, etc.)
    singleLetters: {
        "a": "a", "b": "be", "c": "ce", "ç": "çe", "d": "de",
        "e": "e", "f": "fe", "g": "ge", "ğ": "ğe", "h": "he",
        "ı": "ı", "i": "i", "j": "je", "k": "ke", "l": "le",
        "m": "me", "n": "ne", "o": "o", "ö": "ö", "p": "pe",
        "r": "re", "s": "se", "ş": "şe", "t": "te", "u": "u",
        "ü": "ü", "v": "ve", "y": "ye", "z": "ze",
        "q": "kü", "w": "ve", "x": "iks"
    },

    //  This is the simplest & fastest solution for now.
    //  I really don't want to check last noun of given noun,
    //  bacause (for example vive) last noun can be a Turkish brand or something.
    //  I'd suggest you to use fake (like Turkce.accusativeCase("yıv", "view");).
    //
    //  Only for some brands, people, products, etc.
    pronounces: {
        "apple": "pıl",
        "google": "gıl",
        "twitter": "tır",
        "youtube": "tup",
        "chrome": "rom",
        "developer": "pır",
        "board": "ord",
        "cardboard": "ord",
        "iphone": "fon",
        "ipad": "ped",
        "watch": "voç",
        "imessage": "sıc",
        "mac": "mek",
        "macbook": "buk",
        "php": "çpi",
        "steam": "tim",
        "valve": "alv",
        "messenger": "cır",
        "snapchat": "çet",
        "chat": "çet",
        "skype": "ayp",
        "unity": "iti",
        "spotify": "fay",
        "htc": "ysi",
        "half-life": "ayf",
        "halflife": "ayf",
        "htcvive": "avy",
        "9gag": "geg",
        "tv": "ivi",
        "usa": "sey",
        "maps": "eps",
        "cern": "örn",
        "adobe": "dob",
        "imdb": "ibi",
        "italy": "ali",
        "store": "tor",
        "appstore": "tor",
        "playstore": "tor",
        "psn": "esen",
        "xboxlive": "ayv",
        "einstein": "ayn",
        "xcode": "kod",
        "github": "hab",
        "bitbucket": "kıt",
        "slipknot": "nat",
        "maiden": "dın",
        "slayer": "yır",
        "thrones": "ons",
        "simpsons": "ıns",
        "guy": "gay",
        "wars": "ors",
        "vader": "dır",
        "beethoven": "vın",
        "vr": "yar",
        "ar": "yar",
        "station": "şın",
        "steamvr": "yar",
        "osvr": "yar",
        "first": "öst",
        "engine": "cin",
        "cryengine": "cin",
        "$": "lar",
        "€": "uro",
        "₺": "ele",
        "¥": "yen",
        "£": "lin",
        "tl": "ele",
        "+": "tı",
        "ios": "ayoes",
        "macos": "oes",
        "tvos": "oes",
        "watchos": "oes",
        "ipados": "oes",
        "visionos": "oes",
        "android": "yid",
        "windows": "dovs",
        "steamos": "oes",
        "linux": "nuks",
        "deck": "dek",
        "frame": "reym",
        "machine": "şin",
        "switch": "viç",
        "center": "tır",
        "services": "sız",
        "support": "port",
        "supporter": "tır",
        "discord": "kord",
        "paypal": "pal",
        "street": "rit",
        "game": "geym",
        "play": "ley",
        "blay": "ley",
        "playstation": "şın",
        "xbox": "baks",
        "series": "riz",
        "edition": "şın",
        "max": "meks",
        "plus": "plas",
        "ai": "eyay",
        "openai": "eyay",
        "chatgpt": "piti",
        "gpt": "piti",
        "gemini": "nay",
        "claude": "klod",
        "copilot": "lıt",
        "threads": "reds",
        "tiktok": "tok",
        "reels": "ılz",
        "shorts": "şorts",
        "twitch": "viç",
        "netflix": "fliks",
        "nvidia": "vidya"
    },

    isVowel: function (c) {
        return c === "a" || c === "e" || c === "ı" || c === "i" ||
            c === "o" || c === "ö" || c === "u" || c === "ü" ||
            c === "A" || c === "E" || c === "I" || c === "İ" ||
            c === "O" || c === "Ö" || c === "U" || c === "Ü";
    },

    getLastVowel: function (text) {
        for (var i = text.length - 1; i >= 0; i--) {
            if (this.isVowel(text[i]))
                return text[i];
        }

        return null;
    },

    substr: function (noun, charLength) {
        if (!noun)
            return "";
        return charLength >= noun.length ? noun : noun.substring(noun.length - charLength);
    },

    filterAndTrim: function (noun) {
        if (!noun)
            return "";
        return noun.toString().replace(this.filterRegex, "").trim();
    },

    checkHasPronounce: function (n) {
        if (!n || !n.toString().trim())
            return null;

        var str = n.toString().trim();
        var lastSpace = str.lastIndexOf(" ");
        var lastWord = toTurkishLowerCase(lastSpace >= 0 ? str.substring(lastSpace + 1) : str);

        if ((lastWord.charAt(0) === "#" || lastWord.charAt(0) === "@") && lastWord.length > 1) {
            var tagKey = lastWord.substring(1);
            if (this.pronounces.hasOwnProperty(tagKey))
                return this.pronounces[tagKey];
        }

        if (this.pronounces.hasOwnProperty(lastWord))
            return this.pronounces[lastWord];

        var match = str.match(/(^|\d+|[\s\-_])([a-zA-ZğĞüÜöÖşŞıİçÇ])$/);
        if (match) {
            var charKey = toTurkishLowerCase(match[2]);
            if (this.singleLetters.hasOwnProperty(charKey))
                return this.singleLetters[charKey];
        }

        // Acronym without vowels fallback (TDK, TRT, etc.)
        if (lastWord.length > 1 && !this.vowelRegex.test(lastWord)) {
            var lastChar = lastWord.charAt(lastWord.length - 1);
            if (this.singleLetters.hasOwnProperty(lastChar))
                return this.singleLetters[lastChar];
        }

        return null;
    },

    isNounPhrase: function (nouns, lastNoun) {
        if (nouns.length <= 1)
            return false;
        var clean = toTurkishLowerCase(lastNoun);
        return this.nounPhraseWords.indexOf(clean) !== -1 || this.nounPhraseRegex.test(clean);
    },

    isThinException: function (word) {
        return this.thinVowelExceptions.indexOf(toTurkishLowerCase(word.trim())) !== -1;
    },

    formatOutput: function (orgNoun, blending, suffix) {
        var hasQuote = /["']$/.test(orgNoun);
        return orgNoun + (hasQuote ? "" : "'") + blending + suffix;
    },

    belirtmeHali: function (noun, fake) {
        var orgNoun = noun != null ? noun.toString().trim() : "";
        noun = this.filterAndTrim(orgNoun);
        var isFake = fake != null && fake !== false && fake !== "";

        if (!isFake) {
            var fake_ = this.checkHasPronounce(noun);
            if (fake_ != null) {
                fake = orgNoun;
                noun = fake_;
                isFake = true;
            }
        }

        //  Check the ending if it's a number
        if (/\d$/.test(noun))
            return this.processForNumber(this.belirtmeHali.bind(this), orgNoun);

        var lastLetter = this.substr(noun, 1);
        var last3 = this.substr(noun, 3);
        var nouns = noun.split(/\s+/).filter(Boolean);
        var lastNoun = nouns.length > 0 ? nouns[nouns.length - 1] : "";

        if (isFake)
            orgNoun = fake;

        var blending = "";
        if (lastLetter.length > 0 && this.isVowel(lastLetter.charAt(0)))
            blending = "y";

        if (this.isNounPhrase(nouns, lastNoun))
            blending = "n";

        var suffix = "i";
        if (this.isThinException(lastNoun)) {
            suffix = "i";
        } else {
            var lastVowel = this.getLastVowel(last3);
            if (lastVowel != null) {
                var v = toTurkishLowerCase(lastVowel);
                if (v === "ö" || v === "ü")
                    suffix = "ü";
                else if (v === "a" || v === "ı")
                    suffix = "ı";
                else if (v === "o" || v === "u")
                    suffix = "u";
            }
        }

        return this.formatOutput(orgNoun, blending, suffix);
    },

    accusativeCase: function (noun, fake) {
        return this.belirtmeHali(noun, fake);
    },
    yi: function (noun, fake) {
        return this.belirtmeHali(noun, fake);
    },

    yonelmeHali: function (noun, fake) {
        var orgNoun = noun != null ? noun.toString().trim() : "";
        noun = this.filterAndTrim(orgNoun);
        var isFake = fake != null && fake !== false && fake !== "";

        if (!isFake) {
            var fake_ = this.checkHasPronounce(noun);
            if (fake_ != null) {
                fake = orgNoun;
                noun = fake_;
                isFake = true;
            }
        }

        //  Check the ending if it's a number
        if (/\d$/.test(noun))
            return this.processForNumber(this.yonelmeHali.bind(this), orgNoun);

        var lastLetter = this.substr(noun, 1);
        var last3 = this.substr(noun, 3);
        var nouns = noun.split(/\s+/).filter(Boolean);
        var lastNoun = nouns.length > 0 ? nouns[nouns.length - 1] : "";

        if (isFake)
            orgNoun = fake;

        var blending = "";
        if (lastLetter.length > 0 && this.isVowel(lastLetter.charAt(0)))
            blending = "y";

        if (this.isNounPhrase(nouns, lastNoun))
            blending = "n";

        var suffix = "e";
        if (!this.isThinException(lastNoun)) {
            var lastVowel = this.getLastVowel(last3);
            if (lastVowel != null) {
                var v = toTurkishLowerCase(lastVowel);
                if (v === "a" || v === "ı" || v === "o" || v === "u")
                    suffix = "a";
            }
        }

        return this.formatOutput(orgNoun, blending, suffix);
    },

    dativeCase: function (noun, fake) {
        return this.yonelmeHali(noun, fake);
    },
    ye: function (noun, fake) {
        return this.yonelmeHali(noun, fake);
    },

    bulunmaHali: function (noun, fake) {
        var orgNoun = noun != null ? noun.toString().trim() : "";
        noun = this.filterAndTrim(orgNoun);
        var isFake = fake != null && fake !== false && fake !== "";

        if (!isFake) {
            var fake_ = this.checkHasPronounce(noun);
            if (fake_ != null) {
                fake = orgNoun;
                noun = fake_;
                isFake = true;
            }
        }

        //  Check the ending if it's a number
        if (/\d$/.test(noun))
            return this.processForNumber(this.bulunmaHali.bind(this), orgNoun);

        var lastLetter = this.substr(noun, 1);
        var last3 = this.substr(noun, 3);
        var nouns = noun.split(/\s+/).filter(Boolean);
        var lastNoun = nouns.length > 0 ? nouns[nouns.length - 1] : "";

        if (isFake)
            orgNoun = fake;

        var blending = "";
        if (this.isNounPhrase(nouns, lastNoun))
            blending = "n";

        var suffix = "d";
        var suffix_ = "e";

        if (/[pçktfşhPÇKTFŞH]/.test(lastLetter))
            suffix = "t";
        if (/şk|ŞK/.test(last3))
            suffix_ = "a";

        if (!this.isThinException(lastNoun)) {
            var lastVowel = this.getLastVowel(last3);
            if (lastVowel != null) {
                var v = toTurkishLowerCase(lastVowel);
                if (v === "a" || v === "ı" || v === "o" || v === "u")
                    suffix_ = "a";
                else if (v === "e" || v === "i" || v === "ö" || v === "ü")
                    suffix_ = "e";
            }
        }

        return this.formatOutput(orgNoun, blending, suffix + suffix_);
    },

    locativeCase: function (noun, fake) {
        return this.bulunmaHali(noun, fake);
    },
    de: function (noun, fake) {
        return this.bulunmaHali(noun, fake);
    },

    ayrilmaHali: function (noun, fake) {
        var orgNoun = noun != null ? noun.toString().trim() : "";
        noun = this.filterAndTrim(orgNoun);
        var isFake = fake != null && fake !== false && fake !== "";

        if (!isFake) {
            var fake_ = this.checkHasPronounce(noun);
            if (fake_ != null) {
                fake = orgNoun;
                noun = fake_;
                isFake = true;
            }
        }

        //  Check the ending if it's a number
        if (/\d$/.test(noun))
            return this.processForNumber(this.ayrilmaHali.bind(this), orgNoun);

        var lastLetter = this.substr(noun, 1);
        var last3 = this.substr(noun, 3);
        var nouns = noun.split(/\s+/).filter(Boolean);
        var lastNoun = nouns.length > 0 ? nouns[nouns.length - 1] : "";

        if (isFake)
            orgNoun = fake;

        var blending = "";
        if (this.isNounPhrase(nouns, lastNoun))
            blending = "n";

        var suffix = "d";
        var suffix_ = "e";

        if (/[pçktfşhPÇKTFŞH]/.test(lastLetter))
            suffix = "t";
        if (/şk|ŞK/.test(last3))
            suffix_ = "a";

        if (!this.isThinException(lastNoun)) {
            var lastVowel = this.getLastVowel(last3);
            if (lastVowel != null) {
                var v = toTurkishLowerCase(lastVowel);
                if (v === "a" || v === "ı" || v === "o" || v === "u")
                    suffix_ = "a";
                else if (v === "e" || v === "i" || v === "ö" || v === "ü")
                    suffix_ = "e";
            }
        }

        return this.formatOutput(orgNoun, blending, suffix + suffix_ + "n");
    },

    ablativeCase: function (noun, fake) {
        return this.ayrilmaHali(noun, fake);
    },
    den: function (noun, fake) {
        return this.ayrilmaHali(noun, fake);
    },

    sahiplikHali: function (noun, fake) {
        var orgNoun = noun != null ? noun.toString().trim() : "";
        noun = this.filterAndTrim(orgNoun);
        var isFake = fake != null && fake !== false && fake !== "";

        if (!isFake) {
            var fake_ = this.checkHasPronounce(noun);
            if (fake_ != null) {
                fake = orgNoun;
                noun = fake_;
                isFake = true;
            }
        }

        //  Check the ending if it's a number
        if (/\d$/.test(noun))
            return this.processForNumber(this.sahiplikHali.bind(this), orgNoun);

        var lastLetter = this.substr(noun, 1);
        var last3 = this.substr(noun, 3);
        var nouns = noun.split(/\s+/).filter(Boolean);
        var lastNoun = nouns.length > 0 ? nouns[nouns.length - 1] : "";

        if (isFake)
            orgNoun = fake;

        var blending = "";
        if (lastLetter.length > 0 && this.isVowel(lastLetter.charAt(0)))
            blending = "n";

        var suffix = "i";
        if (this.isThinException(lastNoun)) {
            suffix = "i";
        } else {
            var lastVowel = this.getLastVowel(last3);
            if (lastVowel != null) {
                var v = toTurkishLowerCase(lastVowel);
                if (v === "ö" || v === "ü")
                    suffix = "ü";
                else if (v === "a" || v === "ı")
                    suffix = "ı";
                else if (v === "o" || v === "u")
                    suffix = "u";
            }
        }

        return this.formatOutput(orgNoun, blending, suffix + "n");
    },

    genitiveCase: function (noun, fake) {
        return this.sahiplikHali(noun, fake);
    },
    nin: function (noun, fake) {
        return this.sahiplikHali(noun, fake);
    },

    vasitaHali: function (noun, fake) {
        var orgNoun = noun != null ? noun.toString().trim() : "";
        noun = this.filterAndTrim(orgNoun);
        var isFake = fake != null && fake !== false && fake !== "";

        if (!isFake) {
            var fake_ = this.checkHasPronounce(noun);
            if (fake_ != null) {
                fake = orgNoun;
                noun = fake_;
                isFake = true;
            }
        }

        //  Check the ending if it's a number
        if (/\d$/.test(noun))
            return this.processForNumber(this.vasitaHali.bind(this), orgNoun);

        var lastLetter = this.substr(noun, 1);
        var last3 = this.substr(noun, 3);
        var nouns = noun.split(/\s+/).filter(Boolean);
        var lastNoun = nouns.length > 0 ? nouns[nouns.length - 1] : "";

        if (isFake)
            orgNoun = fake;

        var blending = "";
        if (lastLetter.length > 0 && this.isVowel(lastLetter.charAt(0)))
            blending = "y";

        var suffix = "e";
        if (!this.isThinException(lastNoun)) {
            var lastVowel = this.getLastVowel(last3);
            if (lastVowel != null) {
                var v = toTurkishLowerCase(lastVowel);
                if (v === "a" || v === "ı" || v === "o" || v === "u")
                    suffix = "a";
            }
        }

        return this.formatOutput(orgNoun, blending, "l" + suffix);
    },

    comitativeCase: function (noun, fake) {
        return this.vasitaHali(noun, fake);
    },
    ile: function (noun, fake) {
        return this.vasitaHali(noun, fake);
    },

    dahiBaglac: function (noun, fake) {
        var orgNoun = noun != null ? noun.toString().trim() : "";
        noun = this.filterAndTrim(orgNoun);
        var isFake = fake != null && fake !== false && fake !== "";

        if (!isFake) {
            var fake_ = this.checkHasPronounce(noun);
            if (fake_ != null) {
                fake = orgNoun;
                noun = fake_;
                isFake = true;
            }
        }

        //  Check the ending if it's a number
        if (/\d$/.test(noun))
            return this.processForNumber(this.dahiBaglac.bind(this), orgNoun);

        var last3 = this.substr(noun, 3);
        var nouns = noun.split(/\s+/).filter(Boolean);
        var lastNoun = nouns.length > 0 ? nouns[nouns.length - 1] : "";

        if (isFake)
            orgNoun = fake;

        var blending = "d";
        var suffix = "e";

        if (!this.isThinException(lastNoun)) {
            var lastVowel = this.getLastVowel(last3);
            if (lastVowel != null) {
                var v = toTurkishLowerCase(lastVowel);
                if (v === "a" || v === "ı" || v === "o" || v === "u")
                    suffix = "a";
            }
        }

        return orgNoun + " " + blending + suffix;
    },

    conjunction: function (noun, fake) {
        return this.dahiBaglac(noun, fake);
    },
    dahi: function (noun, fake) {
        return this.dahiBaglac(noun, fake);
    },

    siraSayi: function (number, integer) {
        number = number != null ? number.toString().trim() : "";
        var isFake = integer != null && integer !== false && integer !== "";

        //  Check the ending if it's a number
        if (/\d$/.test(number))
            return this.processForNumber(this.siraSayi.bind(this), number);

        var lastLetter = this.substr(number, 1);
        var last3 = this.substr(number, 3);

        //  Check if the ending with "ört", if so make it "örd" (only for "dört")
        if (toTurkishLowerCase(last3) === "ört")
            number = number.substring(0, number.length - 1) + (lastLetter === "t" ? "d" : "D");

        if (isFake)
            number = integer;

        var lastVowel = this.getLastVowel(last3);
        var suffix = "i";

        if (lastVowel != null) {
            var v = toTurkishLowerCase(lastVowel);
            if (v === "ö" || v === "ü")
                suffix = "ü";
            else if (v === "a" || v === "ı")
                suffix = "ı";
            else if (v === "o" || v === "u")
                suffix = "u";
        }

        var blending = (lastLetter.length > 0 && !this.isVowel(lastLetter.charAt(0))) ? suffix : "";
        return number + (isFake ? "'" : "") + blending + "nc" + suffix;
    },

    ordinalNumber: function (number, integer) {
        return this.siraSayi(number, integer);
    },
    nci: function (number, integer) {
        return this.siraSayi(number, integer);
    },

    ulestirme: function (number, integer) {
        number = number != null ? number.toString().trim() : "";
        var isFake = integer != null && integer !== false && integer !== "";

        //  Check the ending if it's a number
        if (/\d$/.test(number))
            return this.processForNumber(this.ulestirme.bind(this), number);

        var lastLetter = this.substr(number, 1);
        var last3 = this.substr(number, 3);

        //  Check if the ending with "ört", if so make it "örd" (only for "dört")
        if (toTurkishLowerCase(last3) === "ört")
            number = number.substring(0, number.length - 1) + (lastLetter === "t" ? "d" : "D");

        if (isFake)
            number = integer;

        var blending = "";
        var lastVowel = this.getLastVowel(last3);
        var suffix = "e";

        if (lastVowel != null) {
            var v = toTurkishLowerCase(lastVowel);
            if (v === "a" || v === "ı" || v === "o" || v === "u")
                suffix = "a";
        }

        if (lastLetter.length > 0 && this.isVowel(lastLetter.charAt(0)))
            blending = "ş";

        return number + (isFake ? "'" : "") + blending + suffix + "r";
    },

    distributive: function (number, integer) {
        return this.ulestirme(number, integer);
    },
    er: function (number, integer) {
        return this.ulestirme(number, integer);
    },

    processForNumber: function (callback, noun) {
        if (typeof callback === "undefined")
            callback = this.belirtmeHali.bind(this);

        var filteredNoun = this.filterAndTrim(noun);
        var lastNumberArray = filteredNoun.split(/\D+/).filter(Boolean);
        var lastNumber = "";

        for (var i = lastNumberArray.length - 1; i >= 0; i--) {
            if (lastNumberArray[i] !== "") {
                lastNumber = lastNumberArray[i];
                break;
            }
        }

        if (lastNumber === "0") {
            // it is directly zero
            return callback("fır", noun);
        }

        //  We don't need a full word, last 3 letters'd be enough
        var endings = {
            "1": "bir",
            "2": "iki",
            "3": "üç",
            "4": "ört",
            "5": "beş",
            "6": "ltı",
            "7": "edi",
            "8": "kiz",
            "9": "kuz",
            "10": "on",
            "20": "rmi",
            "30": "tuz",
            "40": "ırk",
            "50": "lli",
            "60": "mış",
            "70": "miş",
            "80": "sen",
            "90": "san"
        };

        //  last number's length
        var digitLength = lastNumber.length;

        //  Check last number
        var last1 = this.substr(lastNumber, 1);
        if (last1 !== "0" && endings.hasOwnProperty(last1))
            return callback(endings[last1], noun);

        //  Check last two numbers
        var last2 = this.substr(lastNumber, 2);
        if (last2 !== "00" && endings.hasOwnProperty(last2))
            return callback(endings[last2], noun);

        //  Check last three numbers
        var last3 = this.substr(lastNumber, 3);
        if (last3 !== "000")
            return callback("yüz", noun);

        //  Check last four numbers
        var last4 = this.substr(lastNumber, 4);
        if (last4 !== "0000" || digitLength < 7)
            return callback("bin", noun);

        //  Check for the rest
        // if this is 8, 11, 14, etc.
        if ((digitLength + 1) % 3 === 0)
            return callback(digitLength % 2 === 0 ? "yon" : "yar", noun);

        if (digitLength % 3 === 0 || (digitLength + 2) % 3 === 0)
            return callback(digitLength % 2 === 0 ? "yar" : "yon", noun);

        return callback(noun, "");
    }
};

if (typeof module !== "undefined" && typeof module.exports !== "undefined") {
    module.exports = Turkce;
}