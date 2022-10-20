@extends('layouts.app')

@section('content')
<div class="container mx-auto">

  <div class="d-grid gap-2 d-md-block mb-5">
    <a class="btn btn-success" href="{{route('items.edit', ['item' => $item])}}" role="button">編集</a>
    <a class="btn btn-outline-dark" href="{{route('items.index')}}" role="button">戻る</a>
  </div>

  <table class="table table-hover">
    <tbody>
      <tr>
        <th scope="col" class="vw-30 bg-primary text-center">id</th>
        <td class="w-70">{{ $item->id }}</td>
      </tr>
      <tr>
        <th scope="col" class="vw-30 bg-primary text-center">氏名</th>
        <td class="w-70">{{ $item->name }}</td>
      </tr>
      <tr>
        <th scope="col" class="vw-30 bg-primary text-center">商品単価</th>
        <td class="w-70">{{ $item->price }}</td>
      </tr>
      <tr>
        <th scope="col" class="vw-30 bg-primary text-center">販売状態</th>
        @if($item->is_selling == 0)
        <td class="w-70">終売</td>
        @else
        <td class="w-70">販売中</td>
        @endif
      </tr>
      <tr>
        <th scope="col" class="vw-30 bg-primary text-center">備考</th>
        <td class="w-70">{{ $item->memo }}</td>
      </tr>
      <tr>
        <th scope="col" class="vw-30 bg-primary text-center">登録日</th>
        <td class="w-70">{{ $item->created_at }}</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection