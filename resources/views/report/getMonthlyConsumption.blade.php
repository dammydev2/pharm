@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <?php
        $date = Session::get('selection');
        $dateObj   = DateTime::createFromFormat('!m', $date['month']);
        $monthName = $dateObj->format('F'); // March
        ?>
        <div class="panel panel-primary col-sm-11">
            <div class="panel-heading">Monthly Consumptions Report for {{ $monthName.' '.$date['year'] }}</div>
            <div class="panel-body">




                <table class="table table-striped">
                    <tr>
                        <th>s/n</th>
                        <th>drug</th>
                        <th>unit</th>
                        <th>unit price</th>
                    </tr>
                    @foreach($consumptions as $key => $consumption)
                    <tr>
                        <td>{{ $sn++ }}</td>
                        <th>{{ $consumption['name'] }}</th>
                        <th>{{ $consumption['SUM(quantity)'] }}</th>
                        <th>{{ $consumption['cost_price'] }}</th>
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