<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [ 
        'name', 
        'memo', 
        'price', 
        'is_selling',
    ];

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
