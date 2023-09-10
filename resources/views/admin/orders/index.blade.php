@extends('layouts.admin')
@section('content')


<main class="my-5">
    <div class="container-fluid px-4">
        <div>
        <h1 class="mt-4 d-inline">Items</h1>
        <a href="{{route('backend.orders.index',['status'=>'Complete'])}}" class="btn btn-success float-end">Order Complete</a>
        <a href="{{route('backend.orders.index',['status'=>'Accept'])}}" class="btn btn-primary float-end mx-2">Order Accept</a>
        <a href="{{route('backend.orders.index',['status'=>'Pending'])}}" class="btn btn-danger float-end mx-2">Order Pending</a>


        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Item Lists
                
            </div>
            <div class="card-body">
                <table id="" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>VoucherNo</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>VoucherNo</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="item_tbody">
                        @foreach($orderWithUser as $order)
                        @if($order !== null)
                        <tr>
                            <td>{{$order->voucherNo}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->payment->name}}</td>
                            <td>
                                <a href="{{route('backend.orders.detail',$order->voucherNo)}}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection