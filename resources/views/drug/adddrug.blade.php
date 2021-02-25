@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container">
	<div class="row">

		<div class="col-md-12" style="height: 200px;"></div>
		<div class="col-md-4"></div>
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
						<select name="name" class="form-control js-example-basic-single" id="">
							<option value="">select drug name</option>
							@foreach($drugs as $drug)
							<option value="{{ $drug->id }}">{{ $drug->name }}</option>
							@endforeach
						</select>
					</div>

					<input type="submit" name="submit" value="Add Drug" class="btn btn-primary">

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