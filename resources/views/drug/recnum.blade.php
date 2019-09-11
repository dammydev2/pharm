@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-8">
    		<div class="panel-heading">Receipt Number</div>
    		<div class="panel-body">

                <div class="alert alert-success">
                    <h3><b>Receipt Number: {{ Session::get('rec') }}</b></h3>
                    <?php
                    $total = 0;
                    foreach ($data as $row) {
                         $amount = $row->sprice * $row->quantity;
                         $total += $amount;
                    }
                    ?>
                    <h3><b><i>Total: &#8358; {{ number_format($total,2) }}</i></b></h3>
                </div>

    		</div>
    	</div>


    </div>
</div>
@endsection
