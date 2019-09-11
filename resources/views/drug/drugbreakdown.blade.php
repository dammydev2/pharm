@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-8">
    		<div class="panel-heading">Stock Brought In</div>
    		<div class="panel-body">

                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

    			<table class="table table-bordered">
                    <tr>
                        <th>Date Brought</th>
                        <th>Drug Name</th>
                        <th>Cost Price</th>
                        <th>Selling Price</th>
                        <th>Quantity brought in</th>
                        <th>Expire date</th>
                    </tr>
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->cprice }}</td>
                        <td>{{ $row->sprice }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->exp }}</td>
                    </tr>
                    @endforeach

                    {{ $data->links() }}
                </table>

    		</div>
    	</div>


    </div>
</div>
@endsection
