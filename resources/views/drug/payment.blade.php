@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="panel panel-primary col-sm-4">
            <div class="panel-heading">Payment</div>
            <div class="panel-body">
                
                <form method="post" action="{{ url('/searchrec') }}">
                    {{ csrf_field() }}

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif

                    @if(Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                    <div class="form-group">
                        <label>Receipt Number</label>
                        <input type="num" name="rec" class="form-control">
                    </div>

                    <input type="submit" name="submit" value="Search" class="btn btn-primary">

                </form>

            </div>
        </div>


    </div>
</div>
@endsection
