@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-4">
    		<div class="panel-heading">Add Stock</div>
    		<div class="panel-body">
    			
    			<form method="post" action="{{ url('/addstock') }}">
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
    					<input type="text" name="name" readonly="" value="{{ $row->name }}" class="form-control">
    				</div>

    				<div class="form-group">
    					<label>Selling Price</label>
    					<input type="number" name="price" value="{{ $row->sprice }}" class="form-control">
    				</div>

                    <div class="form-group">
                        <label>Cost Price</label>
                        <input type="number" name="cprice" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Quantity Brought in (Dispensing Bits)</label>
                        <input type="number" name="quantity" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Expire Date</label>
                        <input type="date" name="exp" class="form-control">
                    </div>

                    <input type="hidden" name="id" value="{{ $row->id }}" >
                    <input type="hidden" name="qty" value="{{ $row->qty }}" >

                    @endforeach

    				<input type="submit" name="submit" value="Add to stocks" class="btn btn-primary">

    			</form>

    		</div>
    	</div>


    </div>
</div>
@endsection
