@extends('layouts.master')
@section('pageTitle', 'Owner')
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
                            <a href="{{ URL::to('owner/create') }}" class="btn btn-success btn-sm">
                                Add new Owner
                            </a>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <h3>Owners</h3>
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
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Shares</th>
                                <th>Net Worth</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($owners as $owner)
                            <tr>
                                <td>{{ $owner->name }} </td>
                                <td>{{ $owner->phone_no }} </td>
                                <td>{{ $owner->share }}%</td>
                                <td>Rs. {{ $owner->net_worth }} </td>
                                <td>
                                    <a href="{{ URL::to('/owner/edit', $owner->id) }} " class="btn btn-dark btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <!-- <a href="{{ URL::to('/owner/delete', $owner->id)}} " class="btn btn-danger btn-sm">Delete</a> -->
                                </td>
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
