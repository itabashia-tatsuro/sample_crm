<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 顧客の人数
        $file = "../public/getCustomerCount.json";
        $data = file_get_contents($file);
        $customerCount = json_decode($data, true);

        return view('home', [
            'perCustomerCount' => $customerCount
        ]);
    }
}
