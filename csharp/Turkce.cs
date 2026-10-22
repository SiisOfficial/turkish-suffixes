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

using System;
using System.Collections.Generic;
using System.Text.RegularExpressions;

public static class Turkce
{
	/*
	|--------------------------------------------------------------------------
	| Turkish Case Suffixes Class For C#
	|--------------------------------------------------------------------------
	|
	|   Should work with .NET >=2.0 and Unity 6.
	|
	|   --------
	|
	|   .NET 2.0, modern .NET ve Unity 6 üzerinde çalışıyor olmalı.
	|
	*/

	private static readonly Regex NounPhraseRegex =
		new Regex(@"(?i)(oğlu|esi|aşı|işi|eşi|ağı|isi|iği|ığı|ıgı|oglu|okulu|leri|ları|lari|üğü|kısmı|kismi|bölümü|bolumu|merkezi|[aıeiouöü]s[ıiuü])$",
				  RegexOptions.Compiled);

	private static readonly Regex VowelRegex  = new Regex(@"[oueiöüaıOUEİÖÜAI]", RegexOptions.Compiled);
	private static readonly Regex FilterRegex = new Regex(@"[^0-9a-zA-ZğĞüÜöÖşŞıİçÇ\s₺€$¥£]", RegexOptions.Compiled);

	//  This is a backup solution for noun phrases.
	//  We'll directly look for the last word.
	//  If string[] nouns count is more than one
	//  and string last_noun (word) is in this array,
	//  it's probably a noun phrase.
	private static readonly HashSet<string> NounPhraseWords = new HashSet<string>(StringComparer.OrdinalIgnoreCase)
															  {
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
															  };

	//  Thin vowel exceptions (words with back vowels that take front-vowel suffixes)
	private static readonly HashSet<string> ThinVowelExceptions = new HashSet<string>(StringComparer.OrdinalIgnoreCase)
																  {
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
																  };

	//  Single letters for acronyms without vowels (TDK, TRT, 1B, etc.)
	private static readonly Dictionary<string, string> SingleLetters = new Dictionary<string, string>(StringComparer.OrdinalIgnoreCase)
																	   {
																		   {"a", "a"},
																		   {"b", "be"},
																		   {"c", "ce"},
																		   {"ç", "çe"},
																		   {"d", "de"},
																		   {"e", "e"},
																		   {"f", "fe"},
																		   {"g", "ge"},
																		   {"ğ", "ğe"},
																		   {"h", "he"},
																		   {"ı", "ı"},
																		   {"i", "i"},
																		   {"j", "je"},
																		   {"k", "ke"},
																		   {"l", "le"},
																		   {"m", "me"},
																		   {"n", "ne"},
																		   {"o", "o"},
																		   {"ö", "ö"},
																		   {"p", "pe"},
																		   {"r", "re"},
																		   {"s", "se"},
																		   {"ş", "şe"},
																		   {"t", "te"},
																		   {"u", "u"},
																		   {"ü", "ü"},
																		   {"v", "ve"},
																		   {"y", "ye"},
																		   {"z", "ze"},
																		   {"q", "kü"},
																		   {"w", "ve"},
																		   {"x", "iks"}
																	   };

