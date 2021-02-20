@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-10">
    		<div class="panel-heading">Workers</div>
    		<div class="panel-body">

                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

    			<table class="table table-bordered">
                    <tr>
                        <td colspan="3"><center><a href="{{ url('/addworker') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New worker</a></center></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <!-- <th>Type</th> -->
                        <th></th>
                        <th></th>
                    </tr>
                      @foreach($data as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <!-- <td>{{ $row->type }}</td> -->
                        <td><a href="{{ url('/workeredit/'.$row->id) }}">Edit</a></td>
                        <td><a href="{{ url('/workerdelete/'.$row->id) }}"><i class="fa fa-trash btn btn-danger"></i></a></td>
                    </tr>
                    @endforeach
                   
                   
                </table>

                

    		</div>
    	</div>


    </div>
</div>
@endsection
