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
    					<label>Reorder Level</label>
    					<input type="number" name="reorder" placeholder="e.g. 10"  class="form-control">
    				</div>
<!-- 
    				<div class="form-group">
    					<label>Packs in Package</label>
    					<input type="number" name="qty" placeholder="e.g. 200" class="form-control">
    				</div> -->

                    <div class="form-group">
                        <label>Cost Price (per unit)</label>
                        <input type="number" name="cprice" class="form-control">
                    </div>  

					<div class="form-group">
                        <label>Selling Price (per unit)</label>
                        <input type="number" name="selling_price" class="form-control">
                    </div>                

    				<input type="submit" name="submit" value="Add to stocks" class="btn btn-primary">

    			</form>

    		</div>
    	</div>


    </div>
</div>
@endsection
