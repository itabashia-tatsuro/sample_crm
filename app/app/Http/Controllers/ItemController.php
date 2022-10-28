<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

// ライブラリを読み込む
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Carbon;

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

    public function export(){
        // $items = Item::all();

        // Spreadsheetのインスタンスを生成
        $spreadSheet = new Spreadsheet;

        // データの出力にはsetCellValue
        // 2行目にヘッドをつける
        $spreadSheet->getActiveSheet()->setCellValue('B2', 'ID');
        $spreadSheet->getActiveSheet()->setCellValue('C2', '商品名');
        $spreadSheet->getActiveSheet()->setCellValue('D2', '単価');
        $spreadSheet->getActiveSheet()->setCellValue('E2', '販売状態');
        $spreadSheet->getActiveSheet()->setCellValue('F2', '備考');
        $spreadSheet->getActiveSheet()->setCellValue('G2', '登録日時');
        $spreadSheet->getActiveSheet()->setCellValue('H2', '更新日時');

        // 3行目から記入していく
        // レコード数が多くてメモリ不足の心配がある場合はチャンクに分けて処理するこ
        // 「&$」はリファレンス渡し（参照渡し）・・・ループを回すたびに$iが初期化されるのを防ぐ
        $i = 3;
        Item::chunk(100, function ($items) use ($spreadSheet, &$i) {
            foreach ($items as $item) {
                $spreadSheet->getActiveSheet()->setCellValue('B' . $i, $item->id);
                $spreadSheet->getActiveSheet()->setCellValue('C' . $i, $item->name);
                $spreadSheet->getActiveSheet()->setCellValue('D' . $i, $item->price);
                $spreadSheet->getActiveSheet()->setCellValue('E' . $i, $item->is_selling);
                $spreadSheet->getActiveSheet()->setCellValue('F' . $i, $item->memo);
                $spreadSheet->getActiveSheet()->setCellValue('G' . $i, $item->created_at);
                $spreadSheet->getActiveSheet()->setCellValue('H' . $i, $item->updated_at);
                $i++;
            }
        });

        // Excelファイルを出力する
        $fileName = '商品リスト' . Carbon::now()->format('Y_m_d') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;');
        header("Content-Disposition: attachment; filename=\"{$fileName}\""); header('Cache-Control: max-age=0');
        
        $writer = IOFactory::createWriter($spreadSheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
