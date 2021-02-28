@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-8">
    		<div class="panel-heading">Add Drug</div>
    		<div class="panel-body">

                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

    			<table class="table table-bordered">
                    <tr>
                        <td colspan="3"><center><a href="{{ url('/adddrug') }}" class="btn btn-primary">Add Diffrent Drug</a></center></td>
                    </tr>
                    <tr>
                        <th colspan="6"><center>All Stock as at {{ date('D d/m/Y') }}</center></th>
                    </tr>
                    <tr>
                        <th>Drug Name</th>
                        <th>Cost Price</th>
                        <th>Selling Price</th>
                        <th>Quantity (units)</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->cprice }}</td>
                        <td>{{ $row->sprice }}</td>
                        <td>{{ $row->qty }}</td>
                        <td><a href="{{ url('/drugadd/'.$row->id) }}">Add Stock</a></td>
                        <td><a href="{{ url('/drugedit/'.$row->id) }}">Edit</a></td>
                        <td><a href="{{ url('/drugbreakdown/'.$row->id) }}">Breakdown</a></td>
                    </tr>
                    @endforeach
                </table>

    		</div>
    	</div>


    </div>
</div>
@endsection
