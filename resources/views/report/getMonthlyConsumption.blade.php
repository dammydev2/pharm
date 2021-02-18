@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <div class="panel panel-primary col-sm-11">
            <div class="panel-heading">Monthly COnsumptions Report</div>
            <div class="panel-body">

                <?php $dates = Session::get('dates') ?>


                <table class="table table-striped">
                    <tr>
                        <th>drug</th>
                        <th>quantity</th>
                        <th>cost_price</th>
                    </tr>
                    @foreach($consumptions as $key => $consumption)
                    <tr>
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