@extends('layouts.app')

@section('content')

<div class="container mx-auto">
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  
  <div class="d-grid gap-2 d-md-block mb-3">
    <a class="btn btn-primary" href="{{route('orders.create')}}" role="button">商品登録</a>
  </div>

  @if(empty($orders[0]))
    <div class="alert alert-success mt-3">
      検索にヒットしませんでした。もう一度検索してください
    </div>
  @endif
  
  <form class="row g-3 mb-3" action="{{ route('search.orders') }}" method="get">

    <input type="hidden" name="search" value="search"> <!-- ページネーション 2ページ目以降の対策 -->
    
    <div class="col-md-6">
      <label for="id" class="form-label">商品番号</label>
      <input type="number" class="form-control" id="id" name="id" placeholder="商品番号を入力してください">
    </div>
    <div class="col-md-6">
      <label for="customer_id" class="form-label">顧客番号</label>
      <input type="number" class="form-control" id="customer_id" name="customer_id" placeholder="顧客番号を入力してください">
    </div>
    <div class="col-md-6">
      <label for="date1" class="form-label">始まり</label>
      <input type="date" class="form-control" id="date" name="date1">
    </div>
    <div class="col-md-6">
      <label for="date2" class="form-label">終わり</label>
      <input type="date" class="form-control" id="date" name="date2">
    </div>
      
    <div class="col-12 mt-3">
      <button type="submit" class="btn btn-primary">検索</button>
    </div>
  </form>

  <table class="table table-hover">
    <thead>
      <tr class="table-info">
        <th scope="col" class="mx-5 text-center">id</th>
        <th scope="col" class="mx-5 text-center">顧客番号</th>
        <th scope="col" class="mx-5 text-center">個数</th>
        <th scope="col" class="mx-5 text-center">価格</th>
        <th scope="col" class="mx-5 text-center">状況</th>
        <th scope="col" class="mx-5 text-center">購入日時</th>
        <th scope="col" class="mx-5 text-center">詳細ページリンク</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
      <tr>
        <td class="mx-5 text-center">{{ $order->id }}</td>
        <td class="mx-5 text-center"><a href="{{route('customer.detail', ['customer'=> $order->customer_id ])}}">{{ $order->customer_id }}</a></td>
        <td class="mx-5 text-center">{{ $order->quantity }}</td>
        <td class="mx-5 text-center">{{ $order->total }}</td>
        <td class="mx-5 text-center">{{ $order->status }}</td>
        <td class="mx-5 text-center">{{ $order->created_at }}</td>
        <td class="mx-5 text-center"><a href="{{route('orders.show', ['order'=> $order->id ])}}">#</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
  {{ $orders->appends(request()->input())->links() }}
</div>
@endsection