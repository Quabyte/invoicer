<?php

namespace App;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Utilities\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
     * 
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

        } elseif ($lastRequest->created_at > Carbon::now('Europe/Istanbul')->subMinutes(20)) {
            $this->apiKey = $lastRequest->key_used;
            
        } else {
            $this->authenticate();
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

        $decodedResponse = Util::decodeJson($response->getBody());

        if ($response->getStatusCode() == 200) {
            $this->saveRequestTime($decodedResponse['key'], 'auth');
            $this->apiKey = $decodedResponse['key'];
        }
    }

    /**
     * Get the sales report for the given date range
     *
     * @param $to
     * @param bool $withItems
     */
    public function getSales($withItems = true)
    {        
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $from = Util::getLatestRequestTime('report');
        $to = Util::getNowTime();

        $withItems ? $withItems = 'true' : $withItems = 'false';

        $url = $this->apiURL . 'sales?from=' . $from . '&to=' . $to . '&with_items=' . $withItems;

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->apiKey
           ]
        ]);

        $this->saveRequestTime($this->apiKey, 'report');
        
        Item::saveItems($response->getBody());
    }

    public function getSalesOnParticularDates($from, $to)
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $url = $this->apiURL . 'sales?from=' . $from . '&to=' . $to . '&with_items=true';

        $response = $client->request('GET', $url, [
           'headers' => [
               'Authorization' => $this->apiKey
           ]
        ]);

        Sales::saveNewSales($response->getBody());
        Item::saveItems($response->getBody());
    }

    public function getDeskSales()
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $url = $this->apiURL . 'sales?from=2016-12-07T00:00&to=2017-02-04T10:00&channel=DESK&with_items=true';

        $response = $client->request('GET', $url, [
           'headers' => [
               'Authorization' => $this->apiKey
           ]
        ]);

        $this->saveRequestTime($this->apiKey, 'desk');

        Sales::saveNewSales($response->getBody());
        Item::saveItems($response->getBody());
    }

    /**
     * Gets the latest bookings.
     */
    public function getBookings()
    {

        $from = Util::getLatestRequestTime('booking');
        $to = Util::getNowTime();

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

        $this->saveRequestTime($this->apiKey, 'booking');
 
        Booking::saveNewBookings($response->getBody());
        BookingItem::saveItems($response->getBody());
    }

    /**
     * Gets the customers list
     * 
     * @param  string $to
     * @param  string $rows
     */
    public function getCustomers($rows = '3000')
    {

        $from = Util::getLatestRequestTime('customers');
        $to = Util::getNowTime();

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

        $this->saveRequestTime($this->apiKey, 'customers');

        Customer::saveCustomers($response->getBody());
    }

    public function getTCKimlik($customerID)
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $url = $this->apiURL . 'customer/' . $customerID;

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->apiKey
            ]
        ]);

        Customer::getTCKimlik($response->getBody(), $customerID);
    }

    public function getSingleCustomer($customerID)
    {
        
        if (Customer::where('id', '=', $customerID)->count() > 0) {
            return true;
        }

        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $url = $this->apiURL . 'customer/' . $customerID;

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->apiKey
            ]
        ]);

        Customer::saveCustomers($response->getBody());
    }

    protected function saveRequestTime($apiKey, $type)
    {
        DB::table('requests')->insert([
            'user_id' => Auth::id(),
            'key_used' => $apiKey,
            'type' => $type,
            'created_at' => Carbon::now('Europe/Istanbul'),
            'updated_at' => Carbon::now('Europe/Istanbul')
        ]);
    }

    public function updateCustomer($customerID)
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $url = $this->apiURL . 'customer/' . $customerID;

        $response = $client->request('GET', $url, [
           'headers' => [
               'Authorization' => $this->apiKey
           ]
        ]);

        Customer::updateCustomer($response->getBody(), $customerID);
    }

    public function updateBooking($bookingRef)
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $url = $this->apiURL . 'booking/' . $bookingRef;

        $response = $client->request('GET', $url, [
           'headers' => [
               'Authorization' => $this->apiKey
           ]
        ]);

        Booking::updateBooking($response->getBody(), $bookingRef);
        BookingItem::saveItemsForOneBooking($response->getBody(), $bookingRef);
    }

    public function getSingleSale($saleID)
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout
        ]);

        $url = $this->apiURL . 'sale/' . $saleID;

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->apiKey
            ]
        ]);

        Sales::saveNewSales($response->getBody());
        Item::saveItems($response->getBody());
    }
}
