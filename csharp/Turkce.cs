/**
 * Created by Consulo.
 * Author: A. Utku Sipahioğlu (http://teorikdeli.com)
 * Company: Siis (http://siis.com.tr | http://siisgames.com)
 *
 * License: MIT
 * https://github.com/SiisOfficial/turkish-suffixes
 *
 * Version: 1.3
 */
using System;
using System.Collections.Generic;
using System.Text.RegularExpressions;

class Turkce {
    /*
    |--------------------------------------------------------------------------
    | Turkish Case Suffixes Class For C#
    |--------------------------------------------------------------------------
    |
    |   Should work with .NET >=2.0.
    |
    |   --------
    |
    |   .NET 2.0 ve sonrasında çalışıyor olmalı.
    |
    */

    static string nounPhraseEnds = "(?i)oğlu$|esi$|aşı$|işi$|eşi$|ağı$|isi$|iği$|ığı$|ıgı$|oglu$|okulu$|odası$|leri$";
    static string vowel = "[oueiöüaıOUEİÖÜAI]";
    static string vowelE = "[oueiöüaıOUEİÖÜAI]$";


    /// <summary>
    /// Checks the fake string if it's empty or not.
    /// </summary>
    /// <param name="v"></param>
    /// <returns>bool</returns>
    private static bool checkFake(string v) {
        return (v == "" ? false : true);
    }


    /// <summary>
    /// This is not really a substr, but close enough. =)
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="char_length"></param>
    /// <returns>string</returns>
    public static string substr(string noun, int char_length) {
        if(char_length >= noun.Length) return noun;
        return noun.Substring(noun.Length - char_length);
    }


    /**

           Accusative Case

     */


    /// <summary>
    /// Accusative case
    /// </summary>
    /// <param name="noun"></param>
    /// <returns>string</returns>
    public static string belirtmeHali(string noun) {
        return belirtmeHali(noun, "");
    }

    public static string accusativeCase(string noun) {
        return belirtmeHali(noun, "");
    }

    /// <summary>
    /// Accusative case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake"></param>
    /// <returns>string</returns>
    public static string belirtmeHali(string noun, bool fake) {
        return belirtmeHali(noun, "");
    }

    public static string accusativeCase(string noun, bool fake) {
        return belirtmeHali(noun, "");
    }

    /// <summary>
    /// Accusative case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
    /// <returns>string</returns>
    public static string belirtmeHali(string noun, string fake) {
        noun = noun.Trim();
        bool isFake = checkFake(fake);

        //  Check the ending if it's a number
        if(Regex.IsMatch(noun, @"\d$")) return processForNumber(belirtmeHali, noun);

        string last_letter = substr(noun, 1);
        string last_3_letter = substr(noun, 3);
        string[] nouns = noun.Split(' ');
        string last_noun = nouns[nouns.Length - 1];
        int last_noun_length = last_noun.Length;

        if(isFake != false) noun = fake;

        string blending = "";
        if((Regex.IsMatch(last_letter, vowel) || (Regex.IsMatch(last_3_letter, "[çÇ]") && Regex.IsMatch(last_letter, vowelE))) && !Regex.IsMatch(last_letter, "[ğçĞÇ]") && !Regex.IsMatch(last_3_letter, "^çü|^ÇÜ|^ÇÖ|^çö")) blending = "y";
        if(Regex.IsMatch(last_noun, nounPhraseEnds) && last_noun_length > 6) blending = "n";

        var vowels = Regex.Matches(last_3_letter, vowel);
        string suffix = "i";
        if(vowels.Count == 0) return (noun + "'" + blending + suffix);

        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[öüÖÜ]")) suffix = "ü";
        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[aıAI]")) suffix = "ı";
        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[ouOU]")) suffix = "u";

        return (noun + "'" + blending + suffix);
    }

    public static string accusativeCase(string noun, string fake) {
        return belirtmeHali(noun, fake);
    }


    /**

           Dative Case

     */


    /// <summary>
    /// Dative case
    /// </summary>
    /// <param name="noun"></param>
    /// <returns>string</returns>
    public static string yonelmeHali(string noun) {
        return yonelmeHali(noun, "");
    }

    public static string dativeCase(string noun) {
        return yonelmeHali(noun, "");
    }

    /// <summary>
    /// Dative case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake"></param>
    /// <returns>string</returns>
    public static string yonelmeHali(string noun, bool fake) {
        return yonelmeHali(noun, "");
    }

    public static string dativeCase(string noun, bool fake) {
        return yonelmeHali(noun, "");
    }

