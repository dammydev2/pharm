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
            <div class="panel-heading">Department Stock Report</div>
            <div class="panel-body">

                <form method="post" action="{{ url('/checkDeptStockReport') }}">
                    {{ csrf_field() }}

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="">Department</label>
                        <select name="department" class="form-control" id="">
                            @foreach($departments as $department)
                            <option>{{ $department->collecting_unit }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control">
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