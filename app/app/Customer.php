<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    /**
     * 顧客を検索するクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeSearchCustomers($query, $input)
    {
        // $input = 検索フォームに入力された値
        if (!empty($input)) {
            unset($input['_token']);
            foreach ($input as $key => $value) {
                if(empty($value)) {
                    continue;
                }
                $query->where($key, 'like', '%'.$value.'%');
            }
            return $query;
        }
    }

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
