@extends('layouts.app')

@section('content')

<div class="container mx-auto">
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  
  <div class="d-grid gap-2 d-md-block mb-5">
    <a class="btn btn-primary" href="{{route('items.create')}}" role="button">商品登録</a>
  </div>

  <table class="table table-hover">
    <thead>
      <tr class="table-info">
        <th scope="col" class="mx-5 text-center">id</th>
        <th scope="col" class="mx-5 text-center">商品名</th>
        <th scope="col" class="mx-5 text-center">価格</th>
        <th scope="col" class="mx-5 text-center">販売状態</th>
        <th scope="col" class="mx-5 text-center">詳細ページリンク</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
      <tr>
        <td class="mx-5 text-center">{{ $item->id }}</td>
        <td class="mx-5 text-center">{{ $item->name }}</td>
        <td class="mx-5 text-center">{{ $item->price }}</td>
        @if($item->is_selling == 0)
        <td class="mx-5 text-center bg-secondary">終売</td>
        @else
        <td class="mx-5 text-center">販売中</td>
        @endif
        <td class="mx-5 text-center"><a href="{{route('items.show', ['item'=> $item->id ])}}">#</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
  {{ $items->links() }}
</div>
@endsection