    /// <summary>
    /// Dative case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
    /// <returns>string</returns>
    public static string yonelmeHali(string noun, string fake) {
        noun = noun.Trim();
        bool isFake = checkFake(fake);

        //  Check the ending if it's a number
        if(Regex.IsMatch(noun, @"\d$")) return processForNumber(yonelmeHali, noun);

        string last_letter = substr(noun, 1);
        string last_3_letter = substr(noun, 3);
        string[] nouns = noun.Split(' ');
        string last_noun = nouns[nouns.Length - 1];
        int last_noun_length = last_noun.Length;

        if(isFake != false) noun = fake;

        string blending = "";
        if((Regex.IsMatch(last_letter, vowel) || (Regex.IsMatch(last_3_letter, "[çÇ]") && Regex.IsMatch(last_letter, vowelE))) && !Regex.IsMatch(last_letter, "[ğçĞÇ]") && !Regex.IsMatch(last_3_letter, "^çü|^ÇÜ|^ÇÖ|^çö")) blending = "y";
        if(Regex.IsMatch(last_noun, nounPhraseEnds) && last_noun_length > 6) blending = "n";

        var vowels = Regex.Matches(last_3_letter, vowel);
        string suffix = "e";
        if(vowels.Count == 0) return (noun + "'" + blending + suffix);

        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[ouaıOUAI]")) suffix = "a";

        return (noun + "'" + blending + suffix);
    }

    public static string dativeCase(string noun, string fake) {
        return yonelmeHali(noun, fake);
    }


    /**

           Locative Case

     */


    /// <summary>
    /// Locative Case
    /// </summary>
    /// <param name="noun"></param>
    /// <returns>string</returns>
    public static string bulunmaHali(string noun) {
        return bulunmaHali(noun, "");
    }

    public static string locativeCase(string noun) {
        return bulunmaHali(noun, "");
    }

    /// <summary>
    /// Locative Case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake"></param>
    /// <returns>string</returns>
    public static string bulunmaHali(string noun, bool fake) {
        return bulunmaHali(noun, "");
    }

    public static string locativeCase(string noun, bool fake) {
        return bulunmaHali(noun, "");
    }

    /// <summary>
    /// Locative Case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
    /// <returns>string</returns>
    public static string bulunmaHali(string noun, string fake) {
        noun = noun.Trim();
        bool isFake = checkFake(fake);

        //  Check the ending if it's a number
        if(Regex.IsMatch(noun, @"\d$")) return processForNumber(bulunmaHali, noun);

        string last_letter = substr(noun, 1);
        string last_3_letter = substr(noun, 3);
        string last_2_letter = substr(noun, 2);
        string[] nouns = noun.Split(' ');
        string last_noun = nouns[nouns.Length - 1];
        int last_noun_length = last_noun.Length;

        if(isFake != false) noun = fake;

        string blending = "";
        if(Regex.IsMatch(last_noun, nounPhraseEnds) && last_noun_length > 6) blending = "n";

        string suffix = "d";
        string suffix_ = "e";
        if(Regex.IsMatch(last_2_letter, "[pçktfşhPÇKTFŞH]")) suffix = "t";
        if(Regex.IsMatch(last_letter, "[ğĞ]")) suffix = "d";
        if(Regex.IsMatch(last_2_letter, "(?i)ş|s|ç")) suffix = "t";
        if(Regex.IsMatch(last_letter, vowel)) suffix = "d";
        if(Regex.IsMatch(last_3_letter, "şk|ŞK")) suffix_ = "a";

        var vowels = Regex.Matches(last_3_letter, vowel);

        if(vowels.Count == 0) return (noun + "'" + blending + suffix + suffix_);

        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[ouaıOUAI]")) suffix = "a";
        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[öüeiÖÜEİ]")) suffix = "e";

        return (noun + "'" + blending + suffix + suffix_);
    }

    public static string locativeCase(string noun, string fake) {
        return bulunmaHali(noun, fake);
    }


    /**

           Ablative Case

     */


    /// <summary>
    /// Ablative Case
    /// </summary>
    /// <param name="noun"></param>
    /// <returns>string</returns>
    public static string ayrilmaHali(string noun) {
        return ayrilmaHali(noun, "");
    }

    public static string ablativeCase(string noun) {
        return ayrilmaHali(noun, "");
    }

    /// <summary>
    /// Ablative Case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake"></param>
    /// <returns>string</returns>
    public static string ayrilmaHali(string noun, bool fake) {
        return ayrilmaHali(noun, "");
    }

    public static string ablativeCase(string noun, bool fake) {
        return ayrilmaHali(noun, "");
    }

    /// <summary>
    /// Ablative Case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
    /// <returns>string</returns>
    public static string ayrilmaHali(string noun, string fake) {
        noun = noun.Trim();
        bool isFake = checkFake(fake);

        //  Check the ending if it's a number
        if(Regex.IsMatch(noun, @"\d$")) return processForNumber(ayrilmaHali, noun);

        string last_letter = substr(noun, 1);
        string last_3_letter = substr(noun, 3);
        string last_2_letter = substr(noun, 2);
        string[] nouns = noun.Split(' ');
        string last_noun = nouns[nouns.Length - 1];
        int last_noun_length = last_noun.Length;

        if(isFake != false) noun = fake;

        string blending = "";
        if(Regex.IsMatch(last_noun, nounPhraseEnds) && last_noun_length > 6) blending = "n";

        string suffix = "d";
        string suffix_ = "e";
        if(Regex.IsMatch(last_2_letter, "[pçktfşhPÇKTFŞH]")) suffix = "t";
        if(Regex.IsMatch(last_letter, "[ğĞ]")) suffix = "d";
        if(Regex.IsMatch(last_2_letter, "(?i)ş|s|ç")) suffix = "t";
        if(Regex.IsMatch(last_letter, vowel)) suffix = "d";
        if(Regex.IsMatch(last_3_letter, "şk|ŞK")) suffix_ = "a";

        var vowels = Regex.Matches(last_3_letter, vowel);

        if(vowels.Count == 0) return (noun + "'" + blending + suffix + suffix_ + "n");

        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[ouaıOUAI]")) suffix = "a";
        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[öüeiÖÜEİ]")) suffix = "e";

        return (noun + "'" + blending + suffix + suffix_ + "n");
    }

    public static string ablativeCase(string noun, string fake) {
        return ayrilmaHali(noun, fake);
    }


    /**

           Genitive Case

     */


    /// <summary>
    /// Genitive Case
    /// </summary>
    /// <param name="noun"></param>
    /// <returns>string</returns>
    public static string sahiplikHali(string noun) {
        return sahiplikHali(noun, "");
    }

    public static string genitiveCase(string noun) {
        return sahiplikHali(noun, "");
    }

    /// <summary>
    /// Genitive Case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake"></param>
    /// <returns>string</returns>
    public static string sahiplikHali(string noun, bool fake) {
        return sahiplikHali(noun, "");
    }

    public static string genitiveCase(string noun, bool fake) {
        return sahiplikHali(noun, "");
    }

    /// <summary>
    /// Genitive Case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
    /// <returns>string</returns>
    public static string sahiplikHali(string noun, string fake) {
        noun = noun.Trim();
        bool isFake = checkFake(fake);

        //  Check the ending if it's a number
        if(Regex.IsMatch(noun, @"\d$")) return processForNumber(sahiplikHali, noun);

        string last_letter = substr(noun, 1);
        string last_3_letter = substr(noun, 3);

        if(isFake != false) noun = fake;

        string blending = "";
        if(Regex.IsMatch(last_letter, vowel)) blending = "n";

        var vowels = Regex.Matches(last_3_letter, vowel);

        string suffix = "i";
        if(vowels.Count == 0) return (noun + "'" + blending + suffix + "n");

        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[öüÖÜ]")) suffix = "ü";
        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[aıAI]")) suffix = "ı";
        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[ouOU]")) suffix = "u";

        return (noun + "'" + blending + suffix + "n");
    }

    public static string genitiveCase(string noun, string fake) {
        return sahiplikHali(noun, fake);
    }


    /**

           Comitative Case

     */


    /// <summary>
    /// Comitative Case
    /// </summary>
    /// <param name="noun"></param>
    /// <returns>string</returns>
    public static string vasitaHali(string noun) {
        return vasitaHali(noun, "");
    }

    public static string comitativeCase(string noun) {
        return vasitaHali(noun, "");
    }

    /// <summary>
    /// Comitative Case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake"></param>
    /// <returns>string</returns>
    public static string vasitaHali(string noun, bool fake) {
        return vasitaHali(noun, "");
    }

    public static string comitativeCase(string noun, bool fake) {
        return vasitaHali(noun, "");
    }

    /// <summary>
    /// Comitative Case
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
    /// <returns>string</returns>
    public static string vasitaHali(string noun, string fake) {
        noun = noun.Trim();
        bool isFake = checkFake(fake);

        //  Check the ending if it's a number
        if(Regex.IsMatch(noun, @"\d$")) return processForNumber(vasitaHali, noun);

        string last_letter = substr(noun, 1);
        string last_3_letter = substr(noun, 3);

        if(isFake != false) noun = fake;

        string blending = "";
        if(Regex.IsMatch(last_letter, vowel)) blending = "y";

        var vowels = Regex.Matches(last_3_letter, vowel);

        string suffix = "e";
        if(vowels.Count == 0) return (noun + "'" + blending + "l" + suffix);

        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[ouaıOUAI]")) suffix = "a";

        return (noun + "'" + blending + "l" + suffix);
    }

