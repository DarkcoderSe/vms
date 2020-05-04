@extends('layouts.master')
@section('pageTitle', 'Temp Book')
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
                            <a href="{{ URL::to('/tempBook/create') }} " class="btn btn-success btn-sm">
                                Create new record
                            </a>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <h3>Temp Book</h3>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/home') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="tempTable">
                        <thead>
                            <tr>
                            <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Total Price</th>
                                <th>Paid Ammount</th>
                                <th>Due Ammount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tempBooks as $tempBook)
                            <tr>
                             <td>{{ $tempBook->Customer->id }} </td>
                                <td>{{ $tempBook->Customer->name }} </td>
                                <td>Rs. {{ $tempBook->total_price }} </td>
                                <td>Rs. {{ $tempBook->paid_ammount }} </td>
                                <td>Rs. {{ $tempBook->due_ammount }} </td>
                                <td>{{ $tempBook->created_at }} </td>
                                <th>
                                    <a href="{{ URL::to('/tempBook/edit', $tempBook->id) }} " class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{ URL::to('/tempBook/delete', $tempBook->id) }} " class="btn btn-danger btn-sm">
                                        Delete
                                    </a> 
                                </th>
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
        $('#tempTable').DataTable();
    });
</script>
@endpush
@endsection
