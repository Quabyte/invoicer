<?php

namespace App;

use App\Customer;
use Carbon\Carbon;
use App\Utilities\Util;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{	
	/**
	 * Mass assignable fields
	 * 
	 * @var array
	 */
    protected $fillable = [
    	'customerId',
    	'first_name',
    	'second_name',
    	'birth_date',
    	'gender',
    	'address',
    	'zip_code',
    	'city',
    	'province',
    	'country',
    	'telephone',
    	'email'
    ];

    /**
     * Returns the related sales
     * 
     * @return collection
     */
    public function sales()
    {
    	return $this->hasMany('App/Sales');
    }

    /**
     * Saves the new customers
     *
     * @param $jsonObject
     * @return bool
     */
    public static function saveCustomers($jsonObject)
    {
        $json = Util::decodeJson($jsonObject);

    	for ($i=0; $i <= sizeof($json['customers']) - 1; $i++) {
            if (Customer::where('id', '=', $json['customers'][$i]['id'])->count() > 0) {
                return true;
            } else {
                $customer = new Customer;
                $customer->id = $json['customers'][$i]['id'];
                $customer->first_name = $json['customers'][$i]['first_name'];
                $customer->second_name = $json['customers'][$i]['surname_1st'] . ' ' . $json['customers'][$i]['surname_2nd'];
                $customer->birth_date = $json['customers'][$i]['birth_date'];
                $customer->gender = $json['customers'][$i]['gender'];
                $customer->address = $json['customers'][$i]['postal_address']['street'];
                $customer->zip_code = $json['customers'][$i]['postal_address']['zip_code'];
                $customer->city = $json['customers'][$i]['postal_address']['city'];
                $customer->province = $json['customers'][$i]['postal_address']['province'];
                $customer->country = $json['customers'][$i]['postal_address']['country'];
                $customer->telephone = $json['customers'][$i]['mobile'];
                $customer->email = $json['customers'][$i]['email'];
                $customer->save();
            }
    	}
    }

    public static function getTCKimlik($jsonObject, $customerID)
    {
        $json = Util::decodeJson($jsonObject);

        $customer = Customer::where('id', '=', $customerID)->first();

        if (isset($json['customers'][0]['custom_fields']['value'])) {
            $customer->tc_kimlik = $json['customers'][0]['custom_fields']['value'];
            $customer->save();
        } else {
            $customer->tc_kimlik = 'Not Set';
            $customer->save();
        }
    }

    public static function getCustomer($customerID)
    {
        $customer = Customer::where('id', '=', $customerID)->first();

        return $customer;
    }

    public static function customerName($customerID)
    {
        $customer = Customer::where('id', '=', $customerID)->first();

        return $customer->first_name . ' ' . $customer->second_name;
    }

    public static function customerAddress($customerID)
    {
        $customer = Customer::where('id', '=', $customerID)->first();

        return $customer->address;
    }

    public static function updateCustomer($jsonObject, $customerID)
    {
        $json = Util::decodeJson($jsonObject);

        for ($i=0; $i <= sizeof($json['customers']) - 1; $i++) {
            $customer = Customer::where('id', '=', $customerID)->first();
            $customer->first_name = $json['customers'][$i]['first_name'];
            $customer->second_name = $json['customers'][$i]['surname_1st'] . ' ' . $json['customers'][$i]['surname_2nd'];
            $customer->birth_date = $json['customers'][$i]['birth_date'];
            $customer->gender = $json['customers'][$i]['gender'];
            $customer->address = $json['customers'][$i]['postal_address']['street'];
            $customer->zip_code = $json['customers'][$i]['postal_address']['zip_code'];
            $customer->city = $json['customers'][$i]['postal_address']['city'];
            $customer->province = $json['customers'][$i]['postal_address']['province'];
            $customer->country = $json['customers'][$i]['postal_address']['country'];
            $customer->telephone = $json['customers'][$i]['mobile'];
            $customer->email = $json['customers'][$i]['email'];
            $customer->save();
        }
    }
}
