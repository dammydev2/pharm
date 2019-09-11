@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-4">
    		<div class="panel-heading">Add Stock</div>
    		<div class="panel-body">
    			
    			<form method="post" action="{{ url('/enterstock') }}">
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
                        <input type="text" name="name"  class="form-control">
                    </div>

                    <div class="form-group">
    					<label>Bulk form</label>
    					<input type="text" name="bulk" placeholder="e.g. carton, sachet"  class="form-control">
    				</div>

    				<div class="form-group">
    					<label>Quantity in pieces</label>
    					<input type="number" name="qty"  class="form-control">
    				</div>

                    <div class="form-group">
                        <label>Cost Price</label>
                        <input type="number" name="cprice" class="form-control">
                    </div>                

    				<input type="submit" name="submit" value="Add to stocks" class="btn btn-primary">

    			</form>

    		</div>
    	</div>


    </div>
</div>
@endsection
