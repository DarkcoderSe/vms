@extends('layouts.master')
@section('pageTitle', 'Customer')
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
    
    @media print{
        .noPrint{display:none}
        .print{
            display: contents;
        }
    }
</style>
@endpush
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header noPrint">
                    <div class="row">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <h3>Ugrai Record of {{ $customer->name }} </h3>
                        </div>
                        <div class="col-md-4">
                            
                            <a href="{{ URL::to('/customer/') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 noPrint">
                            <form action="{{ URL::to('/customer/update') }}" method="post">
                                @csrf
                                <input type="hidden" name="customerId" value="{{ $customer->id}} ">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $customer->name }}">
                                        @if($errors->any('name'))
                                        <span class="small red">
                                            {{ $errors->first('name') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Phone No</label>
                                        <input type="text" name="phone_no" class="form-control" value="{{ $customer->phone_no }}">
                                        @if($errors->any('phone_no'))
                                        <span class="small red">
                                            {{ $errors->first('phone_no') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>New Paid Ammount</label>
                                        <input type="text" name="new_paid_ammount" class="form-control">
                                        @if($errors->any('new_paid_ammount'))
                                        <span class="small red">
                                            {{ $errors->first('new_paid_ammount') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Total Dues</label>
                                        <input type="text" class="form-control" value="{{ $customer->total_dues }}" disabled>
                                        
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Description</label>
                                        <textarea rows="4" name="description" class="form-control">{{ $customer->description }}</textarea>
                                        @if($errors->any('description'))
                                        <span class="small red">
                                            {{ $errors->first('description') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
        
                                <button type="submit" class="btn btn-success">
                                    Update Ugrai Record
                                </button>
        
                            </form>
                        </div>
                      
                        <div class="col-md-6 table-wrapper-scroll-y scroll-table printer">
                            @if($customer->UgraiBook->count() > 0)
                            <table class="table-striped" style="width: 100%;" border="1">
                                <thead>
                                    <tr class="bg-dark text-light">
                                         <th>Customer Name</th>
                                        <th>Total Dues</th>
                                        <th>New Paid Ammount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php 
                                    $ugraiRecords = $customer->UgraiBook->sortByDesc('created_at');
                                @endphp
                                @foreach($ugraiRecords as $ugraiRecord)
                                    <tr>
                                        <td>{{  $customer->name }} </td>
                                        <td>{{ $ugraiRecord->total_dues }} </td>
                                        <td>{{ $ugraiRecord->new_paid_ammount }} </td>
                                        <td>{{ $ugraiRecord->created_at }} </td>
                                    </tr>
                                @endforeach
                                
                                </tbody>
                            </table>
                            @endif
                            <button onclick="window.print()" style="margin-top:5px;"class="btn noPrint btn-sm btn-success">Print</button>
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
