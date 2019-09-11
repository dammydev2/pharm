@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-4">
    		<div class="panel-heading">Profit Margin</div>
    		<div class="panel-body">
    			
    			<form method="post" action="{{ url('/checkprofit') }}">
    				{{ csrf_field() }}

    				@if ($errors->any())
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</div>
					@endif

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
