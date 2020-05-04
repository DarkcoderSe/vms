@extends('layouts.master')
@section('pageTitle', 'Owner')
@section('content')
@push('style')
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

                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <h3>Owner Record </h3>
                        </div>
                        <div class="col-md-4">

                            <a href="{{ URL::to('/owner/') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('calculate_transactions')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $owner->id }} ">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $owner->name }} ">
                                        @if($errors->any('name'))
                                            <span class="small red">
                                            {{ $errors->first('name') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Net Worth</label>
                                        <input type="text" name="net_worth" class="form-control" value="{{ $owner->net_worth }} ">
                                        @if($errors->any('net_worth'))
                                            <span class="small red">
                                            {{ $errors->first('net_worth') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Transaction Description</label>
                                        <input type="text" name="description" class="form-control" value="" placeholder="Enter Description">
                                        @if($errors->any('description'))
                                            <span class="small red">
                                            {{ $errors->first('description') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Expenses</label>
                                        <input type="text" name="expenses" class="form-control" value="" placeholder="Enter Expenses">
                                        @if($errors->any('expenses'))
                                            <span class="small red">
                                            {{ $errors->first('expenses') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    Add Transaction Record
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>



</div>
@endsection
