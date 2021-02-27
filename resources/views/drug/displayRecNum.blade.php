@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="panel panel-primary col-sm-8">
            <div class="panel-heading">Receipt Number</div>
            <div class="panel-body">

                <h3><b><i>Total: &#8358; {{ number_format($data->sprice,2) }}</i></b></h3>
                <h3><b><i>Receipt Number:  {{ $data->rec }}</i></b></h3>

            </div>




        </div>
    </div>


</div>
</div>
@endsection