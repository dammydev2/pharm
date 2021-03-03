@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-sm-10">
    		<div class="panel-heading">Edit worker</div>
    		<div class="panel-body">

                <div class="register-box">


                    <div class="register-box-body">
                        <p class="login-box-msg">Edit Worker</p>

                        <form method="post" action="{{ url('/updateworker') }}">

                            {!! csrf_field() !!}

                            @foreach($data as $row)

                            <input type="hidden" name="id" value="{{ $row->id }}">

                            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name" value="{{ $row->name }}" placeholder="Full Name">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" class="form-control" name="email" value="{{ $row->email }}" placeholder="Email">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            @endforeach

                            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Member type</label>
                                <select class="form-control" name="type">
                                    <option value="store">Main Store</option>
                                    <option value="substore">SubStore</option>
                                    <option value="sales">Sales/Dispensory</option>
                                    <option value="payment">Payment</option>
                                    <option value="substore">Ijoga Orile</option>
                                    <option value="In-patient">In-patient</option>
                                    <option value="substore">Cardio Unit</option>
                                    <option value="substore">4-Wing Block</option>
                                    <option value="substore">ETR</option>
                                    <option value="price autenticator">Price Autenticator</option>
                                </select>
                            </div>

                            <div class="row">

                                <!-- /.col -->
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <!--<a href="{{ url('/login') }}" class="text-center">I already have a membership</a>-->
                    </div>
                    <!-- /.form-box -->
                </div>
                <!-- /.register-box -->


                

            </div>
        </div>


    </div>
</div>
@endsection
