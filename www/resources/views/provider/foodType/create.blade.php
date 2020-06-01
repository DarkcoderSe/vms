@extends('layouts.master')
@section('pageTitle', 'Food Type')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <h3>Product Detail</h3>
                        </div>
                        <div class="col-md-4">
                            
                            <a href="{{ URL::to('/provider') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ URL::to('/provider/tradeMark/foodType/submit') }}" method="post">
                        @csrf
                        <input type="hidden" name="trade_mark_id" value="{{ $tradeMarkId}} ">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Serial. No</label>
                                <input type="text" name="serial_no" class="form-control">
                                @if($errors->any('serial_no'))
                                <span class="small red">
                                    {{ $errors->first('serial_no') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Price Per Crate </label>
                                <input type="text" name="price_per_crate" class="form-control">
                                @if($errors->any('price_per_crate'))
                                <span class="small red">
                                    {{ $errors->first('price_per_crate') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Total Quantity</label>
                                    <input type="text" name="total_quantity" class="form-control">
                                    @if($errors->any('total_quantity'))
                                    <span class="small red">
                                        {{ $errors->first('total_quantity') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Remaining Quantity</label>
                                    <input type="text" name="remaining_quantity" class="form-control">
                                    @if($errors->any('remaining_quantity'))
                                    <span class="small red">
                                        {{ $errors->first('remaining_quantity') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <button type="submit" class="btn btn-success">
                            Add new Product
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
