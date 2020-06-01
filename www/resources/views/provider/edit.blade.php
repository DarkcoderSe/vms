@extends('layouts.master')
@section('pageTitle', 'Provider')
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
                            <h3>Provider Modify</h3>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/provider') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ URL::to('/provider/update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $provider->id }} ">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $provider->name }}" >
                                @if($errors->any('name'))
                                <span class="small red">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <input type="text" name="phone_no" class="form-control" value="{{ $provider->phone_no }}">
                                @if($errors->any('phone_no'))
                                <span class="small red">
                                    {{ $errors->first('phone_no') }}
                                </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea name="address" class="form-control">{{ $provider->address }} </textarea>
                            @if($errors->any('address'))
                            <span class="small red">
                                {{ $errors->first('address') }}
                            </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">
                            Update Provider
                        </button>

                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>
                                Product for {{ $provider->name }} 
                            </h4>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ URL::to('/provider/tradeMark/update') }} " method="post">
                        @csrf
                        <input type="hidden" name="provider_id" value="{{ $provider->id }} ">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Brand Name</label>
                                <input type="text" name="marka_name" class="form-control" value="{{ is_null($tradeMark)? '': $tradeMark->marka_name }}" >
                                @if($errors->any('marka_name'))
                                <span class="small red">
                                    {{ $errors->first('marka_name') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label>Quantity </label>
                                <input type="text" name="quantity" class="form-control" value="{{ is_null($tradeMark)? '': $tradeMark->quantity }}">
                                @if($errors->any('quantity'))
                                <span class="small red">
                                    {{ $errors->first('quantity') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label>Description </label>
                                <input type="text" name="description" class="form-control" value="{{ is_null($tradeMark)? '': $tradeMark->description }}">
                                @if($errors->any('description'))
                                <span class="small red">
                                    {{ $errors->first('description') }}
                                </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                        @if(!is_null($tradeMark))
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>
                                            Trucks of {{ is_null($tradeMark)? '': $tradeMark->marka_name }}
                                        </h4>
                                    </div>
                                    <div class="col-md-8">
                                        <form action="{{ URL::to('/provider/tradeMark/truck/submit') }} " method="post">
                                            <div class="form-row">
                                                <div class="col-md-9">
                                                        @csrf 
                                                        <input type="hidden" name="trade_mark_id" value="{{ is_null($tradeMark)? '': $tradeMark->id }}">
                                                        <input type="text" name="truck_number" class="form-control" placeholder="Vehicle Number, e.g: PAK 123">
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-success btn-block">Add Vehicle Record</button>
                                                </form>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped m-0">
                                    <thead>
                                        <tr>
                                            <th>
                                                Vehicle number
                                            </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($trucks as $truck)
                                        <tr>
                                            <td>{{ $truck->truck_number }} </td>
                                            <td> 
                                                <a href="{{ URL::to('/provider/tradeMark/truck/delete', $truck->id) }} "onclick="return confirm('Are you sure you want to delete Truck?')"  class="btn btn-danger btn-sm">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                </div>
            </div>

            @if(!is_null($tradeMark))
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Products of {{ is_null($tradeMark) ? '': $tradeMark->marka_name }}</h4>
                        </div>    
                        <div class="col-md-6">
                            <a href="{{ URL::to('/provider/tradeMark/foodType/create', is_null($tradeMark) ? '': $tradeMark->id) }} " class="btn btn-primary" style="float: right;">
                                Add new Product
                            </a>
                        </div>
                    </div>    
                </div> 
                <div class="card-body p-0">
                    @if($tradeMark->FoodTypes->count() > 0)
                    <table class="table table-striped m-0">
                        <thead>
                            <tr>
                                <th>Serial. No.</th>
                                <th>Total Quantity</th>
                                <th>Remaining Quantity</th>
                                <th>Price Per Crate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tradeMark->FoodTypes as $foodType)
                            <tr>
                                <td> {{ $foodType->serial_no }} </td>
                                <td>{{ $foodType->total_quantity }} </td>
                                <td>{{ $foodType->remaining_quantity }} </td>
                                <td>{{ $foodType->price_per_crate }} </td>
                                <td>
                                    <a href="{{ URL::to('/provider/tradeMark/foodType/edit', $foodType->id) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <!-- <a href="{{ URL::to('/provider/tradeMark/foodType/delete', $foodType->id) }} " class="btn btn-danger btn-sm">
                                        Delete
                                    </a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>   
            </div> 
            @endif    
                   
        </div>
    </div>
</div>
@push('script')
<script>
    $(document).ready(function(){
        
    });
</script>
@endpush
@endsection