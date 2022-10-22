@extends('layouts.app')

@section('content')
<div class="container mx-auto">

  <div class="d-grid gap-2 d-md-block mb-5">
    <a class="btn btn-success" href="{{route('orders.edit', ['order' => $order->id ])}}" role="button">編集</a>
    <a class="btn btn-outline-dark" href="{{route('orders.index')}}" role="button">戻る</a>
  </div>

<div class="row justify-content-around">
  <div class="col-md-8">
    <table class="table table-hover">
      <tbody>
        <tr>
          <th scope="col" class="vw-50 bg-primary text-center">商品番号</th>
          <td class="w-70">{{ $order->id }}</td>
        </tr>
        <tr>
          <th scope="col" class="vw-50 bg-primary text-center">商品名</th>
          <td class="w-70">{{ $order->items[0]->name }}</td>
        </tr>
        <tr>
          <th scope="col" class="vw-50 bg-primary text-center">注文個数</th>
          <td class="w-70">{{ $order->quantity }}</td>
        </tr>
        <tr>
          <th scope="col" class="vw-50 bg-primary text-center">合計価格</th>
          <td class="w-70">{{ $order->price }}</td>
        </tr>
        <tr>
          <th scope="col" class="vw-50 bg-primary text-center">注文状況</th>
          <td class="w-70">{{ $order->status }}</td>
        </tr>
        <tr>
          <th scope="col" class="vw-50 bg-primary text-center">備考</th>
          <td class="w-70">{{ $order->memo }}</td>
        </tr>
        <tr>
          <th scope="col" class="vw-50 bg-primary text-center">購入日</th>
          <td class="w-70">{{ $order->created_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="col-md-8">
    <table class="table table-hover">
      <tbody>
        <tr>
          <th scope="col" class="mp-3 vw-50 bg-primary  text-center">id</th>
          <td class="mp-3">{{ $customer->id }}</td>
        </tr>
        <tr>
          <th scope="col" class="mp-3 vw-50 bg-primary  text-center">氏名</th>
          <td class="mp-3">{{ $customer->name }}</td>
        </tr>
        <tr>
          
        </tr>
        <tr>
          <th scope="col" class="mp-3 vw-50 bg-primary  text-center">メールアドレス</th>
          <td class="mp-3">{{ $customer->email }}</td>
        </tr>
        <tr>
          <th scope="col" class="mp-3 vw-50 bg-primary  text-center">電話</th>
          <td class="mp-3">{{ $customer->tel }}</td>
        </tr>
        <tr>
          <th scope="col" class="mp-3 vw-50 bg-primary  text-center">住所</th>
          <td class="mp-3">{{ $customer->address }}</td>
        </tr>
        <tr>
          <th scope="col" class="mp-3 vw-50 bg-primary  text-center">誕生日</th>
          <td class="mp-3">{{ $customer->birthday }}</td>
        </tr>
        <tr>
          <th scope="col" class="mp-3 vw-50 bg-primary  text-center">性別</th>
          @if($customer->gender == 0)
          <td class="mp-3">男</td>
          @elseif($customer->gender == 1)
          <td class="mp-3">女</td>
          @else
          <td class="mp-3">その他</td>
          @endif
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection