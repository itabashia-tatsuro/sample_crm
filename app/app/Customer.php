<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    public static function getAllCustomers()
    {
        $allCustomers = DB::table('customers')->paginate(20);
        return $allCustomers;
    }

    public static function getCustomer($id) {
        $customer = Customer::find($id);
        return $customer;
    }
}
