@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <div class="panel panel-primary col-sm-10">
            <div class="panel-heading">Expiring Drug</div>
            <div class="panel-body">

                <h3>The following drugs will be expiring in less than a month time</h3>
                <p class="text-danger">Enter the current quantity at hand and <b>0 (zero)</b> if the drugs with the batch No. has finished</p>

                <form action="{{ url('updateExpiring') }}" method="post">
                    @csrf
                    @foreach($expiringDrugs as $expiringDrug)
                    <div class="col-md-12">

                    

                        <div class="form-group col-md-2">
                            <label for="">name</label>
                            <input type="text" name="name[]" class="form-control" readonly value="{{ $expiringDrug->name }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label class="text-danger" for="">Insert Qty. at hand</label>
                            <input type="number" name="currently_at_hand[]" required class="form-control" value="{{ $expiringDrug->currently_at_hand }}">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="">expire date</label>
                            <input type="text" name="expire_date[]" readonly class="form-control" value="{{ $expiringDrug->exp }}">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="">batch No.</label>
                            <input type="text" name="batch_no[]" readonly class="form-control" value="{{ $expiringDrug->batch_no }}">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="">folio No.</label>
                            <input type="text" name="folio_no[]" readonly class="form-control" value="{{ $expiringDrug->store->folio_no }}">
                        </div>

                        <input type="hidden" name="id[]" value="{{ $expiringDrug->id }}">

                    </div>
                    @endforeach

                    <input type="submit" class="btn btn-primary">

                </form>


            </div>
        </div>


    </div>
</div>
@endsection