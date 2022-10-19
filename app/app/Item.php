<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    protected $fillable = [ 
        'name', 
        'memo', 
        'price', 
        'is_selling' 
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

    public static function getItem($id) {
        $item = Item::find($id);
        return $item;
    }
}
