@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		{{ Session::get('password') }}
		{{ Session::get('email') }}

		@php

		//DB::table('users')->join('groups', 'users.group_id', '=', 'groups.id')->get();

		$Date =  date('Y-m-d');
		$dt = date('Y-m-d', strtotime($Date. ' + 7 days'));
		$data = DB::table('newstocks')->where('exp', '<=', $dt)->get();


		@endphp
		<!--<div class="alert alert-danger">
			@foreach($data as $row)
			The following drugs will be expiring in the next 7 days
			{{ $row->name }}<br>

			@endforeach
		</div>-->
	</div>
</div>
@endsection
