@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <div class="panel panel-primary col-sm-11">
            <div class="panel-heading">Audit</div>
            <div class="panel-body">

                <form action="{{ url('enterAudit') }}" method="post">
                    @csrf
                    @foreach($allDrugs as $drug)
                    <div class="col-md-12">

                        <div class="form-group col-md-4">
                            <label for="">name</label>
                            <input type="text" name="name[]" class="form-control" readonly value="{{ $drug->name }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="">currently at hand</label>
                            <input type="number" readonly name="currently_at_hand[]" required class="form-control" value="{{ $drug->qtyonhand }}">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="">folio No.</label>
                            <input type="text" name="folio_no[]" readonly class="form-control" value="{{ $drug->folio_no }}">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="">cost price</label>
                            <input type="text" name="cost_price[]" readonly class="form-control" value="{{ $drug->cprice }}">
                        </div>

                        <div class="form-group col-md-1">
                            <label for="">at hand</label>
                            <input type="number" required name="at_hand[]" class="form-control" value="">
                        </div>


                    </div>
                    @endforeach

                    <input type="submit" class="btn btn-primary">

                </form>


            </div>
        </div>


    </div>
</div>
@endsection