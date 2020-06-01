@extends('layouts.master')
@section('pageTitle', 'Agent')
@section('content')
@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                            <h3>Users</h3>
                        </div>
                        <div class="col-md-4">
                        @if (auth()->user()->id == 1)
                            <a href="{{route('create')}}" style="float: right;" class="btn btn-primary btn-sm">
                                Add User
                            </a>
                            @else
                            <a href="{{ URL::to('/home') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped m-0" id="providerTable">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th >Email</th>
                            <th >Created Date</th>
                            @if (auth()->user()->id == 1)
                            <th >Action</th>
                            @endif
                        </thead>        
                        <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->contact }}</td>
                                        <td>
                                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </td>
                                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                        @if (auth()->user()->id == 1)
                                        <td >                                                
                                                        @if ($user->id != 1)
                                                                <a href="{{ URL::to('/agent/delete', $user->id) }} " onclick="return confirm('Are you sure you want to delete Agent?')" class="btn btn-danger btn-sm">
                                                                    Delete
                                                                </a>
                                                                @endif
                                                                @if ($user->id == 1)
                                                                <a class="btn btn-primary btn-sm" style="width: 59px;" href="{{ route('profile.update') }}">{{ __('Edit') }}</a>
                                                                @endif
                                                    
                                                  </div>
                                                        
                                                        </div>
                                                      </div>
                                             
                                         </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
</div>
@push('script')
<script src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script>
    $(document).ready(function(){
        $('#customerTable').DataTable();
    });
</script> -->
@endpush
@endsection


