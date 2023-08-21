<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;


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
        return view('item.itemTable');
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
