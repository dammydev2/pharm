@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-4">
    		<div class="panel-heading">Stock Breakdown</div>
    		<div class="panel-body">
    			
    			<form method="post" action="{{ url('/checkbreakdown') }}">
    				{{ csrf_field() }}

    				@if ($errors->any())
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</div>
					@endif

                    @foreach($data as $row)
                    <div class="form-group">
                        <label>Drug Name</label>
                        <input type="text" name="name" value="{{ $row->name }}" readonly="" class="form-control">
                    </div>
                    @endforeach

    				<div class="form-group">
    					<label>Start Date</label>
    					<input type="date" name="start" class="form-control">
    				</div>

                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end" class="form-control">
                    </div>

    				<input type="submit" name="submit" value="view" class="btn btn-primary">

    			</form>

    		</div>
    	</div>


    </div>
</div>
@endsection
