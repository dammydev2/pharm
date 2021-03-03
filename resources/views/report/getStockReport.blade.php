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
                    <li class="list-group-item">TOTAL OPENING STOCK <span id="totalOpeningStock" class="badge"></span></li>
                    <li class="list-group-item">TOTAL PURCHASES <span id="totalPurchases" class="badge"></span></li>
                    <li class="list-group-item">TOTAL CLOSING STOCK <span id="totalClosingStock" class="badge"></span></li>
                    <li class="list-group-item">COST OF SALES = ( [TOTAL OPENING STOCK + TOTAL PURCHASES] - TOTAL CLOSING STOCK) <span id="totalSales" class="badge"></span></li>
                    <li class="list-group-item">TOTAL SALES (DISPENSORY AND IN-PATIENT ONLY) <span class="badge">{{ number_format($data['wing_sales'], 2) }}</span></li>
                    <li class="list-group-item">TOTAL COST PRICE<span id="costPrice" class="badge"></span></li>
                    <li class="list-group-item">GROSS PROFIT = ( (TOTAL SALES + 4-wings block + Ijoga-Orile + Cardio + ETR) - TOTAL COST PRICE)<span class="badge"></span></li>
                    <li class="list-group-item">5% MARKUP = GROSS PROFIT * 0.05<span class="badge"></span></li>
                    <li class="list-group-item">NET PROFIT = GROSS PROFIT - 5% MARKUP<span class="badge"></span></li>
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
                                <th>opening stock</th>
                                <th>selling price</th>
                            </tr>
                            <?php
                            $totalOpeningStock = 0;
                            $openingStockCost = 0;

                            ?>
                            @foreach($data['opening_stock'] as $stock)
                            <tr>
                                <td>{{ $stock->name }}</td>
                                <td>{{ $stock->current_stock }}</td>
                                <td class="text-right">{{ number_format($stock->selling_price, 2) }}</td>
                            </tr>
                            <?php $totalOpeningStock += ($stock->current_stock * $stock->selling_price) ?>
                            <?php $openingStockCost += ($stock->current_stock * $stock->cost_price) ?>
                            @endforeach
                            <?php $totalOpeningStock; ?>
                        </table>
                    </div>

                    <div class="col-md-5">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="3" class="text-center">Closing Stock for {{ $dates['end_date'] }}</th>
                            </tr>
                            <tr>
                                <th>drug</th>
                                <th>closing stock</th>
                                <th>selling price</th>
                            </tr>
                            <?php $totalClosingStock = 0; $closingStockCost = 0; ?>
                            @foreach($data['closing_stock'] as $stock)
                            <tr>
                                <td>{{ $stock->name }}</td>
                                <td>{{ $stock->current_stock }}</td>
                                <td class="text-right">{{ number_format($stock->selling_price, 2) }}</td>
                            </tr>
                            <?php $totalClosingStock += ($stock->current_stock * $stock->selling_price) ?>
                            <?php $closingStockCost += ($stock->current_stock * $stock->cost_price) ?>
                            @endforeach
                            <?php $totalClosingStock; ?>
                        </table>
                    </div>
                    <!-- PURCHASES TABLE -->

                    <?php $totalPurchases = 0; $purchaseCost = 0; ?>
                    @foreach($data['purchases'] as $purchase)

                    <?php $totalPurchases += ($purchase->quantity * $purchase->selling_price) ?>
                    <?php $purchaseCost += ($purchase->quantity * $purchase->cprice) ?>
                    @endforeach
                    <?php
                    // getting cost of sales
                    $costOfSales = ($totalOpeningStock + $totalPurchases) - $totalClosingStock;
                    // getting total cost price
                    $costPrice = ($openingStockCost + $purchaseCost) - $closingStockCost;
                    // getting gross sales
                    $grossProfit = $costOfSales - $costPrice;
                    $markup = $grossProfit * 0.05;
                    // net profit
                    $netProfit = $grossProfit - $markup;
                    ?>

                </div>

            </div>
        </div>


    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
    OpeningStock = '<?php echo $totalOpeningStock; ?>'
    Purchases = '<?php echo $totalPurchases; ?>'
    ClosingStock = '<?php echo $totalClosingStock; ?>'
    costOfSales = '<?php echo $costOfSales; ?>'
    costPrice = '<?php echo $costPrice; ?>'
    grossProfit = '<?php echo $grossProfit; ?>'
    markup = '<?php echo $markup; ?>'
    netProfit = '<?php echo $netProfit; ?>'
    totalOpeningStock = numeral(OpeningStock).format('0,0.00');
    totalClosingStock = numeral(ClosingStock).format('0,0.00');
    totalPurchases = numeral(Purchases).format('0,0.00');
    totalSales = numeral(costOfSales).format('0,0.00');
    costPrice = numeral(costPrice).format('0,0.00');
    grossProfit = numeral(grossProfit).format('0,0.00');
    markup = numeral(markup).format('0,0.00');
    netProfit = numeral(netProfit).format('0,0.00');
    $(document).ready(function() {
        $("#totalOpeningStock").text(totalOpeningStock);
        $("#totalClosingStock").text(totalClosingStock);
        $("#totalPurchases").text(totalPurchases);
        $("#totalSales").text(totalSales);
        $("#costPrice").text(costPrice);
        $("#grossProfit").text(grossProfit);
        $("#markup").text(markup);
        $("#netProfit").text(netProfit);
    });
</script>
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