    public static string comitativeCase(string noun, string fake) {
        return vasitaHali(noun, fake);
    }


    /**

           Conjuction

     */


    /// <summary>
    /// Conjuction
    /// </summary>
    /// <param name="noun"></param>
    /// <returns>string</returns>
    public static string dahiBaglac(string noun) {
        return dahiBaglac(noun, "");
    }

    public static string conjunction(string noun) {
        return dahiBaglac(noun, "");
    }

    /// <summary>
    /// Conjuction
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake"></param>
    /// <returns>string</returns>
    public static string dahiBaglac(string noun, bool fake) {
        return dahiBaglac(noun, "");
    }

    public static string conjunction(string noun, bool fake) {
        return dahiBaglac(noun, "");
    }

    /// <summary>
    /// Conjuction  (I'm not sure if this is the correct meaning of this)
    /// </summary>
    /// <param name="noun"></param>
    /// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
    /// <returns>string</returns>
    public static string dahiBaglac(string noun, string fake) {
        noun = noun.Trim();
        bool isFake = checkFake(fake);

        //  Check the ending if it's a number
        if(Regex.IsMatch(noun, @"\d$")) return processForNumber(dahiBaglac, noun);

        string last_3_letter = substr(noun, 3);

        if(isFake != false) noun = fake;

        var vowels = Regex.Matches(last_3_letter, vowel);

        string blending = "d";
        string suffix = "e";
        if(vowels.Count == 0) return (noun + " " + blending + suffix);

        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[ouaıOUAI]")) suffix = "a";

        return (noun + " " + blending + suffix);
    }

    public static string conjunction(string noun, string fake) {
        return dahiBaglac(noun, fake);
    }


    /**

           Ordinal Number

     */


    /// <summary>
    /// Ordinal Number
    /// </summary>
    /// <param name="number"></param>
    /// <returns>string</returns>
    public static string siraSayi(string number) {
        return siraSayi(number, "");
    }

    public static string ordinalNumber(string number) {
        return siraSayi(number, "");
    }

    /// <summary>
    /// Ordinal Number
    /// </summary>
    /// <param name="number"></param>
    /// <param name="integer"></param>
    /// <returns>string</returns>
    public static string siraSayi(string number, bool integer) {
        return siraSayi(number, "");
    }

    public static string ordinalNumber(string number, bool integer) {
        return siraSayi(number, "");
    }

    /// <summary>
    /// Ordinal Number
    /// </summary>
    /// <param name="number"></param>
    /// <param name="integer">if it's a integer, use "'", otherwise don't.</param>
    ///
    /// !Warning: Don't give integer when you directly call this method, because it'll override the number with your integer.
    ///           This is mostly for internal use (see processForNumber())
    ///
    /// <returns>string</returns>
    public static string siraSayi(string number, string integer) {
        number = number.Trim();
        bool isFake = checkFake(integer);

        //  Check the ending if it's a number
        if(Regex.IsMatch(number, @"\d$")) return processForNumber(siraSayi, number);

        string last_letter = substr(number, 1);
        string last_3_letter = substr(number, 3);

        //  Check if the ending with "ört", if so make it "örd" (only for "dört")
        if(last_3_letter.ToLower() == "ört") number = number.Substring(0, number.Length - 1) + (last_letter == "t" ? "d" : "D");

        if(isFake != false) number = integer;

        string blending = "i";
        var vowels = Regex.Matches(last_3_letter, vowel);
        string suffix = "i";

        if(vowels.Count == 0) return (number + (integer ? "'" : "") + blending + "nc" + suffix);

        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[öüÖÜ]")) suffix = "ü";
        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[aıAI]")) suffix = "ı";
        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[ouOU]")) suffix = "u";

        if(!Regex.IsMatch(last_letter, vowel)) blending = suffix; else blending = "";

        return (number + (integer ? "'" : "") + blending + "nc" + suffix);
    }

    public static string ordinalNumber(string number, string integer) {
        return siraSayi(number, integer);
    }


    /**

           Distributive

     */


    /// <summary>
    /// Distributive
    /// </summary>
    /// <param name="number"></param>
    /// <returns>string</returns>
    public static string ulestirme(string number) {
        return ulestirme(number, "");
    }

    public static string distributive(string number) {
        return ulestirme(number, "");
    }

