@extends('layouts.master')
@section('pageTitle', 'Temp Book')
@section('content')
@push('style')
<style>
    th, td{
        padding-left: 5px; 
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #doPrint, #doPrint * {
            visibility: visible;
            width: 100%;
        }
        #doPrint {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }

</style>
@endpush
<div class="container-fluid">
    <div class="row justify-content-center ml-1">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Items to Cart
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ URL::to('/tempBook/cart/update') }}" method="post">
                        @csrf
                        <input type="hidden" name="tempBookId" value="{{ $tempBook->id }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Marka Name</label>
                                <select id="tradeMarkId" class="custom-select" name="trade_mark_id" required>
                                    <option> -- Select -- </option>
                                    @foreach($tradeMarks as $tradeMark)
                                    <option value="{{ $tradeMark->id }}">{{ $tradeMark->marka_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Serial. No.</label>
                                <select id="foodTypeId" class="custom-select" name="food_type_id" required>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Price Per Crate</label>
                                <input type="text" id="pricePerCrate" name="price_per_crate" value="0" class="form-control" disabled>
                                @if($errors->any('price_per_crate'))
                                <span class="small red">
                                    {{ $errors->first('price_per_crate') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="m-4 pt-3">
                                    <img src="https://1001freedownloads.s3.amazonaws.com/vector/thumb/124882/raemi_Cross_Out.png" alt="X" width="20px">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Quantity</label>
                                <input type="text" name="quantity" id="quantity" value="0" class="form-control">
                                @if($errors->any('quantity'))
                                <span class="small red">
                                    {{ $errors->first('quantity') }}
                                </span>
                                @else 
                                <span class="small">
                                    <span class="text-success" id="remaingQuantity">0</span> Crates remaining..
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="m-4 pt-3">
                                    <img src="https://www.newharbinger.com/sites/default/files/styles/article_image_main/public/article_assets/equal-sign-2-512.png" alt="X" width="25px">
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label>Sub Total</label>
                                <input type="text" id="subTotal" name="sub_total" value="0"  class="form-control" disabled>                                
                            </div>

                        </div>
                        <button class="btn btn-warning" type="submit" style="float: right;">
                            Add to Cart
                        </button>

                    </form>
                </div>
            </div>

            @if($tempBook->paid_ammount <= 0)
            <div class="card">
                <div class="card-header">
                    Temp Book Record
                </div>
                <div class="card-body">
                    <form action="{{ URL::to('/tempBook/update') }} " method="post">
                        @csrf 
                        @php 
                            $total = 0;
                        @endphp 
                        @foreach($cartItems as $item)
                        @php 
                            $total += $item->sub_total;
                        @endphp 
                        @endforeach
                        <input type="hidden" name="tempBookId" value="{{ $tempBook->id }}">
                        <input type="hidden" name="totalAmmount" value="{{ $total }}">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Paid Ammount</label>
                                <input type="text" name="paid_ammount" id="paidAmmount" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block btn-lg">
                            Save
                        </button>
                    </form>
                </div>
            </div>
            @else 
            <button onclick="doPrint();" class="btn btn-success btn-block btn-lg">
                Print
            </button>
            @endif
        </div>
        <div class="col-md-6 col-12">
            <div id="doPrint">
                <div class="card">
                    <div class="card-body">
                        <strong>Customer Name: </strong> {{ $tempBook->Customer->name }}<br>
                        <strong>Contact No: </strong> {{ $tempBook->Customer->phone_no }}
                        @if($tempBook->Customer->total_dues > 0)
                        <h4>Old Dues: Rs. <span class="red">{{ $tempBook->Customer->total_dues }}</span>/- </h4>
                        @endif
                    </div>
                </div>
                <table border="1" style="width:100%;" class="table-striped">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th colspan="6">
                                {{ $tempBook->Customer->name }}'s Cart List
                            </th>
                        </tr>
                        <tr>
                            <th>Marka Name</th>
                            <th>Serial. No.</th>
                            <th>Price Per Crate</th>
                            <th>Quantity</th>
                            <th>Sub Total (Rs.) </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myCartList">
                        @php 
                            $totalCrates = 0;
                            $total = 0;
                        @endphp 
                        @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->FoodType->TradeMark->marka_name }} </td>
                            <td>{{ $item->FoodType->serial_no }} </td>
                            <td>{{ $item->FoodType->price_per_crate }} </td>
                            <td>{{ $item->quantity }} </td>
                            <td>{{ $item->sub_total }} </td>
                            <td>
                                <a role="tooltip" title="Remove this item from list" class="text-danger" href="{{ URL::to('/tempBook/cart/delete', [$item->id, $tempBook->id]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @php 
                            $totalCrates += $item->quantity;
                            $total += $item->sub_total;
                        @endphp 
                        @endforeach
                        <tr>
                            <th colspan="3">Total</th>
                            <th>{{ $totalCrates }} </th>
                            <th colspan="2" id="total">{{ $total }} </th>
                        </tr>
                        <tr>
                            <th colspan="4">Paid Ammount</th>
                            <th colspan="2" id="paidAmmountText">
                                {{ $tempBook->paid_ammount ? $tempBook->paid_ammount : '0' }}
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4">Dues</th>
                            <th colspan="2" id="dues">
                                {{ $tempBook->due_ammount }}
                            </th>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@push('script')
<script>
    function doPrint(){
        window.print();
    }
    $(document).ready(function(){


        $('#tradeMarkId').on('change', function(){
            let tradeMarkId = $('#tradeMarkId').val();
            // console.log(tradeMarkId);
            let url = "{{ URL::to('/provider/tradeMark/foodType/get') }}/"+tradeMarkId;

            $.get(url, function(response){
                let options = "<option value=''>-- Select --</option>";
                for(let i=0; i< response['foodTypes'].length; i++){
                    options += "<option value='"+ response['foodTypes'][i]['id'] +"'>" + response['foodTypes'][i]['serial_no'] +"</option>"
                    
                };
                $("#foodTypeId").html(options);

            });
        });

        $('#foodTypeId').on('change', function(){
            let foodTypeId = $('#foodTypeId').val();
            let url = "{{ URL::to('/provider/tradeMark/foodType/first') }}/"+foodTypeId;

            $.get(url, function(response){
                $('#pricePerCrate').val(response['foodType']['price_per_crate']);
                $('#remaingQuantity').text(response['foodType']['remaining_quantity']);
                
            });

        });

        $('#quantity').on('keyup', function(){
                
            let remainingQuantity = parseInt($('#remaingQuantity').text());
            let quantity = $('#quantity').val();
            
            console.log(quantity);
            
            if(quantity > remainingQuantity){
                $('#quantity').val($('#remaingQuantity').text());
            }

            let pricePerCrate = $('#pricePerCrate').val();
            $('#subTotal').val(pricePerCrate * quantity);
        });

        $('#paidAmmount').on('keyup', function(){
            let paidAmmount = $('#paidAmmount').val();
            let total = parseInt($('#total').text());
            $('#dues').text( total - paidAmmount );
            let oldDues = parseInt($('#oldDues').text());

            $('#paidAmmountText').text(paidAmmount);


        });

        $('#price_per_crate').on('keyup', function(){
            $('#totalPrice').text($('#price_per_crate').val() * $('#crate_sold').val());
        })
        $('#crate_sold').on('keyup', function(){
            $('#totalPrice').text($('#price_per_crate').val() * $('#crate_sold').val());
        })

        $('#paid_ammount').on('keyup', function(){
            let totalPrice = $('#totalPrice').text();
            $('#dueAmmount').text(totalPrice - $('#paid_ammount').val());
        })

    });
</script>
@endpush
@endsection
