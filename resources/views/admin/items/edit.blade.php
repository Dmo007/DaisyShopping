@extends('layouts.admin')
@section('content')
<!-- @php 
    var_dump($errors);
@endphp -->
<div class="container px-3">
    <div class="card my-5">
        <div class="card-header">
            <h5 class="d-inline">Item  create</h5>
            <a href="{{route('backend.items.index')}}" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="{{route('backend.items.update',$item->id)}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="mb-3">
                    <label for="codeNo" class="form-label ">CodeNo</label>
                    <input type="text" class="form-control {{$errors->has('codeNo') ? 'is-invalid' : ''}}" name="codeNo" value="{{$item->codeNo}}">
                    @if($errors->has('codeNo'))
                        <div class="invalid-feedback">
                            {{$errors->first('codeNo')}}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="ItemName" class="form-label">ItemName</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="ItemName" name="name" placeholder="" value="{{$item->name}}">
                     @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}" id="price" name="price" value="{{$item->price}}">
                     @if($errors->has('price'))
                        <div class="invalid-feedback">
                            {{$errors->first('price')}}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="text" class="form-control {{$errors->has('discount') ? 'is-invalid' : ''}}" id="discount" name="discount" value="{{$item->discount}}">
                     @if($errors->has('discount'))
                        <div class="invalid-feedback">
                            {{$errors->first('discount')}}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category_id" id="category" class="form-control {{$errors->has('category_id') ? 'is-invalid' : ''}}">
                         @if($errors->has('category_id'))
                        <div class="invalid-feedback">
                            {{$errors->first('category_id')}}
                        </div>
                    @endif
                        <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$item->category_id == $category->id ? 'selected' : ''}} >{{$category->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="instock" class="form-label">Instock</label>
                    <input type="number" class="form-control {{$errors->has('instock') ? 'is-invalid' : ''}}" id="instock" name="instock" value="{{$item->instock}}">
                     @if($errors->has('instock'))
                        <div class="invalid-feedback">
                            {{$errors->first('instock')}}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Image</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">New Image</button>
                        </li>
                    </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <img src="{{$item->image}}" alt="" class="img-fluid py-3 w-25">
                                <input type="hidden" name="old_image" value="{{$item->image}}">
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <input class="form-control {{$errors->has('image') ? 'is-invalid' : ''}} my-3" type="file" id="image" name="new_image" accept="image/*">
                                @if($errors->has('image'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('image')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                   
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" rows="3" name="description">
                        {{$item->description}}
                    </textarea>
                     @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{$errors->first('description')}}
                        </div>
                    @endif
                </div>
                 <button class="btn btn-primary w-100 mt-3 " type="submit">Submit</button>
            </form>
        </div>
    </div>
  
</div>

@endsection