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
                            <form action="{{ URL::to('/owner/submit') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" >
                                        @if($errors->any('name'))
                                        <span class="small red">
                                            {{ $errors->first('name') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Phone No</label>
                                        <input type="text" name="phone_no" class="form-control" >
                                        @if($errors->any('phone_no'))
                                        <span class="small red">
                                            {{ $errors->first('phone_no') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Share</label>
                                        <input type="text" name="share" class="form-control">
                                        @if($errors->any('share'))
                                        <span class="small red">
                                            {{ $errors->first('share') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Net Worth</label>
                                        <input type="text" name="net_worth" class="form-control">
                                        @if($errors->any('net_worth'))
                                        <span class="small red">
                                            {{ $errors->first('net_worth') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Address</label>
                                        <textarea rows="4" name="address" class="form-control"></textarea>
                                        @if($errors->any('address'))
                                        <span class="small red">
                                            {{ $errors->first('address') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
        
                                <button type="submit" class="btn btn-success">
                                    Add new Owner
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
