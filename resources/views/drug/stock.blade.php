@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-10">
    		<div class="panel-heading">Add Drug</div>
    		<div class="panel-body">

                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

    			<table class="table table-bordered">
                    <tr>
                        <td colspan="3"><center><a href="{{ url('/addnewstock') }}" class="btn btn-primary">Add Diffrent/ Fresh Drug</a></center></td>
                    </tr>
                    <tr>
                        <th colspan="6"><center>All Stock as at {{ date('D d/m/Y') }}</center></th>
                    </tr>
                    <tr>
                        <th>Drug Name</th>
                        <th>Folio No.</th>
                        <th>Qty in store (units)</th>
                        <th>Cost Price (units)</th>
                        <th>Selling Price (units)</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                     @foreach($data as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->folio_no }}</td>
                        <td>
                            @if( ($row->qtyonhand ) < $row->reorder)
                            <span style="color: red;">
                            @endif
                            {{ number_format($row->qtyonhand, 0) }} 
                            </span>
                        </td>
                        <td>{{ $row->cprice }}</td>
                        <td>{{ $row->selling_price }}</td>
                        <td><a href="{{ url('/stockadd/'.$row->id) }}">Add Stock</a></td>
                        <td><a href="{{ url('/order/'.$row->id) }}">Order</a></td>
                        <td><a href="{{ url('/stockedit/'.$row->id) }}">Edit</a></td>
                        <td><a href="{{ url('/stockbreakdown/'.$row->id) }}">Breakdown</a></td>
                    </tr>
                    @endforeach
                   
                </table>

                {{ $data->links() }}

    		</div>
    	</div>


    </div>
</div>
@endsection
