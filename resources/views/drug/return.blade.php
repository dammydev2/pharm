@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-4">
    		<div class="panel-heading">Return</div>
    		<div class="panel-body">
    			
    			<form method="post" action="{{ url('/checkreturn') }}">
    				{{ csrf_field() }}

    				@if ($errors->any())
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</div>
					@endif

    				<div class="form-group">
    					<label>Customer</label>
                        <select name="rec" class="form-control">
                            <option>Select</option>
                            @foreach($data as $row)
                            <option value="{{ $row->rec }}">{{ $row->name }} ({{ $row->rec }})</option>
                            @endforeach
                        </select>
    				</div>

    				<input type="submit" name="submit" value="view" class="btn btn-primary">

    			</form>

    		</div>
    	</div>


    </div>
</div>
@endsection
