<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\PaymentUpdateRequest;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments=Payment::all();
        return view('admin.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payments=Payment::all();
        return view('admin.payments.create',compact('payments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        $payments=Payment::create($request->all());
        $fileName=time().'.'.$request->logo->extension();
        $upload=$request->logo->move(public_path('images/'),$fileName);
        if($upload){
            $payments->logo="/images/".$fileName;
        }
        $payments->save();
        return redirect()->route('backend.payments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment=Payment::find($id);
        return view('admin.payments.edit',compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentUpdateRequest $request, string $id)
    {
   
        $payment=Payment::find($id);
        $payment->update($request->all());
        if($request->hasFile('new_logo')){

            $fileName=time().'.'.$request->new_logo->extension();
            $upload=$request->new_logo->move(public_path('images/'),$fileName);
            if($upload){
                $payment->logo= "/images/". $fileName;
            }
        }
        else{
                $payment->logo=$request->old_logo;
            }
        $payment->save();
        return redirect()->route('backend.payments.index');
    }
   
   
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment=Payment::find($id);
        $payment->delete();
        return redirect()->route('backend.payments.index');
    }
}
