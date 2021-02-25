@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="panel panel-primary col-sm-8">
            <div class="panel-heading">Profit range from {{ Session::get('date') }} - {{ Session::get('date2') }}</div>
            <div class="panel-body">

                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                <table class="table table-bordered">
                    <tr>
                        <th>Receipt Number</th>
                        <th>Total Cost Price</th>
                        <th>Total Selling Price</th>
                        <th>Amount Tendered</th>
                        <th>5% mark-up</th>
                        <th>Balance</th>
                        <th>Seller</th>
                    </tr>
                    <?php
                    $total = 0;
                    $cost = 0;
                    $totalNetProfit = 0;
                    ?>
                    @foreach($data as $row)
                    <tr>
                        <td><a href="{{ url('/getrec/'.$row->rec) }}">{{ $row->rec }}</a></td>
                        <td>{{ $row->cprice }}</td>
                        <td>{{ $row->sprice }}</td>
                        <td>{{ $row->amount }}</td>
                        <?php $net_profit = $row->sprice - $row->cprice ?>
                        <td>{{ number_format($totalNet = $net_profit * 0.05, 2) }}</td>
                        <td>{{ $row->balance }}</td>
                        <td>{{ $row->seller }}</td>
                    </tr>
                    <?php
                    $total += $row->sprice;
                    $cost += $row->cprice;
                    $totalNetProfit += $totalNet;
                    ?>
                    @endforeach
                    <tr>
                        <th></th>
                        <th>{{ number_format($cost, 2) }}</th>
                        <th>{{ number_format($total, 2) }}</th>
                        <th></th>
                        <th>{{ number_format($totalNetProfit, 2) }}</th>
                        <th colspan="2"></th>
                    </tr>
                    <tr>
                        <th>Gross Profit: </th>
                        <th class="text-right"><b><?php echo number_format($grossProfit = $total - $cost, 2); ?></b></th>
                    </tr>
                    <tr>
                        <th>5% profit mark-up: </th>
                        <th class="text-right"><b><?php echo number_format($totalNetProfit, 2); ?></b></th>
                    </tr>
                    <tr>
                        <th>Net Profit: </th>
                        <th class="text-right"><b><?php echo number_format($grossProfit - $totalNetProfit, 2); ?></b></th>
                    </tr>

                    {{ $data->links() }}
                </table>

            </div>
        </div>


    </div>
</div>
@endsection