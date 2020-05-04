@extends('layouts.master')
@section('pageTitle', 'Temp Book')
@section('content')
@push('style')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endpush
<div class="container-fluid">
    <div class="row justify-content-center ml-1">
        <div class="col-md-2">
            <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>Customer Detail</th>
                    </tr>
                </thead>
                <tbody id="resultCustomer">
                </tbody>
            </table>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <h3>Temp Book</h3>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::to('/tempBook') }} " style="float: right;" class="btn btn-primary btn-sm">
                                Back
                            </a>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ URL::to('/tempBook/submit') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label>Customer Name</label>
                                        <input type="search" id="customerName" name="customer_name" class="form-control">
                                        @if($errors->any('customer_name'))
                                        <span class="small red">
                                            {{ $errors->first('customer_name') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label>Phone Number</label>
                                        <input type="text" id="phoneNo" name="phone_no" class="form-control">
                                        @if($errors->any('phone_no'))
                                        <span class="small red">
                                            {{ $errors->first('phone_no') }}
                                        </span>
                                        @endif
                                    </div>
        
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="description">Description</label>
                                        <textarea id="description" class="form-control" name="description"> </textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    Next
                                </button>
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@push('script')
<script>
    function getCustomer(phoneNo, name){
        $('#phoneNo').val(phoneNo);
        $('#customerName').val(name);
    }
    $(document).ready(function(){
        $("#customerName").on('keyup', function(){
            let customerName = $('#customerName').val();
            let url = "{{ URL::to('/customer/get') }}/"+customerName;

            $.get(url, function(response){
                // console.log(response);
                
                let row = "";
                for(let i=0; i< response['customers'].length; i++){
                    let phoneNo = (response['customers'][i]['phone_no']);
                    let name = response['customers'][i]['name'];
                    let dues = response['customers'][i]['total_dues'];
                    row  
                    // "<tr>"+
                    //             "<td onClick='getCustomer(${phoneNo},${name});'>"+
                    //                 "<b>"+ response['customers'][i]['name'] +"</b><br>"+
                    //                 response['customers'][i]['phone_no'] +"<br>"+
                    //                 "<b>Dues:</b> "+ response['customers'][i]['total_dues']
                    //             "</td>"+
                    //         "</tr>";
                        += `
                             <tr>
                                <td onClick="getCustomer('${phoneNo}', '${name}')">
                                    <b>${name}</b><br>
                                    ${phoneNo}<br>
                                    <b>Dues: </b> ${dues}
                                </td>
                             </tr>       
                            `;
                    
                };
                $("#resultCustomer").html(row);
                
            }); 
        });


        
    });
</script>
@endpush
@endsection
