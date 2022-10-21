@extends('layouts.app')

@section('content')
<div class="container mx-auto">
  @if(empty($customers[0]))
    <div class="alert alert-success">
      検索にヒットしませんでした。もう一度検索してください
    </div>
  @else
    <div class="alert alert-success">
      条件にヒットしました。
    </div>
  @endif
  
  <form class="row g-3" action="{{ route('search.customers') }}" method="post">
    @csrf
    <div class="col-md-6">
      <label for="name" class="form-label">氏名</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="顧客氏名を入力してください">
    </div>
    <div class="col-md-6">
      <label for="tel" class="form-label">電話番号</label>
      <input type="number" class="form-control" id="tel" name="tel" placeholder="電話番号を入力してください">
    </div>
    <div class="col-12">
      <label for="address" class="form-label">住所</label>
      <input type="text" class="form-control" id="address" placeholder="東京都" name="address">
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">検索</button>
    </div>
  </form>
  
  <table class="table table-hover">
    <thead>
      <tr class="table-info">
        <th scope="col" class="mx-5 text-center">id</th>
        <th scope="col" class="mx-5 text-center">氏名</th>
        <th scope="col" class="mx-5 text-center">電話</th>
        <th scope="col" class="mx-5 text-center">住所</th>
        <th scope="col" class="mx-5 text-center">詳細ページリンク</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($customers as $customer)
      <tr>
        <td class="mx-5">{{ $customer->id }}</td>
        <td class="mx-5">{{ $customer->name }}</td>
        <td class="mx-5">{{ $customer->tel }}</td>
        <td class="mx-5">{{ $customer->address }}</td>
        <td class="mx-5"><a href="{{route('customer.detail', ['customer'=> $customer->id ])}}">#</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
  {{ $customers->links() }}
</div>
@endsection