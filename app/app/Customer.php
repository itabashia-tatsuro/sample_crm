<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Order;

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
            unset($input['page']);
            foreach ($input as $key => $value) {
                if(empty($value)) {
                    continue;
                }
                $query->where($key, 'like', '%'.$value.'%');
            }
            return $query;
        }
    }

    // リレーション
    public function order()
    {
        return $this->hasMany(Order::class);
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

    public static function getCustomerCount()
    {
        $customerTotalCount = Customer::count();
        $customerCount = Customer::selectRaw('count(gender) as gender')
                                    ->groupBy('gender') // 性別ごとにまとめる
                                    ->get();
        $data = [
            'total' => $customerTotalCount,
            'men'   => $customerCount[0]->gender,
            'women' => $customerCount[1]->gender,
            'other' => $customerCount[2]->gender,
        ];

        return $data;
    }
}