    /// <summary>
    /// Distributive
    /// </summary>
    /// <param name="number"></param>
    /// <param name="integer"></param>
    /// <returns>string</returns>
    public static string ulestirme(string number, bool integer) {
        return ulestirme(number, "");
    }

    public static string distributive(string number, bool integer) {
        return ulestirme(number, "");
    }

    /// <summary>
    /// Distributive
    /// </summary>
    /// <param name="number"></param>
    /// <param name="integer">if it's a integer, use "'", otherwise don't.</param>
    ///
    /// !Warning: Don't give integer when you directly call this method, because it'll override the number with your integer.
    ///           This is mostly for internal use (see processForNumber())
    ///
    /// <returns>string</returns>
    public static string ulestirme(string number, string integer) {
        number = number.Trim();
        bool isFake = checkFake(integer);

        //  Check the ending if it's a number
        if(Regex.IsMatch(number, @"\d$")) return processForNumber(ulestirme, number);

        string last_letter = substr(number, 1);
        string last_3_letter = substr(number, 3);

        //  Check if the ending with "ört", if so make it "örd" (only for "dört")
        if(last_3_letter.ToLower() == "ört") number = number.Substring(0, number.Length - 1) + (last_letter == "t" ? "d" : "D");

        if(isFake != false) number = integer;

        string blending = "";
        var vowels = Regex.Matches(last_3_letter, vowel);
        string suffix = "e";

        if(vowels.Count == 0) return (number + (integer ? "'" : "") + blending + suffix + "r");

        if(Regex.IsMatch(vowels[vowels.Count - 1].ToString(), "[ouaıOUAI]")) suffix = "a";

        if(Regex.IsMatch(last_letter, vowel)) blending = "ş";

        return (number + (integer ? "'" : "") + blending + suffix + "r");
    }

    public static string distributive(string number, string integer) {
        return ulestirme(number, integer);
    }


    /**

           Number Processing

     */


    /// <summary>
    /// This is for the numbers. It returns callback function with given number's pronounce
    /// </summary>
    /// <param name="noun"></param>
    /// <returns>string</returns>
    public static string processForNumber(string noun) {
        return processForNumber(belirtmeHali, noun);
    }

    /// <summary>
    /// This is for the numbers. It returns callback function with given number's pronounce
    /// </summary>
    /// <param name="callback"></param>
    /// <param name="noun"></param>
    /// <returns>string</returns>
    public static string processForNumber(Func<string, string, string> callback, string noun) {
        string[] last_number_array = Regex.Split(noun, @"\D");
        string last_number = last_number_array[last_number_array.Length - 1];

        if(last_number == "0") {
            // it is directly zero
            return callback("fır", noun);
        }

        //  We don't need a full word, last 3 letters'd be enough
        Dictionary<string, string> endings = new Dictionary<string, string>()
        {
            {"1","bir"},
            {"2","iki"},
            {"3","üç"},
            {"4","ört"},
            {"5","beş"},
            {"6","ltı"},
            {"7","edi"},
            {"8","kiz"},
            {"9","kuz"},
            {"10","on"},
            {"20","rmi"},
            {"30","tuz"},
            {"40","ırk"},
            {"50","lli"},
            {"60","mış"},
            {"70","miş"},
            {"80","sen"},
            {"90","san"}
        };

        //  last number's length
        int digit_length = last_number.Length;

        //  Check last number
        string last_1_letter = substr(noun, 1);
        string[] last_1_number_array = Regex.Split(last_1_letter, @"^\D");
        string last_1_number = last_1_number_array[last_1_number_array.Length - 1];
        if(last_1_number != "0") return callback(endings[last_1_number], noun);

        //  Check last two numbers
        string last_2_letter = substr(noun, 2);
        string[] last_2_number_array = Regex.Split(last_2_letter, @"^\D");
        string last_2_number = last_2_number_array[last_2_number_array.Length - 1];
        if(last_2_number != "00") return callback(endings[last_2_number], noun);

        //  Check last three numbers
        string last_3_letter = substr(noun, 3);
        string[] last_3_number_array = Regex.Split(last_3_letter, @"^\D");
        string last_3_number = last_3_number_array[last_3_number_array.Length - 1];
        if(last_3_number != "000") return callback(endings[last_3_number], noun);

        //  Check last four numbers
        string last_4_letter = substr(noun, 4);
        string[] last_4_number_array = Regex.Split(last_4_letter, @"^\D");
        string last_4_number = last_4_number_array[last_4_number_array.Length - 1];
        if(last_4_number != "0000" || digit_length < 7) return callback(endings[last_4_number], noun);

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
        return callback(noun, "");
    }
}