@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-8">
    		<div class="panel-heading">Receipt Number</div>
    		<div class="panel-body">
                <table class="table table-bordered">
                   <center><h4>FEDERAL MEDICAL CENTER, ABEOKUTA</h4></center>
                   <center><span> Pharmacy</span></center>
                   <center><span><b>Receipt Number: {{ Session::get('rec') }}</b></span></center>
                   @foreach($data2 as $row2)
                   @endforeach
                   <tr>
                       <th colspan="4">Customer: {{ $row2->name }}</th>
                   </tr>
                   <tr>
                       <th>Qty</th>
                       <th>Item</th>
                       <th>Unit Price</th>
                       <th>Amount</th>
                   </tr>

                   <div class="">
                    <?php
                    $total = 0;
                    $cost = 0;
                    foreach ($data as $row) {
                       $amount = $row->sprice * $row->quantity;
                       $cost_price = $row->cprice * $row->quantity;
                       $total += $amount;
                       $cost += $cost_price;
                       ?>

                       <tr>
                           <td>{{ $row->quantity }}</td>
                           <td>{{ $row->name }}</td>
                           <td>{{ $row->sprice }}</td>
                           <td class="text-right">{{ $row->sprice * $row->quantity }}</td>
                       </tr>
                       <?php
                   }
                   ?>
                   <tr>
                       <th class="text-right" colspan="3">Total</th>
                       <th class="text-right">&#8358; {{ number_format($total,2) }}</th>
                   </tr>
                   <tr>
                     <td>NHIS NO: {{ $row2->nhis }}</td>
                     <td colspan="2" class="text-right">NHIS %</td>
                     <td class="text-right">
                       @if($row2->nhis == 'nhis')
                       {{ number_format($row2->sprice,2)}}
                       @endif
                     </td>
                   </tr>
                   <tr>
                     <td colspan="3" class="text-right">Amount Tendered</td>
                     <td class="text-right">{{ number_format($row2->amount,2) }}</td>
                   </tr>
                   <tr>
                     <td colspan="3" class="text-right">Balance</td>
                     <td class="text-right">{{ number_format($row2->balance,2) }}</td>
                   </tr>
                   
               </table>
               <p><b>You have been served by {{ \Auth::User()->name }}</b></p>

           </div>


       </div>
   </div>


</div>
</div>
@endsection
