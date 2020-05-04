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
                            <h3>Provider</h3>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/provider') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ URL::to('/provider/submit') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                                @if($errors->any('name'))
                                <span class="small red">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <input type="text" name="phone_no" class="form-control">
                                @if($errors->any('phone_no'))
                                <span class="small red">
                                    {{ $errors->first('phone_no') }}
                                </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea name="address" class="form-control"></textarea>
                            @if($errors->any('address'))
                            <span class="small red">
                                {{ $errors->first('address') }}
                            </span>
                            @endif
                        </div>
                        <button type="submit" onclick="allLetter(document.form1.text1)"  class="btn btn-success">
                            Add new Provider
                        </button>

                    </form>
                </div>
            </div>
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
