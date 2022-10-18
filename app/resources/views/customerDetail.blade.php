@extends('layouts.app')

@section('content')
<div class="container mx-auto">

  <table class="table table-hover">
    <tbody>
      <tr>
        <th scope="col" class="mp-3 text-center">id</th>
        <td class="mp-3">{{ $customer->id }}</td>
      </tr>
      <tr>
        <th scope="col" class="mp-3 text-center">氏名</th>
        <td class="mp-3">{{ $customer->name }}</td>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <th scope="col" class="mp-3 text-center">メールアドレス</th>
        <td class="mp-3">{{ $customer->email }}</td>
      </tr>
      <tr>
        <th scope="col" class="mp-3 text-center">電話</th>
        <td class="mp-3">{{ $customer->tel }}</td>
      </tr>
      <tr>
        <th scope="col" class="mp-3 text-center">住所</th>
        <td class="mp-3">{{ $customer->address }}</td>
      </tr>
      <tr>
        <th scope="col" class="mp-3 text-center">誕生日</th>
        <td class="mp-3">{{ $customer->birthday }}</td>
      </tr>
      <tr>
        <th scope="col" class="mp-3 text-center">性別</th>
        @if($customer->gender == 0)
        <td class="mp-3">男</td>
        @elseif($customer->gender == 1)
        <td class="mp-3">女</td>
        @else
        <td class="mp-3">その他</td>
        @endif
        <tr>
          <th scope="col" class="mp-3 text-center">備考</th>
          <td class="mp-3">{{ $customer->memo }}</td>
        </tr>
        <tr>
          <th scope="col" class="mp-3 text-center">登録日</th>
          <td class="mp-3">{{ $customer->created_at }}</td>
        </tr>
      </tr>
    </tbody>
  </table>
</div>
@endsection