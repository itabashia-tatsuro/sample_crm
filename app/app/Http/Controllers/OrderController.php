<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Customer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->hasAny(['id', 'name', 'date1', 'date2'])) {
            $orders = Order::searchOrders($request->only(['id', 'customer_id']))
                            ->searchBetWeenDateOrders($request->only(['date1', 'date2']))
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
        } else {
            $orders = Order::getAllOrders();
        }
        
        return view('orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderData = Order::find($id);
        $customer = Customer::getCustomer($orderData->customer_id);

        return view('orderDetail', [
            'order' => $orderData,
            'customer' => $customer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
