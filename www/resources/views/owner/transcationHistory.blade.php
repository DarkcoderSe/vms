@extends('layouts.master')
@section('pageTitle', 'Owner')
@section('content')

    @push('style')

        <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css">
        <style>
            th, td{
                padding-left: 5px;
            }
            .scroll-table {
                position: relative;
                height: 350px;
                overflow: auto;
            }
            .table-wrapper-scroll-y {
                display: block;
            }
        </style>
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
                                <h3>Transaction History</h3>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('transactionHistory') }} " style="float: right;" class="btn btn-primary btn-sm">
                                    Back
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped " id="customerTable">
                            <thead>
                            <tr>
                                 <th>Owner ID</th>
                                <th>Owner Name</th>
                                <th>Transaction Description</th>
                                <th>Expenses</th>
                                <th>Time</th>
                                <!-- <th>New Net Worth</th> -->
                                {{-- <th>New Net Worth</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactionHistorys as $transactionHistory)
                                <tr>
                                <td>{{$transactionHistory->owner->id}}</td>
                                    <td>{{$transactionHistory->owner->name}}</td>
                                    <td> {{ $transactionHistory->description }} </td>
                                    <td>Rs.{{ $transactionHistory->expenses }} /-</td>
                                    <td> {{ $transactionHistory->created_at }} </td>
                                    <!-- <td>Rs.{{$transactionHistory->owner->net_worth}}/-</td> -->
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
