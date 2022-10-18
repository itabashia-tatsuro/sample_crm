@extends('layouts.app')

@section('content')
<div class="container mx-auto">

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