@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container">
	<div class="row">

		{{ Session::get('password') }}
		{{ Session::get('email') }}



		<?php
		$warning = (time() > strtotime('2023-02-01'));
		$expired = (time() > strtotime('2023-06-01'));
		?>

		@if ($warning)
		<!-- Modal -->
		<div id="warningModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Modal Header</h4>
					</div>
					<div class="modal-body">
						<p>some dependencies will be outdated in less than 3 months. Upgrade for software functionality. contact developer</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>

		@endif


		@if ($expired)
		<!-- Modal -->
		<div id="expireModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
						<h4 class="modal-title">Modal Header</h4>
					</div>
					<div class="modal-body">
						<p>Upgrade needed.</p>
					</div>
					<div class="modal-footer">
						<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
					</div>
				</div>

			</div>
		</div>

		@endif



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
						<p class="alert alert-danger">ATTENTION: about {{ count($isDrugExpiring) }} drugs are expiring in less than 60 days time</p>
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
<!-- expire modal -->
<script type="text/javascript">
	$(window).on('load', function() {
		$('#expireModal').modal('show');
	});
</script>
<!-- warning modal -->
<script type="text/javascript">
	$(window).on('load', function() {
		$('#warningModal').modal('show');
	});
</script>
@endsection