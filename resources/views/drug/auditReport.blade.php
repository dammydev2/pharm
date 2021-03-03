@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <div class="panel panel-primary col-sm-11">
            <div class="panel-heading">Audit report</div>
            <div class="panel-body">

                <table class="table table-striped">
                    <tr>
                        <td>Name</td>
                        <td>Quantity at hand</td>
                        <td>Folio No.</td>
                        <td>Cost Price</td>
                        <td>Currently at Hand</td>
                        <td>Amount</td>
                    </tr>
                    <?php $gross = 0; ?>
                    @foreach($audits as $audit)
                    <tr>
                        <td>{{ $audit->name }}</td>
                        <td>{{ $audit->currently_at_hand }}</td>
                        <td>{{ $audit->folio_no }}</td>
                        <td>{{ $audit->cost_price }}</td>
                        <td class="text-right">{{ number_format($audit->at_hand, 2) }}</td>
                        <td class="text-right">{{ number_format($amount = $audit->at_hand * $audit->cost_price, 2) }}</td>
                        <?php $gross += $amount ?>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-right">TOTAL</td>
                        <td class="text-right">{{ number_format($gross, 2) }}</td>
                    </tr>
                </table>


            </div>
        </div>


    </div>
</div>
@endsection