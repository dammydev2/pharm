@extends('layouts.app')

@section('content')
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<link href="{{ URL::asset('css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ URL::asset('js/select2.min.js') }}"></script>
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-4">
    		<div class="panel-heading">Return</div>
    		<div class="panel-body">

            @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
    			
    			<form method="post" action="{{ url('/removeReceipt') }}">
    				{{ csrf_field() }}

    				@if ($errors->any())
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
						@endforeach
					</div>
					@endif

    				<div class="form-group">
    					<label>Receipt Number</label>
                        <select name="rec" class="js-example-basic-single form-control">
                            <option value="">Select Receipt</option>
                            @foreach($receipts as $row)
                            <option value="{{ $row->rec }}"> {{ $row->rec }} </option>
                            @endforeach
                        </select>
    				</div>

    				<input type="submit" name="submit" value="remove" onclick="return confirm('Are you sure? action cannot be undone')" class="btn btn-primary">

    			</form>

    		</div>
    	</div>


    </div>
</div>

<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
@endsection
