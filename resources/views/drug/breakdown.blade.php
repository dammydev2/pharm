@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-12">
    		<div class="panel-heading">{{ Session::get('name') }} Breakdown from {{ Session::get('date') }} to {{ Session::get('date2') }}</div>
    		<div class="panel-body">

                <div class="col-sm-5">
                   <table class="table table-bordered">
                    <tr>
                        <th  colspan="5"><center>{{ Session::get('name') }} Stock</center></th>
                    </tr>
                    <tr>
                        <th>Date brought</th>
                        <th>Name</th>
                        <th>Cost Price</th>
                        <th>Qty brought in</th>
                        <th>Autenticator</th>
                    </tr>

                    @foreach($data as $row)
                    <?php 
                    $dt = new DateTime($row->created_at);

                    $date = $dt->format('d/m/Y');
                    ?>
                    <tr>
                        <td>{{ $date }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->cprice }}</td>
                        <td>{{ $row->quantity }} X {{ $row->pack }}</td>
                        <td>{{ $row->autenticate }}</td>
                    </tr>
                    @endforeach

                </table>
            </div>

            <div class="col-sm-6">
               <table class="table table-bordered">
                <tr>
                    <th  colspan="5"><center>{{ Session::get('name') }} Ordered out</center></th>
                </tr>
                <tr>
                    <th>Date ordered</th>
                    <th>Name</th>
                    <th>Collector</th>
                    <th>unit</th>
                    <th>Qty</th>
                    <th>Confirm by</th>
                </tr>

                @foreach($data2 as $row)
                <?php 
                    $dt = new DateTime($row->created_at);

                    $date = $dt->format('d/m/Y');
                    ?>
                <tr>
                    <td>{{ $date }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->collector }}</td>
                    <td>{{ $row->collecting_unit }}</td>
                    <td>{{ $row->quantity }} X {{ $row->bulk }}</td>
                    <td>{{ $row->seller }}</td>
                </tr>
                @endforeach

            </table>
        </div>


    </div>
</div>


</div>
</div>
@endsection
