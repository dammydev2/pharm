@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <?php
        $request = Session::get('request');
        ?>
        <div class="panel panel-primary col-sm-11">
            <div class="panel-heading">{{ $request['department'] }} orders for {{ $request['start_date'] }} to {{ $request['end_date'] }}</div>
            <div class="panel-body">

                <table class="table table-striped table-bordered">
                    <tr>
                        <th>s/n</th>
                        <th>date collected</th>
                        <th>drug</th>
                        <th>units collected</th>
                        <th>unit selling price</th>
                        <th> amount</th>
                    </tr>
                    <?php $gross_total = 0; ?>
                    @foreach($orders as $key => $order)
                    <tr>
                        <td>{{ $sn++ }}</td>
                        <th>{{ $order->created_at->toDateString() }}</th>
                        <th>{{ $order->name }}</th>
                        <th>{{ $order->quantity }}</th>
                        <th class="text-right">{{ number_format($order->selling_price, 2) }}</th>
                        <th class="text-right">{{ number_format($net_total = $order->selling_price * $order->quantity, 2) }}</th>
                        <?php $gross_total += $net_total; ?>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="5" class="text-right">GROSS TOTAL</th>
                        <th class="text-right">{{ number_format($gross_total, 2) }}</th>
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

    .text-underline {
        border-bottom: 3px double #000000;
    }

    .badge {
        font-size: 20px;
    }
</style>
@endsection