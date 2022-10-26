@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container d-flex justify-content-around">
                        <div class="row">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header">
                                    人数
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">総顧客数：{{ $perCustomerCount['total'] }}人</li>
                                    <li class="list-group-item">男性：{{ $perCustomerCount['men'] }}人</li>
                                    <li class="list-group-item">女性：{{ $perCustomerCount['women'] }}人</li>
                                    <li class="list-group-item">その他：{{ $perCustomerCount['other'] }}人</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header">
                                    年代別人数
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">An item</li>
                                    <li class="list-group-item">A second item</li>
                                    <li class="list-group-item">A third item</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
