@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="panel panel-primary col-sm-4">
            <div class="panel-heading">Report</div>
            <div class="panel-body">
                
                <form method="post" action="{{ url('/checkreport') }}">
                    {{ csrf_field() }}

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif

                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Statistics Type</label>
                        <select name="stat" class="form-control">
                            <option>Select Type</option>
                            <option value="nil">Non NHIS</option>
                            <option value="nhis">NHIS</option>
                            <option value="Unclaimed waiver">Unclaimed waiver</option>
                            <option value="retainership">Retainership</option>
                        </select>
                    </div>

                    <input type="submit" name="submit" value="view" class="btn btn-primary">

                </form>

            </div>
        </div>


    </div>
</div>
@endsection
