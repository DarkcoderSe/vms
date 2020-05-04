@extends('layouts.master')
@section('pageTitle', 'Bikri')
@section('content')
@push('style')
<style>
    th, td{
        padding-left: 5px;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css">
@endpush
<div class="container">
    <div class="row justify-content-center ml-1 mr-1">
        <div class="col-md-12">
            @if(!is_null($bikriRecord))
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            
                        </div>
                        <div class="col-md-8" style="text-align: center;">
                            <h3>Pending Payment of {{ $provider->name }}</h3>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ URL::to('/provider') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ URL::to('/provider/bikri/submit') }} " method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $bikriRecord->id }} ">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Kham Bikri </label>
                                <input id="kham_bikri" class="form-control" type="text" value="{{ $bikriRecord->kham_bikri }}" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label >Comission (%) </label>
                                <input id="comission" class="form-control" type="text" name="comission" value="{{ $bikriRecord->comission }}" required>
                            </div>
                            <div class="form-group col-md">
                                <label >Minhai (Rs.)</label>
                                <input id="minhai" class="form-control" type="text" name="minhai" value="{{ $bikriRecord->minhai }}">
                            </div>
                            <div class="form-group col-md">
                                <label >Mazdori (Rs.)</label>
                                <input id="mazdori" class="form-control" type="text" name="mazdori" value="{{ $bikriRecord->mazdori }}">
                            </div>
                            <div class="form-group col-md">
                                <label >Karaya (Rs.)</label>
                                <input id="karaya" class="form-control" type="text" name="karaya" value="{{ $bikriRecord->karaya }}">
                            </div>
                            <div class="form-group col-md">
                                <label >Daak (Rs.)</label>
                                <input id="daak" class="form-control" type="text" name="daak" value="{{ $bikriRecord->daak }}">
                            </div>
                            <div class="form-group col-md">
                                <label >Store (Rs.)</label>
                                <input id="store" class="form-control" type="text" name="store" value="{{ $bikriRecord->store }}">
                            </div>
                            <div class="form-group col-md pt-2">
                                <button class="btn btn-primary btn-block mt-4" id="btnCalculate" type="button">
                                    Calculate Safi
                                </button>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="safi_bikri">Safi Bikri</label>
                                <input id="safi_bikri" class="form-control" type="text" name="safi_bikri" disabled>
                                @php 
                                    $totalCrates = 0;
                                    $unSoldCrates = 0;
                                    foreach($provider->TradeMark->FoodTypes as $foodType){
                                        $unSoldCrates += $foodType->remaining_quantity;
                                        $totalCrates += $foodType->total_quantity; 
                                    }
                                @endphp 
                                @if(($totalCrates - $unSoldCrates) == $totalCrates)
                                    <span class="small text-success">
                                        All Crates sold
                                    </span>
                                @else 
                                <span class="small text-danger">
                                    <b>*This safi bikri total is for {{ $totalCrates - $unSoldCrates}} Crates, {{ $unSoldCrates }} Crates remaing unsold out of {{ $totalCrates }}*</b>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label >Description</label>
                                <input class="form-control" type="text" name="description" >
                            </div>
                        </div>
                        <div class="form-check ml-2">
                            <input class="form-check-input" type="checkbox" name="isPaid">
                            <label class="form-check-label">Paid</label>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">
                            Save Bikri Record
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center ml-1 mr-1">
        <div class="col-md-12">
            <h4 style="font-style: capitalize;">{{ $provider->name }}'s Bikri Histroy </h4>
            <table class="table-striped" border="1" style="width: 100%;">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>
                                Kham Bikri
                            </th>
                            <th>Comission </th>
                            <th>Minhai </th>
                            <th>Karaya </th>
                            <th>Mazdori</th>
                            <th>Daak </th>
                            <th>Store </th>
                            <th>Safi Bikri </th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bikriRecords as $bikri)
                        <tr>
                            <td>Rs. {{ $bikri->kham_bikri }} </td>
                            <td>{{ $bikri->comission }}%</td>
                            <td>Rs. {{ $bikri->minhai }} </td>
                            <td>Rs. {{ $bikri->karaya }} </td>
                            <td>Rs. {{ $bikri->mazdori }} </td>
                            <td>Rs. {{ $bikri->daak }} </td>
                            <td>Rs. {{ $bikri->store }} </td>
                            <td>Rs. {{ $bikri->safi_bikri }} </td>
                            <td class="text-success">{!! $bikri->is_paid ? '<span class="text-success">Paid</span>' : '<span class="text-danger">Not Paid</span>' !!} </td>
        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    
</div>
@push('script')
<script src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#bikriTable').DataTable();

        let kham_bikri = $('#kham_bikri').val();
        let comission = $('#comission').val();
        $('#safi_bikri').val(kham_bikri - ((kham_bikri/100)*comission));

        $('#comission').on('keyup', function(){
            let kham_bikri = $('#kham_bikri').val();
            let comission = $('#comission').val();
            $('#safi_bikri').val(kham_bikri - ((kham_bikri/100)*comission));
        });

        $('#btnCalculate').on('click', function(){
            let total = $('#safi_bikri').val();

            total = total - $('#minhai').val();
            total = total - $('#mazdori').val();
            total = total - $('#karaya').val();
            total = total - $('#daak').val();
            total = total - $('#store').val();


            $('#safi_bikri').val(total).val();
        });
    });


</script>
@endpush
@endsection
