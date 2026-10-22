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
using UnityEngine.Localization;
using UnityEngine.Localization.SmartFormat.Core.Extensions;

[DisplayName("Türkçe Yönelme Hali")]
[Serializable]
public class YonelmeHaliFormatter : FormatterBase
{
	public override string[] DefaultNames => new[] {"yonel", "ye"};

	public override bool TryEvaluateFormat(IFormattingInfo formattingInfo)
	{
		if(formattingInfo.CurrentValue is not {} noun)
			return false;

		formattingInfo.Write(noun.ToString().YonelmeHali());
		return true;
	}
}

[DisplayName("Türkçe Belirtme Hali")]
[Serializable]
public class BelirtmeHaliFormatter : FormatterBase
{
	public override string[] DefaultNames => new[] {"belirt", "yi"};

	public override bool TryEvaluateFormat(IFormattingInfo formattingInfo)
	{
		if(formattingInfo.CurrentValue is not {} noun)
			return false;

		formattingInfo.Write(noun.ToString().BelirtmeHali());
		return true;
	}
}

[DisplayName("Türkçe Bulunma Hali")]
[Serializable]
public class BulunmaHaliFormatter : FormatterBase
{
	public override string[] DefaultNames => new[] {"bulun", "de"};

	public override bool TryEvaluateFormat(IFormattingInfo formattingInfo)
	{
		if(formattingInfo.CurrentValue is not {} noun)
			return false;

		formattingInfo.Write(noun.ToString().BulunmaHali());
		return true;
	}
}

[DisplayName("Türkçe Ayrılma Hali")]
[Serializable]
public class AyrilmaHaliFormatter : FormatterBase
{
	public override string[] DefaultNames => new[] {"ayril", "den"};

	public override bool TryEvaluateFormat(IFormattingInfo formattingInfo)
	{
		if(formattingInfo.CurrentValue is not {} noun)
			return false;

		formattingInfo.Write(noun.ToString().AyrilmaHali());
		return true;
	}
}

[DisplayName("Türkçe Sahiplik Hali")]
[Serializable]
public class SahiplikHaliFormatter : FormatterBase
{
	public override string[] DefaultNames => new[] {"sahip", "nin"};

	public override bool TryEvaluateFormat(IFormattingInfo formattingInfo)
	{
		if(formattingInfo.CurrentValue is not {} noun)
			return false;

		formattingInfo.Write(noun.ToString().SahiplikHali());
		return true;
	}
}

[DisplayName("Türkçe Vasıta Hali")]
[Serializable]
public class VasitaHaliFormatter : FormatterBase
{
	public override string[] DefaultNames => new[] {"vasita", "ile"};

	public override bool TryEvaluateFormat(IFormattingInfo formattingInfo)
	{
		if(formattingInfo.CurrentValue is not {} noun)
			return false;

		formattingInfo.Write(noun.ToString().VasitaHali());
		return true;
	}
}

[DisplayName("Türkçe Dahi Bağlacı")]
[Serializable]
public class DahiBaglacFormatter : FormatterBase
{
	public override string[] DefaultNames => new[] {"dahi"};

	public override bool TryEvaluateFormat(IFormattingInfo formattingInfo)
	{
		if(formattingInfo.CurrentValue is not {} noun)
			return false;

		formattingInfo.Write(noun.ToString().DahiBaglac());
		return true;
	}
}

[DisplayName("Türkçe Sıra Sayı")]
[Serializable]
public class SiraSayiFormatter : FormatterBase
{
	public override string[] DefaultNames => new[] {"sira", "nci"};

	public override bool TryEvaluateFormat(IFormattingInfo formattingInfo)
	{
		if(formattingInfo.CurrentValue is not {} noun)
			return false;

		formattingInfo.Write(noun.ToString().SiraSayi());
		return true;
	}
}

[DisplayName("Türkçe Üleştirme")]
[Serializable]
public class UlestirmeFormatter : FormatterBase
{
	public override string[] DefaultNames => new[] {"ulestir", "er"};

	public override bool TryEvaluateFormat(IFormattingInfo formattingInfo)
	{
		if(formattingInfo.CurrentValue is not {} noun)
			return false;

		formattingInfo.Write(noun.ToString().Ulestirme());
		return true;
	}
}