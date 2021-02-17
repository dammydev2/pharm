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

                <?php $dates = Session::get('dates') ?>

                <ul class="list-group">
                    <li class="list-group-item">TOTAL STOCK <span class="badge">12</span></li>
                    <li class="list-group-item">CLOSING STOCK <span class="badge">5</span></li>
                    <li class="list-group-item">TOTAL SALES <span class="badge">3</span></li>
                </ul>

                <button data-toggle="collapse" class="btn btn-primary btn-block" data-target="#demo">Show Stock Details</button>

                <div id="demo" class="collapse">
                    <div class="col-md-5">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="3" class="text-center">Opening Stock for {{ $dates['start_date'] }}</th>
                            </tr>
                            <tr>
                                <th>drug</th>
                                <th>stock</th>
                                <th>cost price</th>
                            </tr>
                            @foreach($data['opening_stock'] as $stock)
                            <tr>
                                <td>{{ $stock->name }}</td>
                                <td>{{ $stock->current_stock }}</td>
                                <td class="text-right">{{ number_format($stock->cost_price, 2) }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <table class="table table-striped">
                            <tr>
                                <th>drug</th>
                                <th>quantity</th>
                                <th>collecting unit</th>
                                <th>cost price</th>
                            </tr>
                            @foreach($data['sales'] as $sales)
                            <tr>
                                <td>{{ $sales->name }}</td>
                                <td>{{ $sales->quantity }}</td>
                                <td>{{ $sales->collecting_unit }}</td>
                                <td>{{ $sales->cost_price }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                </div>

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
</style>
@endsection