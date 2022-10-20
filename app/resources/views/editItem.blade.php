@extends('layouts.app')

@section('content')
<div class="container mx-auto" style="width: 500px">
  {{-- バリデーション・エラーメッセージ --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('items.update', ['item' => $item->id]) }}" method="post">
    @method('PUT')
    @csrf
    
    {{-- 商品名 --}}
    <div class="mb-3">
      <label for="name" class="form-label">商品名</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $item->name}}">
    </div>
    
    {{-- 単価 --}}
    <div class="mb-3">
      <label for="price" class="form-label">値段</label>
      <input type="number" min="500" max="10000" class="form-control" name="price" id="price" placeholder="半角で入力してください" value="{{ $item->price }}">
    </div>

    <div class="form-check form-check-inline">
      <div class="mb-3">
        <input class="form-check-input" type="checkbox" value="1" id="is_selling" name="is_selling" checked>
        <label class="form-check-label" for="is_selling">販売中</label>
      </div>
    </div>
    <div class="form-check form-check-inline">
      <div class="mb-3">
        <input class="form-check-input" type="checkbox" value="0" id="is_selling" name="is_selling">
        <label class="form-check-label" for="is_selling">終売</label>
      </div>
    </div>
    
    <div class="mb-3">
      <label for="memo" class="form-label">備考</label>
      <textarea class="form-control" name="memo" id="memo" rows="3" style="height: 100px" style="resize:none;">{{ $item->memo }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary" onclick="return confirm('商品内容を変更します。よろしいですか？')">変更する</button>
  </form>
</div>
@endsection