@extends('layouts.master')
@section('pageTitle', 'agent')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Edit Profile') }}</h5>
                    </div>
                    <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                        <div class="card-body">
                                @csrf
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}">
                                </div>
    
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label>{{ __('Email address') }}</label>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
    
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Password') }}</h5>
                    </div>
                    <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                        <div class="card-body">
                            @csrf
    
                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                <label>{{ __('Current Password') }}</label>
                                <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                @if($errors->any('old_password'))
                                    <span class="small">
                                        {{ $errors->first('old_password') }}
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label>{{ __('New Password') }}</label>
                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                @if($errors->any('password'))
                                    <span class="small">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ __('Confirm New Password') }}</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                @if($errors->any('password_confirmation'))
                                    <span class="small">
                                        {{ $errors->first('password_confirmation') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        
    </div>
</div>

@endsection