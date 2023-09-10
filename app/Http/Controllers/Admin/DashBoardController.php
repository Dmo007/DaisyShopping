<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{

    // public function __construct(){
    //     $this->middleware(function($request,$next){
    //         $this->user=Auth::user();
    //         if($this->user->role == 'Super Admin' || $this->user->role == 'Admin'){
    //             return $next($request);
    //         }else{
    //             return back();
    //         }
    //     });
    // }  ဒါတနည်း

    // တိုချင်ရင်

    public function __construct(){
        $this->middleware(function($request,$next){
            if(in_array(Auth::user()->role,['Super Admin','Admin'])){
                return $next($request);
            }else{
                return back();
            }
        });
    }


    public function index(){
        $users=User::all();
        return view('admin.index',compact('users'));
    }
}
