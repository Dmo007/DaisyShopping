@extends('layouts.admin')
@section('content')

    
<div class="container px-3">
    <div class="card my-5">
        <div class="card-header">
            <h5 class="d-inline">User Create</h5>
            <a href="{{route('backend.users.index')}}" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="{{route('backend.users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{$user->name}}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{$user->email}}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                @endif
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="" class="form-control {{$errors->has('role') ? 'is-invalid' : ''}}">
                        <option value="">Select Role</option>
                        <option value="Super Admin">Super Admin</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                    @if($errors->has('role'))
                    <div class="invalid-feedback">
                        {{$errors->first('role')}}
                    </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="phone_no" class="form-label">Phone Number</label>
                    <input type="number" class="form-control {{$errors->has('phone_no') ? 'is-invalid' : ''}}" name="phone_no" placeholder="09xxxxxxxxx" value="{{$user->phone_no}}">
                @if($errors->has('phone_no'))
                    <div class="invalid-feedback">
                        {{$errors->first('phone_no')}}
                    </div>
                @endif
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" name="address" value="{{$user->address}}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{$errors->first('address')}}
                    </div>
                @endif
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" value="{{$user->password}}">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{$errors->first('password')}}
                    </div>
                @endif
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">password_confirmation</label>
                    <input type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" name="password_confirmation" value="{{$user->password}}">
                @if($errors->has('password_confirmation'))
                    <div class="invalid-feedback">
                        {{$errors->first('password_confirmation')}}
                    </div>
                @endif
                </div>
                 <button class="btn btn-primary w-100 mt-3 " type="submit">Submit</button>
            </form>
        </div>
    </div>
  
</div>

@endsection