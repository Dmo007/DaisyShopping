@extends('layouts/frontend')
@section('content')

 <div class="container my-5">
    <h3 class="text-center py-5">Shopping Cart</h3>
    <div class="table-responsive">
        <table class="table-bordered table text-center">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="cartBody">

            </tbody>
        </table>
    </div>
        @guest 
            <a href="/login" class="btn btn-danger w-100">Login</a>
        @else
        <form action="" class="row" id="paymentForm" enctype="mulitpart/form-data">
            @csrf
        
                <div class="col-12 col-md-6">
                    <label for="paymentSlip">Payment Slip</label>
                    <input type="file" name="paymentSlip" id="paymentSlip" class="form-control" accept="image/*">
                </div>
                <div class="col-12 col-md-6">
                    <label for="paymentMethod">Payment Method</label>
                    <select name="paymentMethod" id="paymentMethod" class="form-select">
                        <option value="">Choose Payment Method</option>
                        @foreach($payments as $payment)
                        <option value="{{$payment->id}}">{{$payment->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary my-3" id="orderNow" type="submit">Order Now</button>
        </form>
        @endguest
    <!-- </div> -->
 </div>
<!-- payment modal -->

<div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-success">Your Order is Success</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" href="{{route('item.index')}}">Save</a>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            getData();
            ItemCount();
        function getData(){
        let itemString = localStorage.getItem('DaisyShopping');
        if(itemString){
            let itemArray = JSON.parse(itemString);
            let data = '';
            let total = 0;
            $.each(itemArray, function(i,v){
                let amount =Math.round (v.price - ((v.discount/100)*v.price) );                         
                data += `<tr class="text-center">
                        <td class="w-25"><span><img src="${v.image}" class="img-fluid w-25 h-25"></span></td>
                        <td>${v.name}</td>
                        <td>${v.price} MMK</td>
                        <td>${v.discount}%</td>
                        <td> 
                        <button class="btn btn-outline-secondary min" data-num=${i}>-</button>
                        ${v.qty}
                        <button class="btn btn-outline-secondary max" data-num=${i}>+</button>
                        </td>
                        <td>${v.qty * amount} MMK</td>
                    </tr>`;
                    total += Number(v.qty * amount);
            })        
                data += `<tr>
                        <td colspan="5" class="text-center">Total</td>
                        <td>${total} MMK</td>
                    </tr>`;
                $('#cartBody').html(data);
        }
    }
        // minium counting and delete
        $('#cartBody').on('click','.min',function(){
            let num=$(this).data('num');
            let itemString=localStorage.getItem('DaisyShopping');
            if(itemString){
                let itemArray=JSON.parse(itemString);
                $.each(itemArray,function(i,v){
                    if(num==i){
                        v.qty--;
                    if(v.qty==0){

                        itemArray.splice(num,1);
                    }
                    }
                })
                let itemData=JSON.stringify(itemArray);
                localStorage.setItem('DaisyShopping',itemData);
                getData();
                ItemCount();


            }
        })

        // maxinum counting 

        $('#cartBody').on('click','.max',function(){
            let num=$(this).data('num');
            let itemString=localStorage.getItem('DaisyShopping');
            if(itemString){
                let itemArray=JSON.parse(itemString);
                $.each(itemArray,function(i,v){
                    if(num==i){
                        v.qty++;
                    }
                })
                let itemData=JSON.stringify(itemArray);
                localStorage.setItem('DaisyShopping',itemData);
                getData();
                ItemCount();


            }
        });
        
    })

    // $('#orderNow').click(function(){

    //     let itemString=localStorage.getItem('DaisyShopping');

       

    // $.post("{{route('orderNow')}}",{data:itemString},function(respond){
    //     console.log(respond);
    // });

    // });

        $(document).ready(function(){
            $('#paymentForm').on('submit',function(e){
                e.preventDefault();
                let formData= new FormData(this);
                // console.log(formData);
                let itemString=localStorage.getItem('DaisyShopping');
                formData.append('orderItems',itemString);

                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{route('orderNow')}}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    
                    if(response){
                        $('#orderSuccessModal').modal('show');
                        localStorage.clear();
                    }
                },
                error: function(xhr,status,error){
                    console.log(xhr.responseText);
                }

            })
            })
        })

    </script>
@endsection