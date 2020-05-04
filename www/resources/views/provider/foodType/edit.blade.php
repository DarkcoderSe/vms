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
                            <h3>Food Types Modify</h3>
                        </div>
                        <div class="col-md-4">
                            @php 
                                $providerId = $foodType->TradeMark->Provider->id;
                            @endphp
                            <a href="{{ URL::to('/provider/edit', $providerId) }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ URL::to('/provider/tradeMark/foodType/update') }}" method="post">
                        @csrf
                        <input type="hidden" name="foodTypeId" value="{{ $foodType->id}} ">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Serial. No</label>
                                <input type="text" name="serial_no" class="form-control" value="{{ $foodType->serial_no }}">
                                @if($errors->any('serial_no'))
                                <span class="small red">
                                    {{ $errors->first('serial_no') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Price Per Crate </label>
                                <input type="text" name="price_per_crate" class="form-control" value="{{ $foodType->price_per_crate }}">
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
                                <input type="text" name="total_quantity" class="form-control" value="{{ $foodType->total_quantity }}">
                                @if($errors->any('total_quantity'))
                                <span class="small red">
                                    {{ $errors->first('total_quantity') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Remaining Quantity</label>
                                <input type="text" name="remaining_quantity" class="form-control" value="{{ $foodType->remaining_quantity }}">
                                @if($errors->any('remaining_quantity'))
                                <span class="small red">
                                    {{ $errors->first('remaining_quantity') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Update Food Type
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
