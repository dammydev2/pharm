@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="panel panel-primary col-sm-8">

            <div class="panel-heading">Report for {{ Session::get('info') }} range from {{ Session::get('date') }} - {{ Session::get('date2') }}</div>
            <div class="panel-body">

                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                <table class="table table-bordered">
                    <tr>
                        <th>Receipt Number</th>
                        <th>Name</th>
                        <th>NHIS no</th>
                        <th>Amount to be paid</th>
                        <th>Tendered</th>
                        <th>balance</th>
                        <th>seller</th>
                    </tr>
                    <?php $total = 0 ?>
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $row->rec }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->nhis_no }}</td>
                        <td class="text-right">{{ number_format($row->sprice,2) }}</td>
                        <td>{{ $row->amount }}</td>
                        <td>{{ $row->balance }}</td>
                        <td>{{ $row->seller }}</td>
                        <?php $total += $row->sprice ?>
                    </tr>
                    @endforeach
                    <tr>
                        <th class="text-right" colspan="3">TOTAL</th>
                        <th class="text-right">{{ number_format($total,2) }}</th>
                    </tr>
                </table>

            </div>
        </div>


    </div>
</div>
@endsection