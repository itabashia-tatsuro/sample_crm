@extends('layouts.app')

@section('content')

<div class="container mx-auto">
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  
  <div class="d-grid gap-2 d-md-block mb-3">
    <a class="btn btn-primary" href="{{route('items.create')}}" role="button">商品登録</a>
  </div>

  @if(empty($items[0]))
    <div class="alert alert-success mt-3">
      検索にヒットしませんでした。もう一度検索してください
    </div>
  @endif
  
  <form class="row g-3 mb-3" action="{{ route('search.items') }}" method="post">
    @csrf
    <div class="col-md-6">
      <label for="name" class="form-label">商品名</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="商品名を入力してください">
    </div>
    <div class="col-12">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="is_selling" id="is_selling" value="1">
        <label class="form-check-label" for="is_selling">販売中</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="is_selling" id="is_selling" value="0">
        <label class="form-check-label" for="is_selling">終売</label>
      </div>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">検索</button>
    </div>
  </form>

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