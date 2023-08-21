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
        })

          
    })
    </script>
@endsection