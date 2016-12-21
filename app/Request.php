<?php

namespace App;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /**
     * Base URL
     *
     * @var string
     */
    public $baseUrl;

    /**
     * Timeout default to 10
     *
     * @var int
     */
    public $timeout;

    /**
     * Full API URL
     *
     * @var string
     */
    protected $apiURL = '/deskapi/v1.5/';

    /**
     * API User URL for Authentication
     *
     * @var string
     */
    protected $apiUser = 'user/login/acikgise_api';

    /**
     * API User Password
     *
     * @var string
     */
    protected $apiPassword = 'yTj3R>uJWwsf]Vb(';

    /**
     * API Key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Request constructor.
     * @param string $baseUrl
     * @param int $timeout
     */
    public function __construct($baseUrl, $timeout = 10)
    {
    	$this->baseUrl = $baseUrl;
    	$this->timeout = $timeout;

    	$this->checkAuthenticated();
    }

    /**
     * Checks if the session is expired
     */
    protected function checkAuthenticated()
    {
        $lastRequest = DB::table('requests')->orderBy('id', 'desc')->where('type', '=', 'auth')->first();

        if ($lastRequest == null) {
            $this->authenticate();
        } else {
            $lastRequestTime = Carbon::parse($lastRequest->created_at);

            if (Carbon::now('Europe/Istanbul')->subMinutes(20)->gt($lastRequestTime)) {
                $this->authenticate();
            } else {
                $this->apiKey = $lastRequest->key_used;
            }
        }
    }

    /**
     * Authenticates with the API User credantials
     */
    protected function authenticate()
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $url = $this->apiURL . $this->apiUser;

        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => $this->apiPassword
           ]
        ]);

        $decodedResponse = \GuzzleHttp\json_decode($response->getBody(), true);

        if ($response->getStatusCode() == 200) {
            DB::table('requests')->insert([
                'user_id' => Auth::id(),
                'key_used' => $decodedResponse['key'],
                'type' => 'auth',
                'created_at' => Carbon::now('Europe/Istanbul'),
                'updated_at' => Carbon::now('Europe/Istanbul')
            ]);

            $this->apiKey = $decodedResponse['key'];
        }
    }

    /**
     * Get the sales report for the given date range
     *
     * @param $to
     * @param bool $withItems
     */
    public function getSales($to, $withItems = false)
    {        
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $from = $this->getLatestRequestTime();

        $withItems ? $withItems = 'true' : $withItems = 'false';

        $url = $this->apiURL . 'sales?from=' . $from . '&to=' . $to . '&with_items=' . $withItems;

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->apiKey
           ]
        ]);

        DB::table('requests')->insert([
            'user_id' => Auth::id(),
            'key_used' => $this->apiKey,
            'type' => 'report',
            'created_at' => Carbon::now('Europe/Istanbul'),
            'updated_at' => Carbon::now('Europe/Istanbul')
        ]);

        Sales::saveNewSales($response->getBody());
        Item::saveItems($response->getBody());
    }

    public function getBookings($from, $to)
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $url = $this->apiURL . 'bookings?from=' . $from . '&to=' . $to . '&with_items=true';

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->apiKey
            ]
        ]);

        DB::table('requests')->insert([
            'user_id' => Auth::id(),
            'key_used' => $this->apiKey,
            'type' => 'booking',
            'created_at' => Carbon::now('Europe/Istanbul'),
            'updated_at' => Carbon::now('Europe/Istanbul')
        ]);
 
        Booking::saveNewBookings($response->getBody());
        BookingItem::saveItems($response->getBody());
    }

    public function getCustomers($to, $rows = '3000')
    {
        $from = '2016-12-05T00:00';

        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $url = $this->apiURL . 'customers?registered_from=' . $from . '&registered_to=' . $to . '&rowsPerPage=' . $rows;

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->apiKey
            ]
        ]);

        Customer::saveCustomers($response->getBody());
    }

    protected function getLatestRequestTime()
    {
        $latest = DB::table('requests')->orderBy('created_at', 'desc')->where('type', '=', 'report')->first();

        if ($latest) {
            $latestRequest = $this->convertTime($latest->updated_at);
        } else {
            $latestRequest = '2016-12-07T00:00';
        }

        return $latestRequest;
    }

    protected function convertTime($time)
    {
        $newTime = str_replace(' ', 'T', $time);

        $realTime = substr($newTime, 0, -3);

        return $realTime;
    }
}
