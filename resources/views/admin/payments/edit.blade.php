@extends('layouts.admin')
@section('content')

    
<div class="container px-3">
    <div class="card my-5">
        <div class="card-header">
            <h5 class="d-inline">Payment Create</h5>
            <a href="{{route('backend.payments.index')}}" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="{{route('backend.payments.update',$payment->id)}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{$payment->name}}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                @endif
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">logo</label>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">logo</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">New logo</button>
                        </li>
                    </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <img src="{{$payment->logo}}" alt="" class="img-fluid py-3 w-25">
                                <input type="hidden" name="old_logo">
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <input class="form-control {{$errors->has('logo') ? 'is-invalid' : ''}} my-3" type="file" id="logo" name="new_logo" accept="image/*">
                                @if($errors->has('logo'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('logo')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                   
                </div>
                 <button class="btn btn-primary w-100 mt-3 " type="submit">Submit</button>
            </form>
        </div>
    </div>
  
</div>

@endsection