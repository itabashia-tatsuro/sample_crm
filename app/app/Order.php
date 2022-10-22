<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Customer;
use Carbon\Carbon;

class Order extends Model
{
    protected  $fillable = [
        'customer_id',
        'quantity',
        'price',
        'memo'
    ];

    /**
     * 注文を検索するクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeSearchOrders($query, $input)
    {
        if (!empty($input)) {

            // 商品名
            if (!empty($input['id'])){
                $query->where('id', '=', $input['id']);
            }

            // 販売状態
            if (!empty($input['customer_id'])){
                $query->where('customer_id', '=', $input['customer_id']);
            }
            return $query;
        }
    }

    /**
     * 注文を検索するクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeSearchBetweenDateOrders($query, $input)
    {
        if (!empty($input)) {
            $date1 = $input['date1'];
            $date2 = $input['date2'];
            
            if (!empty($data1) && !empty($date2)) {
                $date1 = (new Carbon($date1))->format('Y-m-d 23:59:59');
                $date2 = (new Carbon($date2))->format('Y-m-d 23:59:59');
                $query->whereBetween('created_at', [$date1, $date2]);
            } else {
                if(!empty($date1)) {
                    $date1 = (new Carbon($date1))->format('Y-m-d 23:59:59');
                    $query->where('created_at', '>=', $date1);
                }
                
                if(!empty($date2)) {
                    $date2 = (new Carbon($date2))->format('Y-m-d 23:59:59');
                    $query->where('created_at', '<=', $date2);
                }
            }
            
            return $query;
        }
    }

    // リレーション
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // リレーション
    public function items()
    {
        // belongsToMany('関係するモデル', '中間テーブルのテーブル名', '中間テーブル内で対応しているID名', '関係するモデルで対応しているID名');
        return $this->belongsToMany('App\Item', 'item_order', 'order_id', 'item_id');
    }

    public static function getAllOrders()
    {
        $allOrders = DB::table('orders')
                    ->select(
                        'id',
                        'customer_id',
                        'quantity',
                        'price',
                        'status',
                        'created_at'
                    )
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);
        return $allOrders;
    }
}