	//  This is the simplest & fastest solution for now.
	//  I really don't want to check last noun of given string noun,
	//  bacause (for example vive) last noun can be a Turkish brand or something.
	//  I'd suggest you to use string fake (like Turkce.accusativeCase("yıv", "view");).
	//
	//  Only for some brands, people, products, etc.
	private static readonly Dictionary<string, string> Pronounces = new Dictionary<string, string>(StringComparer.OrdinalIgnoreCase)
																	{
																		{"apple", "pıl"},
																		{"google", "gıl"},
																		{"twitter", "tır"},
																		{"youtube", "tup"},
																		{"chrome", "rom"},
																		{"developer", "pır"},
																		{"board", "ord"},
																		{"cardboard", "ord"},
																		{"iphone", "fon"},
																		{"ipad", "ped"},
																		{"watch", "voç"},
																		{"imessage", "sıc"},
																		{"mac", "mek"},
																		{"macbook", "buk"},
																		{"php", "çpi"},
																		{"steam", "tim"},
																		{"valve", "alv"},
																		{"messenger", "cır"},
																		{"snapchat", "çet"},
																		{"chat", "çet"},
																		{"skype", "ayp"},
																		{"unity", "iti"},
																		{"spotify", "fay"},
																		{"htc", "ysi"},
																		{"half-life", "ayf"},
																		{"halflife", "ayf"},
																		{"htcvive", "avy"},
																		{"9gag", "geg"},
																		{"tv", "ivi"},
																		{"usa", "sey"},
																		{"maps", "eps"},
																		{"cern", "örn"},
																		{"adobe", "dob"},
																		{"imdb", "ibi"},
																		{"italy", "ali"},
																		{"store", "tor"},
																		{"appstore", "tor"},
																		{"playstore", "tor"},
																		{"psn", "esen"},
																		{"xboxlive", "ayv"},
																		{"einstein", "ayn"},
																		{"xcode", "kod"},
																		{"github", "hab"},
																		{"bitbucket", "kıt"},
																		{"slipknot", "nat"},
																		{"maiden", "dın"},
																		{"slayer", "yır"},
																		{"thrones", "ons"},
																		{"simpsons", "ıns"},
																		{"guy", "gay"},
																		{"wars", "ors"},
																		{"vader", "dır"},
																		{"beethoven", "vın"},
																		{"vr", "yar"},
																		{"ar", "yar"},
																		{"station", "şın"},
																		{"steamvr", "yar"},
																		{"osvr", "yar"},
																		{"first", "öst"},
																		{"engine", "cin"},
																		{"cryengine", "cin"},
																		{"$", "lar"},
																		{"€", "uro"},
																		{"₺", "ele"},
																		{"¥", "yen"},
																		{"£", "lin"},
																		{"tl", "ele"},
																		{"+", "tı"},
																		{"ios", "ayoes"},
																		{"macos", "oes"},
																		{"tvos", "oes"},
																		{"watchos", "oes"},
																		{"ipados", "oes"},
																		{"visionos", "oes"},
																		{"android", "yid"},
																		{"windows", "dovs"},
																		{"steamos", "oes"},
																		{"linux", "nuks"},
																		{"deck", "dek"},
																		{"frame", "reym"},
																		{"machine", "şin"},
																		{"switch", "viç"},
																		{"center", "tır"},
																		{"services", "sız"},
																		{"support", "port"},
																		{"supporter", "tır"},
																		{"discord", "kord"},
																		{"paypal", "pal"},
																		{"street", "rit"},
																		{"game", "geym"},
																		{"play", "ley"},
																		{"blay", "ley"},
																		{"playstation", "şın"},
																		{"xbox", "baks"},
																		{"series", "riz"},
																		{"edition", "şın"},
																		{"max", "meks"},
																		{"plus", "plas"},
																		{"ai", "eyay"},
																		{"openai", "eyay"},
																		{"chatgpt", "piti"},
																		{"gpt", "piti"},
																		{"gemini", "nay"},
																		{"claude", "klod"},
																		{"copilot", "lıt"},
																		{"threads", "reds"},
																		{"tiktok", "tok"},
																		{"reels", "ılz"},
																		{"shorts", "şorts"},
																		{"twitch", "viç"},
																		{"netflix", "fliks"},
																		{"nvidia", "vidya"}
																	};

	private static bool IsVowel(char c) => c is 'a' or 'e' or 'ı' or 'i' or 'o' or 'ö' or 'u' or 'ü' or 'A' or 'E' or 'I' or 'İ' or 'O' or 'Ö' or 'U' or 'Ü';

	private static char? GetLastVowel(string text)
	{
		for(int i = text.Length - 1; i >= 0; i--)
		{
			if(IsVowel(text[i]))
				return text[i];
		}

		return null;
	}

	/// <summary>
	/// This is not really a substr, but close enough. =)
	/// </summary>
	/// <param name="noun"></param>
	/// <param name="charLength"></param>
	/// <returns>string</returns>
	public static string Substr(this string noun, int charLength)
	{
		if(string.IsNullOrEmpty(noun))
			return "";
		return charLength >= noun.Length ? noun : noun[^charLength..];
	}

	private static string FilterAndTrim(this string noun) => string.IsNullOrEmpty(noun) ? "" : FilterRegex.Replace(noun, "").Trim();

	private static string ToTurkishLower(string text) => text.Replace('İ', 'i').Replace('I', 'ı').ToLowerInvariant();

	private static char ToTurkishLower(char character) =>
		character == 'İ' ? 'i' : character == 'I' ? 'ı' : char.ToLowerInvariant(character);

	/// <summary>
	/// Checks the noun if it has a pronounce in pronounces or is a letter abbreviation
	/// </summary>
	/// <param name="n"></param>
	/// <returns>string</returns>
	private static string CheckHasPronounce(string n)
	{
		if(string.IsNullOrWhiteSpace(n))
			return null;

		int    lastSpace = n.LastIndexOf(' ');
		string lastWord  = ToTurkishLower(lastSpace >= 0 ? n[(lastSpace + 1)..] : n);

		if((lastWord.StartsWith("#") || lastWord.StartsWith("@")) && lastWord.Length > 1)
		{
			if(Pronounces.TryGetValue(lastWord[1..], out var tagPronounce))
				return tagPronounce;
		}

		if(Pronounces.TryGetValue(lastWord, out var pronounce))
			return pronounce;

		var match = Regex.Match(n, @"(^|\d+|[\s\-_])([a-zA-ZğĞüÜöÖşŞıİçÇ])$");
		if(match.Success)
		{
			var charKey = ToTurkishLower(match.Groups[2].Value);
			if(SingleLetters.TryGetValue(charKey, out var letterPronounce))
				return letterPronounce;
		}

		// Acronym without vowels fallback (TDK, TRT, etc.)
		if(lastWord.Length > 1 && !VowelRegex.IsMatch(lastWord))
		{
			string lastChar = lastWord[^1..];
			if(SingleLetters.TryGetValue(lastChar, out var letterPronounce))
				return letterPronounce;
		}

		return null;
	}

	private static bool IsNounPhrase(string[] nouns, string lastNoun)
	{
		if(nouns.Length <= 1)
			return false;
		string clean = ToTurkishLower(lastNoun);
		return NounPhraseWords.Contains(clean) || NounPhraseRegex.IsMatch(clean);
	}

	private static bool IsThinException(string word)
	{
		return ThinVowelExceptions.Contains(ToTurkishLower(word.Trim()));
	}

	private static string FormatOutput(string orgNoun, string blending, string suffix)
	{
		bool hasQuote = orgNoun.EndsWith("\"") || orgNoun.EndsWith("'");
		return orgNoun + (hasQuote ? "" : "'") + blending + suffix;
	}


#region Belirtme Hali | Accusative Case

	/// <summary>
	/// Accusative case
	/// </summary>
	/// <param name="noun"></param>
	/// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
	/// <returns>string</returns>
	public static string BelirtmeHali(this string noun, string fake = "")
	{
		var orgNoun = noun?.Trim() ?? "";
		noun = orgNoun.FilterAndTrim();
		bool isFake = !string.IsNullOrEmpty(fake);

		if(!isFake)
		{
			var fake_ = CheckHasPronounce(noun);
			if(fake_ != null)
			{
				fake   = orgNoun;
				noun   = fake_;
				isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(Regex.IsMatch(noun, @"\d$"))
			return ProcessForNumber(BelirtmeHali, orgNoun);

		var lastLetter = noun.Substr(1);
		var last3      = noun.Substr(3);
		var nouns      = noun.Split(new[] {' '}, StringSplitOptions.RemoveEmptyEntries);
		var lastNoun   = nouns.Length > 0 ? nouns[^1] : "";

		if(isFake)
			orgNoun = fake;

		string blending = "";
		if(lastLetter.Length > 0 && IsVowel(lastLetter[0]))
			blending = "y";

		if(IsNounPhrase(nouns, lastNoun))
			blending = "n";

		string suffix = "i";
		if(IsThinException(lastNoun))
		{
			suffix = "i";
		}
		else
		{
			char? lastVowel = GetLastVowel(last3);
			if(lastVowel.HasValue)
			{
				char v = ToTurkishLower(lastVowel.Value);
				if(v is 'ö' or 'ü')
					suffix = "ü";
				else if(v is 'a' or 'ı')
					suffix = "ı";
				else if(v is 'o' or 'u')
					suffix = "u";
			}
		}

		return FormatOutput(orgNoun, blending, suffix);
	}

	public static string AccusativeCase(this string noun, string fake = "") => noun.BelirtmeHali(fake);
	public static string Yi(this             string noun, string fake = "") => noun.BelirtmeHali(fake);

#endregion


#region Yonelme Hali | Dative Case

	/// <summary>
	/// Dative case
	/// </summary>
	/// <param name="noun"></param>
	/// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
	/// <returns>string</returns>
	public static string YonelmeHali(this string noun, string fake = "")
	{
		var orgNoun = noun?.Trim() ?? "";
		noun = orgNoun.FilterAndTrim();
		bool isFake = !string.IsNullOrEmpty(fake);

		if(!isFake)
		{
			var fake_ = CheckHasPronounce(noun);
			if(fake_ != null)
			{
				fake   = orgNoun;
				noun   = fake_;
				isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(Regex.IsMatch(noun, @"\d$"))
			return ProcessForNumber(YonelmeHali, orgNoun);

		var lastLetter = noun.Substr(1);
		var last3      = noun.Substr(3);
		var nouns      = noun.Split(new[] {' '}, StringSplitOptions.RemoveEmptyEntries);
		var lastNoun   = nouns.Length > 0 ? nouns[^1] : "";

		if(isFake)
			orgNoun = fake;

		string blending = "";
		if(lastLetter.Length > 0 && IsVowel(lastLetter[0]))
			blending = "y";

		if(IsNounPhrase(nouns, lastNoun))
			blending = "n";

		string suffix = "e";
		if(!IsThinException(lastNoun))
		{
			char? lastVowel = GetLastVowel(last3);
			if(lastVowel.HasValue)
			{
				char v = ToTurkishLower(lastVowel.Value);
				if(v is 'a' or 'ı' or 'o' or 'u')
					suffix = "a";
			}
		}

		return FormatOutput(orgNoun, blending, suffix);
	}

	public static string DativeCase(this string noun, string fake = "") => noun.YonelmeHali(fake);
	public static string Ye(this         string noun, string fake = "") => noun.YonelmeHali(fake);

#endregion


#region Bulunma Hali | Locative Case

	/// <summary>
	/// Locative Case
	/// </summary>
	/// <param name="noun"></param>
	/// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
	/// <returns>string</returns>
	public static string BulunmaHali(this string noun, string fake = "")
	{
		var orgNoun = noun?.Trim() ?? "";
		noun = orgNoun.FilterAndTrim();
		bool isFake = !string.IsNullOrEmpty(fake);

		if(!isFake)
		{
			var fake_ = CheckHasPronounce(noun);
			if(fake_ != null)
			{
				fake   = orgNoun;
				noun   = fake_;
				isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(Regex.IsMatch(noun, @"\d$"))
			return ProcessForNumber(BulunmaHali, orgNoun);

		var lastLetter = noun.Substr(1);
		var last3      = noun.Substr(3);
		var nouns      = noun.Split(new[] {' '}, StringSplitOptions.RemoveEmptyEntries);
		var lastNoun   = nouns.Length > 0 ? nouns[^1] : "";

		if(isFake)
			orgNoun = fake;

		string blending = "";
		if(IsNounPhrase(nouns, lastNoun))
			blending = "n";

		string suffix  = "d";
		string suffix_ = "e";

		if(Regex.IsMatch(lastLetter, "[pçktfşhPÇKTFŞH]"))
			suffix = "t";
		if(Regex.IsMatch(last3, "şk|ŞK"))
			suffix_ = "a";

		if(!IsThinException(lastNoun))
		{
			char? lastVowel = GetLastVowel(last3);
			if(lastVowel.HasValue)
			{
				char v = ToTurkishLower(lastVowel.Value);
				if(v is 'a' or 'ı' or 'o' or 'u')
					suffix_ = "a";
				else if(v is 'e' or 'i' or 'ö' or 'ü')
					suffix_ = "e";
			}
		}

		return FormatOutput(orgNoun, blending, suffix + suffix_);
	}

	public static string LocativeCase(this string noun, string fake = "") => noun.BulunmaHali(fake);
	public static string De(this           string noun, string fake = "") => noun.BulunmaHali(fake);

#endregion


#region Ayrilma Hali | Ablative Case

	/// <summary>
	/// Ablative Case
	/// </summary>
	/// <param name="noun"></param>
	/// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
	/// <returns>string</returns>
	public static string AyrilmaHali(this string noun, string fake = "")
	{
		var orgNoun = noun?.Trim() ?? "";
		noun = orgNoun.FilterAndTrim();
		bool isFake = !string.IsNullOrEmpty(fake);

		if(!isFake)
		{
			var fake_ = CheckHasPronounce(noun);
			if(fake_ != null)
			{
				fake   = orgNoun;
				noun   = fake_;
				isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(Regex.IsMatch(noun, @"\d$"))
			return ProcessForNumber(AyrilmaHali, orgNoun);

		var lastLetter = noun.Substr(1);
		var last3      = noun.Substr(3);
		var nouns      = noun.Split(new[] {' '}, StringSplitOptions.RemoveEmptyEntries);
		var lastNoun   = nouns.Length > 0 ? nouns[^1] : "";

		if(isFake)
			orgNoun = fake;

		string blending = "";
		if(IsNounPhrase(nouns, lastNoun))
			blending = "n";

		string suffix  = "d";
		string suffix_ = "e";

		if(Regex.IsMatch(lastLetter, "[pçktfşhPÇKTFŞH]"))
			suffix = "t";
		if(Regex.IsMatch(last3, "şk|ŞK"))
			suffix_ = "a";

		if(!IsThinException(lastNoun))
		{
			char? lastVowel = GetLastVowel(last3);
			if(lastVowel.HasValue)
			{
				char v = ToTurkishLower(lastVowel.Value);
				if(v is 'a' or 'ı' or 'o' or 'u')
					suffix_ = "a";
				else if(v is 'e' or 'i' or 'ö' or 'ü')
					suffix_ = "e";
			}
		}

		return FormatOutput(orgNoun, blending, suffix + suffix_ + "n");
	}

	public static string AblativeCase(this string noun, string fake = "") => noun.AyrilmaHali(fake);
	public static string Den(this          string noun, string fake = "") => noun.AyrilmaHali(fake);

#endregion


#region Sahiplik Hali | Genitive Case

	/// <summary>
	/// Genitive Case
	/// </summary>
	/// <param name="noun"></param>
	/// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
	/// <returns>string</returns>
	public static string SahiplikHali(this string noun, string fake = "")
	{
		var orgNoun = noun?.Trim() ?? "";
		noun = orgNoun.FilterAndTrim();
		bool isFake = !string.IsNullOrEmpty(fake);

		if(!isFake)
		{
			var fake_ = CheckHasPronounce(noun);
			if(fake_ != null)
			{
				fake   = orgNoun;
				noun   = fake_;
				isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(Regex.IsMatch(noun, @"\d$"))
			return ProcessForNumber(SahiplikHali, orgNoun);

		var lastLetter = noun.Substr(1);
		var last3      = noun.Substr(3);
		var nouns      = noun.Split(new[] {' '}, StringSplitOptions.RemoveEmptyEntries);
		var lastNoun   = nouns.Length > 0 ? nouns[^1] : "";

		if(isFake)
			orgNoun = fake;

		string blending = "";
		if(lastLetter.Length > 0 && IsVowel(lastLetter[0]))
			blending = "n";

		string suffix = "i";
		if(IsThinException(lastNoun))
		{
			suffix = "i";
		}
		else
		{
			char? lastVowel = GetLastVowel(last3);
			if(lastVowel.HasValue)
			{
				char v = ToTurkishLower(lastVowel.Value);
				if(v is 'ö' or 'ü')
					suffix = "ü";
				else if(v is 'a' or 'ı')
					suffix = "ı";
				else if(v is 'o' or 'u')
					suffix = "u";
			}
		}

		return FormatOutput(orgNoun, blending, suffix + "n");
	}

	public static string GenitiveCase(this string noun, string fake = "") => noun.SahiplikHali(fake);
	public static string Nin(this          string noun, string fake = "") => noun.SahiplikHali(fake);

#endregion


#region Vasıta Hali | Comitative Case

	/// <summary>
	/// Comitative Case
	/// </summary>
	/// <param name="noun"></param>
	/// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
	/// <returns>string</returns>
	public static string VasitaHali(this string noun, string fake = "")
	{
		var orgNoun = noun?.Trim() ?? "";
		noun = orgNoun.FilterAndTrim();
		bool isFake = !string.IsNullOrEmpty(fake);

		if(!isFake)
		{
			var fake_ = CheckHasPronounce(noun);
			if(fake_ != null)
			{
				fake   = orgNoun;
				noun   = fake_;
				isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(Regex.IsMatch(noun, @"\d$"))
			return ProcessForNumber(VasitaHali, orgNoun);

		var lastLetter = noun.Substr(1);
		var last3      = noun.Substr(3);
		var nouns      = noun.Split(new[] {' '}, StringSplitOptions.RemoveEmptyEntries);
		var lastNoun   = nouns.Length > 0 ? nouns[^1] : "";

		if(isFake)
			orgNoun = fake;

		string blending = "";
		if(lastLetter.Length > 0 && IsVowel(lastLetter[0]))
			blending = "y";

		string suffix = "e";
		if(!IsThinException(lastNoun))
		{
			char? lastVowel = GetLastVowel(last3);
			if(lastVowel.HasValue)
			{
				char v = ToTurkishLower(lastVowel.Value);
				if(v is 'a' or 'ı' or 'o' or 'u')
					suffix = "a";
			}
		}

		return FormatOutput(orgNoun, blending, "l" + suffix);
	}

	public static string ComitativeCase(this string noun, string fake = "") => noun.VasitaHali(fake);
	public static string Ile(this            string noun, string fake = "") => noun.VasitaHali(fake);

#endregion


#region Dahi Bağlacı | Conjunction

	/// <summary>
	/// Conjuction  (I'm not sure if this is the correct meaning of this)
	/// </summary>
	/// <param name="noun"></param>
	/// <param name="fake">(string if it's a fake noun): this is for pronounce usage</param>
	/// <returns>string</returns>
	public static string DahiBaglac(this string noun, string fake = "")
	{
		var orgNoun = noun?.Trim() ?? "";
		noun = orgNoun.FilterAndTrim();
		bool isFake = !string.IsNullOrEmpty(fake);

		if(!isFake)
		{
			var fake_ = CheckHasPronounce(noun);
			if(fake_ != null)
			{
				fake   = orgNoun;
				noun   = fake_;
				isFake = true;
			}
		}

		//  Check the ending if it's a number
		if(Regex.IsMatch(noun, @"\d$"))
			return ProcessForNumber(DahiBaglac, orgNoun);

		var last3    = noun.Substr(3);
		var nouns    = noun.Split(new[] {' '}, StringSplitOptions.RemoveEmptyEntries);
		var lastNoun = nouns.Length > 0 ? nouns[^1] : "";

		if(isFake)
			orgNoun = fake;

		string blending = "d";
		string suffix   = "e";

		if(!IsThinException(lastNoun))
		{
			char? lastVowel = GetLastVowel(last3);
			if(lastVowel.HasValue)
			{
				char v = ToTurkishLower(lastVowel.Value);
				if(v is 'a' or 'ı' or 'o' or 'u')
					suffix = "a";
			}
		}

		return orgNoun + " " + blending + suffix;
	}

	public static string Conjunction(this string noun, string fake = "") => noun.DahiBaglac(fake);
	public static string Dahi(this        string noun, string fake = "") => noun.DahiBaglac(fake);

#endregion


#region Sıra Sayı | Ordinal Number

	/// <summary>
	/// Ordinal Number
	/// </summary>
	/// <param name="number"></param>
	/// <param name="integer">if it's an integer, use "'", otherwise don't.</param>
	/// <returns>string</returns>
	public static string SiraSayi(this int number, string integer = "") => number.ToString().SiraSayi(integer);

	public static string Nci(this           int number, string integer = "") => number.ToString().Nci(integer);
	public static string OrdinalNumber(this int number, string integer = "") => number.ToString().OrdinalNumber(integer);

	/// <summary>
	/// Ordinal Number
	/// </summary>
	/// <param name="number"></param>
	/// <param name="integer">if it's an integer, use "'", otherwise don't.</param>
	///
	/// !Warning: Don't give integer when you directly call this method, because it'll override the number with your integer.
	/// This is mostly for internal use (see processForNumber())
	///
	/// <returns>string</returns>
	public static string SiraSayi(this string number, string integer = "")
	{
		number = number?.Trim() ?? "";
		bool isFake = !string.IsNullOrEmpty(integer);

		//  Check the ending if it's a number
		if(Regex.IsMatch(number, @"\d$"))
			return ProcessForNumber(SiraSayi, number);

		var lastLetter = number.Substr(1);
		var last3      = number.Substr(3);

		//  Check if the ending with "ört", if so make it "örd" (only for "dört")
		if(ToTurkishLower(last3) == "ört")
			number = number[..^1] + (lastLetter == "t" ? "d" : "D");

		if(isFake)
			number = integer;

		char?  lastVowel = GetLastVowel(last3);
		string suffix    = "i";

		if(lastVowel.HasValue)
		{
			char v = ToTurkishLower(lastVowel.Value);
			if(v is 'ö' or 'ü')
				suffix = "ü";
			else if(v is 'a' or 'ı')
				suffix = "ı";
			else if(v is 'o' or 'u')
				suffix = "u";
		}

		string blending = (lastLetter.Length > 0 && !IsVowel(lastLetter[0])) ? suffix : "";
		return number + (isFake ? "'" : "") + blending + "nc" + suffix;
	}

	public static string OrdinalNumber(this string number, string integer = "") => number.SiraSayi(integer);
	public static string Nci(this           string number, string integer = "") => number.SiraSayi(integer);

#endregion


#region Üleştirme | Distributive

	/// <summary>
	/// Distributive
	/// </summary>
	/// <param name="number"></param>
	/// <param name="integer">if it's an integer, use "'", otherwise don't.</param>
	/// <returns>string</returns>
	public static string Ulestirme(this int number, string integer = "") => number.ToString().Ulestirme(integer);

	public static string Er(this           int number, string integer = "") => number.ToString().Ulestirme(integer);
	public static string Distributive(this int number, string integer = "") => number.ToString().Ulestirme(integer);

	/// <summary>
	/// Distributive
	/// </summary>
	/// <param name="number"></param>
	/// <param name="integer">if it's an integer, use "'", otherwise don't.</param>
	///
	/// !Warning: Don't give integer when you directly call this method, because it'll override the number with your integer.
	/// This is mostly for internal use (see processForNumber())
	///
	/// <returns>string</returns>
	public static string Ulestirme(this string number, string integer = "")
	{
		number = number?.Trim() ?? "";
		bool isFake = !string.IsNullOrEmpty(integer);

		//  Check the ending if it's a number
		if(Regex.IsMatch(number, @"\d$"))
			return ProcessForNumber(Ulestirme, number);

		var lastLetter = number.Substr(1);
		var last3      = number.Substr(3);

		//  Check if the ending with "ört", if so make it "örd" (only for "dört")
		if(ToTurkishLower(last3) == "ört")
			number = number[..^1] + (lastLetter == "t" ? "d" : "D");

		if(isFake)
			number = integer;

		string blending  = "";
		char?  lastVowel = GetLastVowel(last3);
		string suffix    = "e";

		if(lastVowel.HasValue)
		{
			char v = ToTurkishLower(lastVowel.Value);
			if(v is 'a' or 'ı' or 'o' or 'u')
				suffix = "a";
		}

		if(lastLetter.Length > 0 && IsVowel(lastLetter[0]))
			blending = "ş";

		return number + (isFake ? "'" : "") + blending + suffix + "r";
	}

	public static string Distributive(this string number, string integer = "") => number.Ulestirme(integer);
	public static string Er(this           string number, string integer = "") => number.Ulestirme(integer);

#endregion


	/// <summary>
	/// This is for the numbers. It returns callback function with given number's pronounce
	/// </summary>
	/// <param name="callback"></param>
	/// <param name="noun"></param>
	/// <returns>string</returns>
	private static string ProcessForNumber(Func<string, string, string> callback, string noun)
	{
		var    filteredNoun    = noun.FilterAndTrim();
		var    lastNumberArray = Regex.Split(filteredNoun, @"\D+");
		string lastNumber      = "";

		for(int i = lastNumberArray.Length - 1; i >= 0; i--)
		{
			if(!string.IsNullOrEmpty(lastNumberArray[i]))
			{
				lastNumber = lastNumberArray[i];
				break;
			}
		}

		if(lastNumber == "0")
		{
			// it is directly zero
			return callback("fır", noun);
		}

		//  We don't need a full word, last 3 letters'd be enough
		var endings = new Dictionary<string, string>
					  {
						  {"1", "bir"},
						  {"2", "iki"},
						  {"3", "üç"},
						  {"4", "ört"},
						  {"5", "beş"},
						  {"6", "ltı"},
						  {"7", "edi"},
						  {"8", "kiz"},
						  {"9", "kuz"},
						  {"10", "on"},
						  {"20", "rmi"},
						  {"30", "tuz"},
						  {"40", "ırk"},
						  {"50", "lli"},
						  {"60", "mış"},
						  {"70", "miş"},
						  {"80", "sen"},
						  {"90", "san"}
					  };

		//  last number's length
		int digitLength = lastNumber.Length;

		//  Check last number
		string last1 = lastNumber.Substr(1);
		if(last1 != "0" && endings.TryGetValue(last1, out var ending))
			return callback(ending, noun);

		//  Check last two numbers
		string last2 = lastNumber.Substr(2);
		if(last2 != "00" && endings.TryGetValue(last2, out var ending1))
			return callback(ending1, noun);

		//  Check last three numbers
		string last3 = lastNumber.Substr(3);
		if(last3 != "000")
			return callback("yüz", noun);

		//  Check last four numbers
		string last4 = lastNumber.Substr(4);
		if(last4 != "0000" || digitLength < 7)
			return callback("bin", noun);

		//  Check for the rest
		// if this is 8, 11, 14, etc.
		if((digitLength + 1) % 3 == 0)
			return callback(digitLength % 2 == 0 ? "yon" : "yar", noun);

		if(digitLength % 3 == 0 || (digitLength + 2) % 3 == 0)
			return callback(digitLength % 2 == 0 ? "yar" : "yon", noun);

		return callback(noun, "");
	}
}