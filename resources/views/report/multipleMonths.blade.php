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
            <div class="panel-heading">Multiple Months Consumption</div>
            <div class="panel-body">

                <form method="post" action="{{ url('/checkMultipleReport') }}">
                    {{ csrf_field() }}

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif

                    <div class="form-group">
                        <label>Start Month</label>
                        <select name="start_month" class="form-control" id="">
                            <option value="">Select month</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>End Month</label>
                        <select name="end_month" class="form-control" id="">
                            <option value="">Select month</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Year</label>
                        <select name="year" class="form-control" id="">
                            <option value="">select year</option>
                            @php
                            $year = date('Y');
                            $i= $year+1;
                            $j = $year - 3;
                            while($i>$j)
                            {
                            $i--;
                            echo "<option>".$i."</option>";
                            }
                            @endphp
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
        height: 120px;
    }
</style>
@endsection