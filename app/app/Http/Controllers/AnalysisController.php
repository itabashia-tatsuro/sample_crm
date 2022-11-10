<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class AnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('analysis');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function analysis(Request $request)
    {
        if ($request->method('get')) {
            
            $startDate = $request->startDate ?? null;
            $endDate = $request->endDate ?? null;
            
            $orders = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
                            ->betweenDate($startDate, $endDate) // 期間絞り込み
                            ->groupBy('orders.id')
                            ->selectRaw('
                                orders.id,
                                orders.price,
                                customers.name,
                                orders.quantity,
                                orders.status,
                                orders.created_at
                            ')
                            ->orderBy('orders.created_at')
                            ->paginate(50);
        } else {
            $orders = null;
        }

        // Ajax通信
        return response()->json(['orders' => $orders]); 
    }
}
