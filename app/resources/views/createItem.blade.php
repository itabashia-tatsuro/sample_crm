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

  <form action="{{ route('items.store') }}" method="post">
    @csrf
    
    {{-- 商品名 --}}
    <div class="mb-3">
      <label for="name" class="form-label">商品名</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
    </div>
    
    {{-- 単価 --}}
    <div class="mb-3">
      <label for="price" class="form-label">値段</label>
      <input type="number" min="500" max="10000" class="form-control" name="price" id="price" placeholder="半角で入力してください"  value="{{ old('price') }}">
    </div>

    <div class="mb-3">
      <label for="memo" class="form-label">備考</label>
      <textarea class="form-control" name="memo" id="memo" rows="3" style="height: 100px" style="resize:none;">{{ old('memo') }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary" onclick="return confirm('新しい商品を登録します。よろしいですか？')">登録する</button>
  </form>
</div>
@endsection