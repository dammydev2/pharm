@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <div class="panel panel-primary col-sm-10">
            <div class="panel-heading">Stock Report</div>
            <div class="panel-body">

                <table class="table table-bordered">
                    <tr>
                        <th>date</th>
                        <th>name</th>
                        <th>stock</th>
                        <th>cost price</th>
                        <th>total</th>
                    </tr>
                    <?php $totalStockSales = 0; ?>
                    @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $stock->created_at->toDateString() }}</td>
                        <td>{{ $stock->name }}</td>
                        <td>{{ $stock->current_stock }}</td>
                        <td>{{ $stock->cost_price }}</td>
                        <td>{{ $sub_total = ($stock->cost_price * $stock->current_stock) }}</td>
                        <?php $totalStockSales += $sub_total ?>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" class="text-right">GRAND TOTAL</th>
                        <th>{{ number_format($totalStockSales, 2) }}</th>
                    </tr>
                </table>

            </div>
        </div>


    </div>
</div>
<style>
    .space {
        height: 170px;
    }
</style>
@endsection