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
                        <th>Expected pecies</th>
                        <th>Qty in store</th>
                        <th>Qty in pieces</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                     @foreach($data as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>
                            @if($row->qtyonhand < 11)
                            <span style="color: red;">
                            @endif
                            {{ $row->qtyonhand }} {{ $row->bulk }}
                            </span>
                        </td>
                        <td>{{ $row->qtyonhand * $row->qty }}</td>
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
