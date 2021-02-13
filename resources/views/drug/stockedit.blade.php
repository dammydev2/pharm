@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-4">
    		<div class="panel-heading">Add Stock</div>
    		<div class="panel-body">
    			
    			<form method="post" action="{{ url('/updatestock') }}">
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
                        <input type="text" value="{{ $row->name }}" name="name"  class="form-control">
                    </div>

                    <!-- <div class="form-group">
    					<label>Bulk form</label>
    					<input type="text" name="bulk" value="{{ $row->bulk }}" placeholder="e.g. carton, sachet"  class="form-control">
    				</div> -->

    				<div class="form-group">
    					<label>Quantity in unit</label>
    					<input type="number" name="qty" value="{{ $row->qtyonhand }}" class="form-control">
    				</div>

                    <div class="form-group">
                        <label>Cost Price</label>
                        <input type="number" name="cprice" value="{{ $row->cprice }}" class="form-control">
                    </div>        

                    <input type="hidden" name="id" value="{{ $row->id }}">        
                    @endforeach

    				<input type="submit" name="submit" value="update" class="btn btn-primary">

    			</form>

    		</div>
    	</div>


    </div>
</div>
@endsection
