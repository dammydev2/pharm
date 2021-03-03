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
                        <label>Quantity in store (unit)</label>
                        <input type="number" name="qtyonhand" value="{{ $row->qtyonhand }}" readonly="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Quantity Ordered (unit)</label>
                        <input type="number" name="quantity" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Collector's Name</label>
                        <input type="text" name="collector" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Expire Date</label>
                        <input type="date" name="expire_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Department/Unit/Ward collecting</label>
                        <!-- <input type="text" name="unit" class="form-control"> -->
                        <select name="unit" class="form-control" id="">
                            <option>4-wing block</option>
                            <option>Ijoga Orile</option>
                            <option value="substore">Sub store</option>
                            <option>Cardio unit</option>
                            <option>In-patient</option>
                            <option>ETR</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Cost Price (per unit)</label>
                        <input type="text" name="cost_price" value="{{ $row->cprice }}" readonly class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Selling Price (per unit)</label>
                        <input type="text" name="selling_price" value="{{ $row->selling_price }}" readonly class="form-control">
                    </div>

                    <!-- <div class="form-group">
                        <label>Selling Price (per unit)</label>
                        <input type="text" name="selling_price" value="" class="form-control">
                    </div> -->

                    <input type="hidden" name="id" value="{{ $row->id }}" >
                    <input type="hidden" name="markup" value="{{ $row->markup }}" >
                    <input type="hidden" name="folio_no" value="{{ $row->folio_no }}" >

                    @endforeach

    				<input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">

    			</form>

    		</div>
    	</div>


    </div>
</div>
@endsection
