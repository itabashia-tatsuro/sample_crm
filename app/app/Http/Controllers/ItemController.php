<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty($request)) {
            $items = Item::searchItems($request->all())
                                ->select('id', 'name', 'price', 'is_selling')
                                ->paginate(20);
        } else {
            $items = Item::getAllItems();  // Itemモデルのメソッド呼び出し
        }

        return view('items', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createItem');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'price' => 'required|integer|between:500,10000',
            'memo' => 'nullable'
        ]);

        Item::createNewItem($request->all());

        return redirect()->action('ItemController@index')->with('status', '新商品の登録が完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::getItem($id);
        return view('itemDetail', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($itemId)
    {
        $item = Item::getItem($itemId);
        return view('editItem', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'price' => 'required|integer|between:500,10000',
            'memo' => 'nullable',
            'is_selling' => 'required',
        ]);

        Item::updateItem($request->all(), $id);
        return redirect()->action('ItemController@index')->with('status', '商品の編集が完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($itemId)
    {

    }
}
