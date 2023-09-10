@extends('layouts.admin')
@section('content')

<main class="my-5">
    <div class="container-fluid px-4">
        <div class="mb-3">
        <h4 class="d-inline text-secondary">Order Detail</h4>
        <a href="" class="btn btn-primary float-end">Add Item</a>
        </div>
        <div class="card mb-4">
           
            <div class="card-body">
                <h3 class="text-center">Daisy Shopping</h3>
                <div class="row">
                        <div class="col-md-6">
                            <p>Name - {{$ordersFirst->user->name}}</p>
                            <p>Phone - {{$ordersFirst->user->phone_no}}</p>
                            <p>VoucherNo - {{$ordersFirst->voucherNo}}</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Date - {{$ordersFirst->created_at->format('M d Y')}}</p>
                            <p>Payment Method - {{$ordersFirst->payment->name}}</p>
                            <p>Address - {{$ordersFirst->user->address}}</p>
                        </div>

                    </div>                    
                <table id="" class="table table-bordered">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Qty</th>
                            <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i=1;
                            $total=0;
                        @endphp
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$order->item->name}}</td>
                            <td>{{$order->item->price}} MMK</td>
                            <td>{{$order->item->discount}} %</td>
                            <td>{{$order->qty}}</td>
                            <td>{{$order->qty * ($order->item->price - ($order->item->discount/100 * $order->item->price))}} MMK</td>
                        </tr>
                        @php
                            $total+=$order->qty * ($order->item->price - ($order->item->discount/100 * $order->item->price))
                        @endphp
                        @endforeach
                            <tr>
                                <td colspan="5" class="text-center">Total</td>
                                <td>{{$total}} MMK</td>
                            </tr>
                      </tbody>
                </table>
                <div class="row">
                    <div class="offset-md-4 col-md-4">
                        <img src="{{$ordersFirst->paymentSlip}}" alt="" class="img-fluid">
                    </div>
                    <form action="{{route('backend.orders.status',$ordersFirst->voucherNo)}}" method="post" class="d-grid my-3 gap-2">
                        @csrf
                        {{method_field('put')}}
                        @if($ordersFirst->status == 'Pending')
                        <input type="hidden" name="status" value="Accept">
                        <button class="btn btn-primary" type="submit">Order Accept</button>
                        @elseif($ordersFirst->status == 'Accept')
                        <input type="hidden" name="status" value="Complete">
                        <button class="btn btn-success" type="submit">Order Complete</button>
                        @else

                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</main>


@endsection