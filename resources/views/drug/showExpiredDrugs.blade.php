@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <?php
        $dates = Session::get('dates');
        // return $dates;
        ?>

        <div class="panel panel-primary col-sm-10">
            <div class="panel-heading">Expired Drugs from {{ $dates['start_date'] }} - {{ $dates['end_date'] }}</div>
            <div class="panel-body">

                <table class="table table-striped">
                    <tr>
                        <th>Drug Name</th>
                        <th>Batch No</th>
                        <th>Expire Date</th>
                        <th>Quantity Expired</th>
                        <th>Cost Price</th>
                        <th>Selling Price</th>
                        <th>Total (Selling Price)</th>
                    </tr>
                    <?php $grossTotal = 0; ?>
                    @foreach($expiredDrugs as $expiredDrug)
                    <tr>
                        <td>{{ $expiredDrug->name }}</td>
                        <td>{{ $expiredDrug->batch_no }}</td>
                        <td>{{ $expiredDrug->exp }}</td>
                        <td>{{ $expiredDrug->currently_at_hand }}</td>
                        <td class="text-right">{{ number_format($expiredDrug->cprice, 2) }}</td>
                        <td class="text-right">{{ number_format($expiredDrug->selling_price, 2) }}</td>
                        <td class="text-right">{{ number_format($total = $expiredDrug->selling_price * $expiredDrug->currently_at_hand, 2) }}</td>
                        <?php $grossTotal += $total; ?>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="6" class="text-right">TOTAL</th>
                        <th class="text-right">{{ number_format($grossTotal, 2) }}</th>
                    </tr>
                </table>

            </div>
        </div>


    </div>
</div>
<style>
    .space {
        height: 100px;
    }
</style>
@endsection