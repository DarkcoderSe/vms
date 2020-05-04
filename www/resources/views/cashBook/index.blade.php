@extends('layouts.master')
@section('pageTitle', 'Cash Book')
@section('content')
@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css">
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            {{-- <a href="{{ URL::to('/cashBook/transaction') }} " class="btn btn-success">
                                Make Daily Transaction
                            </a> --}}
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <h3>Cash Book</h3>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/home') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped " id="customerTable">
                        <thead>
                            <tr>
                                <th>Transaction</th>
                                <th>Ammount (Rs.)</th>
                                <th>Description</th>
                                <th>Date/Time</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cashCols as $cashCol)
                            <tr>
                                <td>
                                    @if($cashCol->transaction_type == 'credited')
                                    <span class="text-success">{{$cashCol->transaction_type}}</span>
                                    @else 
                                    <span class="text-danger">{{$cashCol->transaction_type}}</span>
                                    @endif 
                                </td>
                                <td>Rs. {{ $cashCol->total_ammount }}/- </td>
                                <td>{{ $cashCol->description }} </td>
                                <td>
                                    {{ $cashCol->created_at }}
                                <!-- </td>
                                <td>
                                    <a href="{{ URL::to('/cashBook/delete', $cashCol->id) }} " class="btn btn-danger btn-sm">Delete</a>
                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#customerTable').DataTable();
    });
</script>
@endpush
@endsection
