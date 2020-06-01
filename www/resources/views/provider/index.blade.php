@extends('layouts.master')
@section('pageTitle', 'Provider')
@section('content')
<div class="container">
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
            a {
                 text-decoration: none !important;
                 color: white;
}
            .button {
                    background-color: #2978D2; /* Green */
                    border: none;
                    border-radius: 4px;
                    color: white;
                    padding: 5px 10px;
                    width:120px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    cursor: pointer; 
                    transition-duration: 0.5s;
            }
            .button:hover {
                    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
                    text-decoration: none;
                    background-color: #4CAF50;
                    padding: 6px 12px;  
                }
        </style>
    @endpush
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <a  href="{{ URL::to('/provider/create') }} " class="btn btn-success btn-sm">
                                Create new record
                            </a>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <h3>Provider</h3>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/home') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="providerTable">
                        <thead>
                            <tr>
                                <th>Provider ID</th>
                                <th>Brand Name</th>
                                <th>Provider Name</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($providers as $provider)
                            <tr>
                                <td>{{ $provider->id }} </td>
                                <td>{{ $provider->tradeMark->marka_name}} </td>
                                <td><a  href="{{ URL::to('/provider/edit', $provider->id) }} "><button class="button"> {{ $provider->name }}</button> </a></td>
                                <td>{{ $provider->phone_no }} </td>
                                <td>{{ $provider->address }} </td>
                                <td>
                                    <a href="{{ URL::to('/provider/bikri', $provider->id) }} " class="btn btn-primary btn-sm">
                                        <i class="fas fa-book"></i>&nbsp; Bikri Record <br/>
                                    </a>
                                    <a href="{{ URL::to('/provider/delete', $provider->id) }} " class="btn btn-danger btn-sm">Delete</a>
                                </td>
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $providers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#providerTable').DataTable();
        });
    </script>
@endpush
@endsection
