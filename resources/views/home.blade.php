@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container">
	<div class="row">

		{{ Session::get('password') }}
		{{ Session::get('email') }}

		@php

		//DB::table('users')->join('groups', 'users.group_id', '=', 'groups.id')->get();

		$Date = date('Y-m-d');
		$dt = date('Y-m-d', strtotime($Date. ' + 7 days'));
		$data = DB::table('newstocks')->where('exp', '<=', $dt)->get();


			@endphp
			<!--<div class="alert alert-danger">
			@foreach($data as $row)
			The following drugs will be expiring in the next 7 days
			{{ $row->name }}<br>

			@endforeach
		</div>-->


			@if(!$isDrugExpiring->isEmpty() AND \Auth::User()->type === 'store')
			<!-- DRUG EXPIRING Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Some drugs are expiring soon</h4>
						</div>
						<div class="modal-body">
							<p class="alert alert-danger">ATTENTION: about {{ count($isDrugExpiring) }} drugs are expiring in less than a month time</p>
							<a href="{{ url('checkExpiring') }}" class="btn btn-primary"><i class="fa fa-eye"></i> click here to view expiring drugs</a>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
			@endif


	</div>
</div>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>
@endsection