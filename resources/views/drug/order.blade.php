@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-6">
    		<div class="panel-heading">Order Drug(s)</div>
    		<div class="panel-body">
    			
    			<form method="post" action="{{ url('/orderenter') }}">
    				{{ csrf_field() }}

    				@if ($errors->any())
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</div>
					@endif

                    @if(Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                    @foreach($data as $row)
    				<div class="form-group">
    					<label>Drug Name</label>
    					<input type="text" name="name" readonly="" value="{{ $row->name }}" class="form-control">
    				</div>

                    <div class="form-group">
                        <label>Quantity in store</label>
                        <input type="number" name="qtyonhand" value="{{ $row->qtyonhand }}" readonly="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Quantity Ordered (unit)</label>
                        <input type="number" name="quantity" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Collector</label>
                        <input type="text" name="collector" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Department/Unit/Ward collecting</label>
                        <input type="text" name="unit" class="form-control">
                    </div>

                    <!-- <div class="form-group">
                        <label>Packs in Package</label>
                        <input type="text" name="bulk" value="{{ $row->qty }}" class="form-control">
                    </div> -->

                    <input type="hidden" name="id" value="{{ $row->id }}" >

                    @endforeach

    				<input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">

    			</form>

    		</div>
    	</div>


    </div>
</div>
@endsection
