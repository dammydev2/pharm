@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <?php
        $request = Session::get('request');
        $monthStart   = DateTime::createFromFormat('!m', $request['start_month']);
        $monthEnd   = DateTime::createFromFormat('!m', $request['end_month']);
        $start_month = $monthStart->format('F'); // March
        $end_month = $monthEnd->format('F'); // March
        ?>
        <div class="panel panel-primary col-sm-11">
            <div class="panel-heading">Multiple Monthly Consumptions Report for {{ $start_month.' - '.$end_month.' '.$request['year'] }}</div>
            <div class="panel-body">

                <table class="table table-striped table-bordered">
                    <tr>
                        <th>s/n</th>
                        <th>drug</th>
                        <th>unit sold ({{ $total_months = $request['end_month'] - $request['start_month'] + 1 }} months)</th>
                        <th>unit price</th>
                        <th>{{ $total_months }} months total sales</th>
                        <th>average monthly sales (units)</th>
                        <th>average monthly sales (amount)</th>
                    </tr>
                    @foreach($consumptions as $key => $consumption)
                    <tr>
                        <td>{{ $sn++ }}</td>
                        <th>{{ $consumption['name'] }}</th>
                        <th>{{ $consumption['SUM(quantity)'] }}</th>
                        <th>{{ $consumption['cost_price'] }}</th>
                        <th class="text-right">{{ number_format($consumption['cost_price'] * $consumption['SUM(quantity)'], 2) }}</th>
                        <th class="text-right">{{ number_format(($average = $consumption['SUM(quantity)'] / $total_months), 1) }}</th>
                        <th class="text-right">{{ number_format($average * $consumption['cost_price'], 2) }}</th>
                    </tr>
                    @endforeach
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