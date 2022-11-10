@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Analysis</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-space-between">
                        <div class="col-md-6">
                            <label for="date1" class="form-label">From : </label>
                            <input type="date" name="startDate" class="form-control" id="startDate">
                        </div>
                        <div class="col-md-6">
                            <label for="date1" class="form-label">From : </label>
                            <input type="date" name="endDate" class="form-control" id="endDate">
                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <button type="submit" class="btn btn-primary" id="btn">検索</button>
                    </div>

                    <table class="table table-hover">
                        <thead>
                            <tr class="table-info">
                                <th scope="col" class="mx-5 text-center">id</th>
                                <th scope="col" class="mx-5 text-center">顧客氏名</th>
                                <th scope="col" class="mx-5 text-center">合計価格</th>
                                <th scope="col" class="mx-5 text-center">購入数</th>
                                <th scope="col" class="mx-5 text-center">状況</th>
                                <th scope="col" class="mx-5 text-center">購入日時</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            {{-- ここに検索データが入る --}}
                        </tbody>
                    </table>
                    <div>
                        <div id="loading" class="mx-auto mt-100 mb-100 d-none" style="width:200px;text-align:center;">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden"></span>
                            </div>
                        </div>
                    </div>
                    {{-- {{ $orders->appends(request()->input())->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection