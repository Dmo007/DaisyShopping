<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items=Item::all();
        $categories=Category::all();
        return view('item.index',compact('items','categories'));
    }

    
    public function cartTable(){
        $payments=Payment::all();
        return view('item.itemTable',compact('payments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function itemCategory(string $category_id){
        
        $item=Item::find($category_id);
        $category=Category::find($category_id);
        $item_category=$item->category_id;
        $itemCollect=Item::where('category_id',$item->category_id)->get();
        return view('item.itemcategory',compact('item','itemCollect'));
    }
    public function show(string $id)
    {
        $item=Item::find($id);
        $item_category=$item->category_id;
        $item_categories=Item::where('category_id',$item->category_id)->get();
        return view('item.detail',compact('item','item_categories'));
    }


    public function orderNow(Request $request){
        // dd($request);
        $dataArr = json_decode($request->input('orderItems'));
        // var_damp($dataArr);
        $date=date('Y-m-d h:i:s');
        $voucherNo =strtotime($date);
        // echo $voucherNo;

        //image upload
        $image=$request->file('paymentSlip');
        $fileName=time().'.'.$image->extension();
        $image->move(public_path('paymentSlip/'),$fileName);

        foreach ($dataArr as $key => $data) {
            $order = new Order();
            $order->voucherNo = $voucherNo;
            $order->qty = $data->qty;
            $order->total=$data->qty * ($data->price -(($data->discount/100)* $data->price));
            $order->status='Pending';
            $order->paymentSlip="/paymentSlip/".$fileName;
            $order->payment_id=$request->input('paymentMethod');
            $order->item_id=$data->id;
            $order->user_id=Auth::id();
            $order->save();
        }
        return 'Order Success';
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
