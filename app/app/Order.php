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
                $query->where('orders.id', '=', $input['id']);
            }

            // 販売状態
            if (!empty($input['customer_id'])){
                $query->where('orders.customer_id', '=', $input['customer_id']);
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
        if(!empty($input['date1'])) $date1 = $input['date1'];
        if(!empty($input['date2'])) $date1 = $input['date2'];

        if (!empty($data1) && !empty($date2)) {
            $date1 = (new Carbon($date1))->format('Y-m-d 23:59:59');
            $date2 = (new Carbon($date2))->format('Y-m-d 23:59:59');
            $query->whereBetween('orders.created_at', [$date1, $date2]);
        } else {
            if(!empty($date1)) {
                $date1 = (new Carbon($date1))->format('Y-m-d 23:59:59');
                $query->where('orders.created_at', '>=', $date1);
            }
            
            if(!empty($date2)) {
                $date2 = (new Carbon($date2))->format('Y-m-d 23:59:59');
                $query->where('orders.created_at', '<=', $date2);
            }
        }
        
        return $query;
    }

    /**
    * 期間を指定するクエリスコープ
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeBetweenDate($query, $startDate = null, $endDate = null)
    {
        if(is_null($startDate) && is_null($endDate)) {
            return $query;
        }
        if(!is_null($startDate) && is_null($endDate)) {
            return $query->where('orders.created_at', ">=", $startDate);
        }

        // endDateについて
        // 日付を指定すると 2022-MM-DD 00:00:00 になってしまう
        // 例 10月31日⇒「2022-10-31 00:00:00」
        if(is_null($startDate) && !is_null($endDate)) {
            $endDate = Carbon::parse($endDate)->addDays(1);
            return $query->where('orders.created_at', '<=', $endDate);
        }
        if(!is_null($startDate) && !is_null($endDate)) {
            $endDate = Carbon::parse($endDate)->addDays(1); 
            return $query->where('orders.created_at', ">=", $startDate)
                        ->where('orders.created_at', '<=', $endDate);
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
        // SQLクエリ
        // SELECT orders.id, SUM(items.price) as price FROM orders JOIN item_order as io ON orders.id = io.order_id JOIN items ON items.id = io.item_id GROUP BY io.order_id;
        $allOrders = DB::table('orders')
                        ->join('item_order as io', 'orders.id', '=', 'io.order_id')
                        ->join('items', 'items.id', '=', 'io.item_id')
                        ->select(
                            'orders.id',
                            'orders.customer_id',
                            'orders.quantity',
                            DB::raw('SUM(items.price) as total'),
                            'orders.status',
                            'orders.created_at'
                        )
                        ->groupBy('io.order_id')
                        ->orderBy('orders.created_at', 'desc')
                        ->paginate(20);
        return $allOrders;
    }
}
