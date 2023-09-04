<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $categories=Category::create($request->all());
        $fileName=time().'.'.$request->photo->extension(); //$fileName
        $upload=$request->photo->move(public_path('images/'),$fileName);
        if($upload){
            $categories->photo= " /images/ ".$fileName;
        }
        $categories->save();
        return redirect()->route('backend.categories.index');
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
        // $categories=Category::all();
        $category=Category::find($id);
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
         $category=category::find($id);
        $category->update($request->all());

        if($request->hasFile('new_photo')){

            $fileName=time().'.'.$request->new_photo->extension();
            $upload=$request->new_photo->move(public_path('images/'),$fileName);
            if($upload){
                $category->photo= "/images/".$fileName;
            }
        }
        else{
                $category->photo=$request->old_photo;
            }
        $category->save();
        return redirect()->route('backend.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id);
        $category->delete();
        return redirect()->route('backend.categories.index');
    }
}
