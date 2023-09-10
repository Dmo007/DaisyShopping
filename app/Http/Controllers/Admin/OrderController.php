<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;




class OrderController extends Controller
{
    public function index(){
        $status=request('status');
        $orders=Order::all();
        $voucherNoGroup=$orders->groupBy('voucherNo')->toArray();
        // dd($voucherNoGroup)
        foreach($voucherNoGroup as $group){
            $orderIDs=array_column($group,'id');
            // var_dump($orderIDs);
            $orderWithUser[]=Order::with('user')->whereIn('id',$orderIDs)->where('status',$status)->first();
        }
        return view('admin.orders.index',compact('orderWithUser'));
    }

    public function detail($voucherNo){
        $orders=Order::where('voucherNo',$voucherNo)->get();
        $ordersFirst=Order::where('voucherNo',$voucherNo)->first();
        return view('admin.orders.detail',compact('orders','ordersFirst'));
    }

    public function status(Request $request,$voucherNo){
        // dd($request,$voucherNo);
        Order::where('voucherNo',$voucherNo)->update(['status'=>$request->status]);
        return redirect()->route('backend.orders.index');
    }

    public function orderAccept(){
        $orders=Order::all();
        $voucherNoGroup=$orders->groupBy('voucherNo')->toArray();
        // dd($voucherNoGroup)
        foreach($voucherNoGroup as $group){
            $orderIDs=array_column($group,'id');
            // var_dump($orderIDs);
            $orderWithUser[]=Order::with('user')->whereIn('id',$orderIDs)->where('status','Accept')->first();
        }
        return view('admin.orders.index',compact('orderWithUser'));
    }
}
