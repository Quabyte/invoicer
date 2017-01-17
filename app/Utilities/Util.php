<?php

namespace App\Utilities;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Util
{	

	public static $eurRate;

	/**
	 * Decodes the json object
	 * 
	 * @param  json  $jsonObject
	 * @param  boolean $toArray
	 * @return array
	 */
	public static function decodeJson($jsonObject, $toArray = true)
	{
		$json = json_decode($jsonObject, $toArray);

		return $json;
	}

	/**
	 * Converts EUR to TL based on the current ratio from TCMB
	 * 
	 * @param  decimal $amount
	 * @return decimal
	 */
	public static function convertEurToTl($amount)
	{
		$xml = simplexml_load_file('http://www.tcmb.gov.tr/kurlar/today.xml');

		foreach ($xml->Currency as $currency) {

		    if ($currency['Kod'] == "EUR") {
		        $eur_DS = $currency->BanknoteSelling;
		        static::$eurRate = $currency->BanknoteBuying;
		    }
		}

		return $amount * static::$eurRate;
	}

	/**
	 * Returns the latest request time based on request type
	 * 
	 * @param  string $type Request type
	 * @return string
	 */
	public static function getLatestRequestTime($type)
	{
		$latest = DB::table('requests')->orderBy('created_at', 'desc')->where('type', '=', $type)->first();

		$latestRequest = static::convertTime($latest->created_at);

		return $latestRequest;
	}

	public static function getNowTime()
	{
		$now = Carbon::now('Europe/Istanbul');

		$converted = static::convertTime($now);

		return $converted;
	}

	/**
	 * Converts datetime to api compatible string
	 * 
	 * @param  dateTime $time
	 * @return string
	 */
	public static function convertTime($time)
	{
		$newTime = str_replace(' ', 'T', $time);

		$converted = substr($newTime, 0, -3);

		return $converted;
	}
}