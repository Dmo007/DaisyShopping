<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\User;

class RouteController extends Controller
{
    //get item list 

    public function itemList(){
        $items=Item::get();
        return response()->json($items,200);
    }

    //get category and user list
    public function categoryList(){
        $categories=Category::get();
        $users=User::get();
        $data=[
            'categories'=>$categories,
            'users'=>$users

        ];
        return response()->json($data,200);
    }

    //create category 
    public function createCategroy(Request $request){
        
            $data=[
                'name'=> $request->name,
                'photo'=>$request->photo
            ];

            $response=Category::create($data);
            return response()->json($response,200);
    }

    //create item
    public function createItem(Request $request){
        $duck=[
            'codeNo'=>$request->codeNo,
            'name'=>$request->name,
            'image'=>$request->image,
            'price'=>$request->price,
            'description'=>$request->description,
            'discount'=>$request->discount,
            'instock'=>$request->instock,
            'category_id'=>$request->category_id,

        ];
        $spoon=Item::create($duck);
        return response()->json($spoon,200);
    }

    //delete category with post method
    public function deleteItem(Request $request){

        $data=Item::where('codeNo',$request->codeNo)->first();
        if(isset($data)){

            $data=Item::where('codeNo',$request->codeNo)->delete();
            return response()->json(['message'=>'delete success'],200);
            
        }else{
            return response()->json(['message'=>'this item_id is invalid'],200);

        }
    }

      //delete category with get method
      public function deleteItemGet($id){
        $data=Item::where('id',$id)->first();
        if(isset($data)){
            Item::where('id',$id)->delete();
            return response()->json(['message'=>'delete success'],200);
        }else{
            return response()->json(['message'=>'this item_id is invalid'],200);

        }
    }

    //delete category with get method
    public function deleteCategoryGet($id){
        $data=Category::where('id',$id)->first();
        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['message'=>'delete success','deleted data'=>$data],200);
        }else{
            return response()->json(['message'=>'this category_id is invalid'],200);
        }
    }


}
