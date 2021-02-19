@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <div class="panel panel-primary col-sm-11">
            <div class="panel-heading">Stock Report</div>
            <div class="panel-body">

                <?php $dates = Session::get('dates') ?>

                <ul class="list-group">
                    <li class="list-group-item">NET SALES FOR {{ $dates['start_date'] }} - {{ $dates['end_date'] }} <span id="total" class="badge"></span></li>
                    <!-- <li class="list-group-item">CLOSING STOCK <span class="badge">5</span></li>
                    <li class="list-group-item">TOTAL SALES <span class="badge">3</span></li> -->
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
                                <th>date collected</th>
                                <th>drug</th>
                                <th>quantity (unit)</th>
                                <th>collecting unit/ dept.</th>
                                <th>unit cost price</th>
                            </tr>
                            <?php $total_sales = 0; ?>
                            @foreach($data['sales'] as $sales)
                            <tr>
                                <td>{{ $sales->created_at->toDateString() }}</td>
                                <td>{{ $sales->name }}</td>
                                <td>{{ $sales->quantity }}</td>
                                <td>{{ $sales->collecting_unit }}</td>
                                <td>{{ $sales->cost_price }}</td>
                                <?php $total_sales += $sales->cost_price * $sales->quantity; ?>
                            </tr>
                            @endforeach
                            <?php $total_sales; ?>
                        </table>
                    </div>

                </div>

            </div>
        </div>


    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
    total = '<?php echo $total_sales; ?>'
    newTotal = numeral(total).format('0,0.00');
    $(document).ready(function() {
        $("#total").text(newTotal);
    });
</script>
<style>
    .space {
        height: 170px;
    }

    .text-underline {
        border-bottom: 3px double #000000;
    }

    .badge{
        font-size: 20px;
    }
</style>
@endsection