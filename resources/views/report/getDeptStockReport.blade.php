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
                        <th>drug</th>
                        <th>units collected</th>
                        <th>unit price</th>
                    </tr>
                    @foreach($orders as $key => $order)
                    <tr>
                        <td>{{ $sn++ }}</td>
                        <th>{{ $order->name }}</th>
                        <th>{{ $order->quantity }}</th>
                        <th>{{ $order->cost_price }}</th>
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