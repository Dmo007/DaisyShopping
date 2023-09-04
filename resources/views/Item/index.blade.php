@extends('layouts/frontend')
@section('content')

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">ဒီမှာဝယ်</h1>
                    <!-- <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p> -->
                </div>
            </div>
        </header>
        <!-- Section-->
       
        <div class="container mt-5">
            <!-- <h1 class="text-success text-left border shadow w-25">Catgoreis</h1> -->
                <div class="row ">
                @foreach($categories as $category)
                    <div class="col-6 col-lg-3 mb-3">
                        <div class="card h-100">
                            
                            <img class="card-img-top" src="{{$category->photo}}" alt="..." />
                            
                            <div class="card-body p-4">
                                <div class="text-center">
                                    
                                    <h5 class="fw-bolder">{{$category->name}}</h5>          
                                </div>
                            </div>
                           
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{route('itemcategory',$category->id)}}">View Option</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

         </div>

        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                   @foreach($items as $item)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            @if($item->discount > 0)
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">{{$item->discount}}%</div>
                            @endif
                            <!-- Product image-->
                            <img class="card-img-top" src="{{$item->image}}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$item->name}}</h5>          
                                    <!-- Product price-->
                                    @if($item->discount > 0)
                                    <span class="text-muted text-decoration-line-through">{{$item->price}} MMK</span>
                                    {{$item->price-($item->discount/100) * $item->price}} MMK
                                    @else
                                    {{$item->price}} MMK
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-3 pt-0 border-top-0 bg-transparent product_action">
                                <div class="text-center row">
                                    <div class="col-md-3">
                                            <a class="btn btn-outline-dark mt-auto" href="{{route('item.show',$item->id) }}">View </a>
                                        </div>
                                        <div class="col-md-8 ms-md-2">
                                            <input type="hidden" class="qty" value="1">
                                            <button class="btn btn-outline-dark flex-shrink-0 addToCart" href="" type="buttom" data-id="{{$item->id}}" data-name="{{$item->name}}" data-image="{{$item->image}}" data-price="{{$item->price}}" data-discount="{{$item->discount}}">
                                                <i class="bi-cart-fill me-1"></i>
                                                Add cart
</button>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
        </section>
@endsection