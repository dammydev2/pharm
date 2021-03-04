@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <div class="col-md-12 space"></div>
        <div class="col-md-4"></div>
        <div class="panel panel-primary col-sm-4">
            <div class="panel-heading">Audit History</div>
            <div class="panel-body">

                <form method="post" action="{{ url('/checkAuditReport') }}">
                    {{ csrf_field() }}

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="">select date</label>
                        <select name="date" class="form-control" id="">
                            @foreach($dates as $date)
                            <option>{{ date_format($date->created_at, "Y-m-d") }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" name="submit" value="view" class="btn btn-primary">

                </form>

            </div>
        </div>


    </div>
</div>
<style>
    .space {
        height: 100px;
    }
</style>
@endsection