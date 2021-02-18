@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <div class="panel panel-primary col-sm-11">
            <div class="panel-heading">Monthly COnsumptions Report</div>
            <div class="panel-body">

                <?php $dates = Session::get('dates') ?>

                
<?php

$bankTotals[] = array();
foreach($consumptions as $amount)
{
  $bankTotals[$amount['name']] += $amount['amount'];
}

?>
                

            </div>
        </div>


    </div>
</div>

<style>
    .space {
        height: 170px;
    }

    .text-underline {
        border-bottom: 3px double #000000;
    }

    .badge{
        font-size: 20px;
    }
</style>
@endsection