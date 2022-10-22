<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    // use SoftDeletes;
    
    // protected $dates = ['deleted_at'];

    protected $fillable = [ 
        'name', 
        'memo', 
        'price', 
        'is_selling',
    ];

    /**
     * 商品を検索するクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeSearchItems($query, $input)
    {
        // $input = 検索フォームに入力された値
        if (!empty($input)) {
            unset($input['_token']);

            // 商品名
            if (!empty($input['name'])){
                $query->where('name', 'like', '%'.$input['name'].'%');
            }

            // 販売状態
            if (!empty($input['is_selling'])){
                $query->where('is_selling', 'like', $input['is_selling']);
            }
            
            return $query;
        }
    }

    // リレーション
    public function orders()
    {
        // belongsToMany('関係するモデル', '中間テーブルのテーブル名', '中間テーブル内で対応しているID名', '関係するモデルで対応しているID名');
        return $this->belongsToMany('App\Order', 'item_order', 'item_id', 'order_id');
    }

    public static function getAllItems()
    {
        $allItems = DB::table('items')
                    ->select(
                        'id',
                        'name',
                        'price',
                        'is_selling'
                    )
                    ->paginate(20);
        return $allItems;
    }

    public static function getItem($id)
    {
        $item = Item::find($id);
        return $item;
    }

    public static function createNewItem($data)
    {
        try {
            Item::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'memo' => $data['memo'],
            ]);
        } catch (\Exception $e) {
            report($e);
        }
    }

    public static function updateItem($data, $id)
    {
        try {
            Item::where('id', $id)
                ->update([
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'memo' => $data['memo'],
                    'is_selling' => $data['is_selling'],
                ]);
        } catch (\Exception $e) {
            report($e);
        }
    }
}
