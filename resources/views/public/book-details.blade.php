@extends('layouts.master')

@section('title')
Bookshop - Book details
@endsection
@section('content')
<style>
    .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
</style>
@php
 $b=$book->id;
 $rate=App\Review::where('book_id',$b)->sum('rating');
 $count=App\Review::where('book_id',$b)->count();
 if($count){
 $review=$rate/$count;}else{
 $review=3;
 }
@endphp
    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="content-area">
                        <div class="card my-4">
                            <div class="card-header bg-dark">
                                <h4 class="text-white">Book Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-4">
                                        <div class="book-img-details">
                                            <img src="{{$book->image_url}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="book-title">
                                            <h5>{{$book->title}}</h5>
                                            
                                          
                                        </div>
                                        <div class="author mb-2">
                                            By <a href="{{route('author', $book->author->slug)}}">{{$book->author->name}}</a>
                                        </div>
                                        <div class="rate">
    <input type="radio" id="star6" name="rate" value="5" @if($review >= 5 && $review < 6) checked @endif />
    <label for="star6" title="text">5 stars</label>
    <input type="radio" id="star7" name="rate" value="4" @if($review >= 4 && $review < 5) checked @endif  />
    <label for="star7" title="text">4 stars</label>
    <input type="radio" id="star8" name="rate" value="3" @if($review >= 3 && $review < 4) checked @endif />
    <label for="star8" title="text">3 stars</label>
    <input type="radio" id="star9" name="rate" value="2" @if($review >= 2 && $review < 3) checked @endif />
    <label for="star9" title="text">2 stars</label>
    <input type="radio" id="star10" name="rate" value="1" @if($review >= 1 && $review < 2) checked @endif />
    <label for="star10" title="text">1 star</label>
  </div>
                                        @if(($book->quantity) > 1)
                                            <div class="badge badge-success mb-2">In Stock</div>
                                        @else
                                            <div class="badge badge-danger mb-2">out of Stock</div>
                                        @endif
                                        @if($book->discount_rate)
                                            <h6><span class="badge badge-warning">{{$book->discount_rate}}% Discount</span></h6>
                                        @endif
                                        <div class="book-price mb-2">
                                            <span class="mr-1">Price</span>
                                            @if($book->discount_rate)
                                                <span></span><strong class="line-through">&#2547;{{$book->init_price}}</strong>
                                            @endif
                                                <span>now</span><strong>&#2547;{{$book->price}}</strong>
                                            @if($book->discount_rate)
                                                <div><strong class="text-danger">Save &#2547;{{$book->init_price - $book->price}}</strong></div>
                                            @endif
                                        </div>
                                        <div class="book-category mb-2 py-1 d-flex flex-row border-top border-bottom">
                                            <a href="{{route('category', $book->category->slug)}}" class="mr-4"><i class="fas fa-folder"></i> {{$book->category->name}}</a>
                                            <a href="#review-section" class="mr-4"><i class="fas fa-comments"></i> Reviews</a>
                                        </div>

                                        <form action="{{route('cart.add')}}" method="post">
                                            @csrf
                                            <div class="cart">
                                            <span class="quantity-input mr-2 mb-2">
                                                <a href="#" class="cart-minus" id="cart-minus">-</a>
                                                <input title="QTY" name="quantity" type="text" value="1" class="qty-text">
                                                <a href="#" class="cart-plus" id="cart-plus">+</a>
                                            </span>
                                                <input type="hidden" name="book_id" value="{{$book->id}}">

                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-shopping-cart"></i> Add to cart</button>
                                            </div>
                                        </form>
                                        @include('layouts.includes.flash-message')
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="book-description p-3">
                                        <p>{!! Markdown::convertToHtml(e($book->description)) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-body my-4">
                            <div class="author-description d-flex flex-row">
                                <div class="author-img mr-4">
                                    <img src="{{$book->author->image? $book->author->image_url : $book->default_img}}" alt="">
                                </div>
                                <div class="des">
                                    <h5><a href="{{route('author', $book->author->slug)}}">{{$book->author->name}}</a></h5>
                                    <small>
                                        <a href="{{route('author', $book->author->slug)}}">
                                            <i class="fas fa-book"></i>
                                            {{$book->author->books()->count()}}
                                            {{str_plural('Book', $book->author->books()->count())}}
                                        </a>
                                    </small>
                                    <p>{!! Markdown::convertToHtml(e($book->author->bio)) !!}</p>
                                </div>
                            </div>
                        </div>
                        <!-- COMMENTS HERE -->
                        @include('layouts.includes.reviews')
                    </div>
                </div>
                <!-- Sidebar -->
                    @include('layouts.includes.side-bar')
                <!-- Sidebar end -->
            </div>
        </div>
    </section>
@endsection
