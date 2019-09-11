@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-4">
    		<div class="panel-heading">Add Drug</div>
    		<div class="panel-body">
    			
    			<form method="post" action="{{ url('/enterdrug') }}">
    				{{ csrf_field() }}

    				@if ($errors->any())
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</div>
					@endif

    				<div class="form-group">
    					<label>Drug Name</label>
    					<input type="text" name="name" class="form-control">
    				</div>

                    <div class="form-group">
                        <label>Cost Price</label>
                        <input type="number" name="price" class="form-control">
                    </div>

    				<div class="form-group">
    					<label>Markup</label>
                        <select name="markup" class="form-control">
                            @for($i=0; $i<=100; $i++)
                            <option>{{ $i }}</option>
                            @endfor
                        </select>
    					<!--<input type="number" name="price" class="form-control">-->
    				</div>

    				<input type="submit" name="submit" value="Add Drug" class="btn btn-primary">

    			</form>

    		</div>
    	</div>


    </div>
</div>
@endsection
