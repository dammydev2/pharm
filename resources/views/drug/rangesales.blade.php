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
                        <th>Balance</th>
                        <th>Seller</th>
                    </tr>
                    <?php
                    $total = 0;
                    $cost = 0;
                    ?>
                    @foreach($data as $row)
                    <tr>
                        <td><a href="{{ url('/getrec/'.$row->rec) }}">{{ $row->rec }}</a></td>
                        <td>{{ $row->cprice }}</td>
                        <td>{{ $row->sprice }}</td>
                        <td>{{ $row->amount }}</td>
                        <td>{{ $row->balance }}</td>
                        <td>{{ $row->seller }}</td>
                    </tr>
                    <?php
                    $total += $row->sprice;
                    $cost += $row->cprice;
                    ?>
                    @endforeach
                    <tr>
                        <th></th>
                        <th>{{ number_format($cost, 2) }}</th>
                        <th >{{ number_format($total, 2) }}</th>
                        <th colspan="3"></th>
                    </tr>
                    <tr>
                        <th colspan="5">
                            Net Profit: <b><?php echo number_format($total-$cost, 2); ?></b>
                        </th>
                    </tr>

                    {{ $data->links() }}
                </table>

    		</div>
    	</div>


    </div>
</div>
@endsection
