@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-8">
    		<div class="panel-heading">Receipt Number</div>
    		<div class="panel-body">

                <div class="alert alert-success">
                    <h3><b>Receipt Number: {{ Session::get('rec') }}</b></h3>
                    
                    <h3><b><i>Total: &#8358; {{ number_format($data->sprice,2) }}</i></b></h3>

                </div>

                <form method="post" action="{{ url('/entertendered') }}">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" value="{{ $data->name }}" readonly name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>To pay</label>
                        <input type="hiddn" id="a4" readonly value="{{ $data->sprice }}" name="sprice" class="form-control" readonly="">
                    </div>

                    <div class="form-group">
                        <label>Amount tendered</label>
                        <input type="number" id="a1" onkeyup="calculate()" name="amount" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Balance</label>
                        <input type="text" name="balance" class="form-control" readonly="" id="a3">
                    </div>

                    
                    <input type="submit" class="btn btn-primary" value="confirm payment" name="">




                   <!-- <input id="a1" type="text" />
<input id="a2" type="text" onkeyup="calculate()"  />
<input id="a3" type="text" name="total_amt" />-->
<script type="text/javascript">
    calculate = function()
{
    var resources = document.getElementById('a1').value;
    var minutes = document.getElementById('a4').value; 
    document.getElementById('a3').value = parseInt(resources)-parseInt(minutes);

   }
   //cecking for nhis %
 check = function()
   {
    var amount = document.getElementById('a2').value; 
    var percent = document.getElementById('percent').value;
    var nhis = parseInt((percent/100) * amount);
   var txt = document.getElementById('a4').value = parseInt(nhis);
   if (percent == 0 ) {
        document.getElementById('a4').value = amount
    }
    //txt.value = topay;
    console.log(nhis)
   } 

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                </form>

    		</div>
    	</div>


    </div>
</div>
@endsection
