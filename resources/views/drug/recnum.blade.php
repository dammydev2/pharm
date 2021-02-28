@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="panel panel-primary col-sm-8">
            <div class="panel-heading">Customer Details</div>
            <div class="panel-body">

                <!-- <div class="alert alert-success">
                    <h3><b>Receipt Number: {{ Session::get('rec') }}</b></h3>
                    <?php
                    $total = 0;
                    foreach ($data as $row) {
                        $amount = $row->sprice * $row->quantity;
                        $total += $amount;
                    }
                    ?>
                    <h3><b><i>Total: &#8358; {{ number_format($total,2) }}</i></b></h3>
                </div> -->

                <?php
                $total = 0;
                $cost = 0;
                foreach ($data as $row) {
                    $amount = $row->sprice * $row->quantity;
                    $cost_price = $row->cprice * $row->quantity;
                    $total += $amount;
                    $cost += $cost_price;
                }
                ?>
                <h3><b><i>Total: &#8358; {{ number_format($total,2) }}</i></b></h3>

            </div>

            <form method="post" action="{{ url('/enterDetails') }}">

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
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label>NHIS %</label>
                    <input type="number" required onkeyup="check()" id="percent" name="percent" class="form-control">
                </div>

                <div class="form-group">
                    <label>NHIS no</label>
                    <input type="text" name="nhisno" class="form-control">
                </div>

                <div class="form-group">
                    <label>To pay</label>
                    <input type="hiddn" id="a4" name="sprice" class="form-control" readonly="">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" id="">
                        <option>normal</option>
                        <option>Unclaimed waiver</option>
                        <option>waiver</option>
                        <option>retainership</option>
                        <option>ward supply</option>
                    </select>
                </div>

                <input type="hidden" value="0" id="a1" onkeyup="calculate()" name="amount" class="form-control">
                <input type="hidden" name="balance" value="0" class="form-control" readonly="" id="a3">
                <input type="hidden" id="a2" value="{{ $total }}" name="total">
                <input type="hidden" name="cprice" value="{{ $cost }}">

                <input type="submit" class="btn btn-primary" value="confirm payment" name="">


                <script type="text/javascript">
                    calculate = function() {
                        var resources = document.getElementById('a1').value;
                        var minutes = document.getElementById('a4').value;
                        document.getElementById('a3').value = parseInt(resources) - parseInt(minutes);

                    }
                    //cecking for nhis %
                    check = function() {
                        var amount = document.getElementById('a2').value;
                        var percent = document.getElementById('percent').value;
                        var nhis = parseInt((percent / 100) * amount);
                        var txt = document.getElementById('a4').value = parseInt(nhis);
                        if (percent == 0) {
                            document.getElementById('a4').value = amount
                        }
                        //txt.value = topay;
                        console.log(nhis)
                    }
                </script>




        </div>
    </div>


</div>
</div>
@endsection