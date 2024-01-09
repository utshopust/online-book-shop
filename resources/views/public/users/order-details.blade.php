@extends('layouts.user-master')

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
@include('layouts.includes.flash-message')
<div class="container">
    <h4 class="my-4 p-4 bg-light">Order Details</h4>

    <div class="card my-4">
        <div class="card-header">
            <h4>Billing Address</h4>
        </div>
        <div class="card-body">
            <p><i class="fas fa-user"></i> <span class="mx-2">{{$order->shipping->shipping_name}}</span></p>
            <p><i class="fas fa-phone"></i><span class="mx-2">{{$order->shipping->mobile_no}}</span></p>
            <p><i class="fas fa-map-marked"></i> <span class="mx-2">{{$order->shipping->address}}</span></p>
        </div>
    </div>
    <div class="order-product mb-4">
        <h4 class="my-4 p-4 bg-light">Order information</h4>
        <table class="table">
        <thead>
        <tr>
            <th scope="col">Book Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Sub Total</th>
            <th scope="col">Book Pdf</th>
             @if($order->order_status == 1)
            <th scope="col">Review</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($order_details as $order_detail)
        
        @php
$id=Auth::user()->id;
 $b=$order_detail->book_id;
 $rate=App\Review::where('book_id',$b)->where('user_id',$id)->first();
 if($rate){
 $review=$rate->rating;
 }else{
 $review="";
 }
@endphp
        <tr>
          <td>{{$order_detail->book_name}}</td>
          <td>{{$order_detail->book_quantity}}</td>
          <td>&#2547;{{$order_detail->price}}</td>
          <td>&#2547;{{$order_detail->price * $order_detail->book_quantity}}</td>
          @if($order->order_status == 1)
          <td><a href="/pdf/download/{{$order_detail->book_id}}" class="btn btn-success">Download</a></td>
           
          @else
          <td class="btn btn-success">Pending</td>
          @endif
          @if($order->order_status == 1)
           <td>
               <form action="/review/submit" method="POST">
                   @csrf
               <div class="rate">
                   <input type="text" name="book_id" value="{{$order_detail->book_id}}" />
                  
    <input type="radio" id="{{$order_detail->book_id}}star5" name="rating" value="5" required @if($review == 5 ) checked @endif  />
    <label for="{{$order_detail->book_id}}star5" title="text">5 stars</label>
    <input type="radio" id="{{$order_detail->book_id}}star4" name="rating" value="4" required @if($review == 4 ) checked @endif />
    <label for="{{$order_detail->book_id}}star4" title="text">4 stars</label>
    <input type="radio" id="{{$order_detail->book_id}}star3" name="rating" value="3" required @if($review == 3 ) checked @endif />
    <label for="{{$order_detail->book_id}}star3" title="text">3 stars</label>
    <input type="radio" id="{{$order_detail->book_id}}star2" name="rating" value="2" required @if($review == 2 ) checked @endif />
    <label for="{{$order_detail->book_id}}star2" title="text">2 stars</label>
    <input type="radio" id="{{$order_detail->book_id}}star1" name="rating" value="1" required @if($review == 1 ) checked @endif />
    <label for="{{$order_detail->book_id}}star1" title="text">1 star</label>
  </div>
  <button class="btn btn-sm btn-success" type="submit">Submit</button>
  </form>
           </td>
           @endif
        </tr>
        @endforeach
        <tr>
            <td colspan="2"></td>
            <td><strong>Total</strong></td>
            <td><strong>&#2547;{{$order->total_price}}</strong></td>
        </tr>
        </tbody>
        </table>
    </div>
</div>
@endsection
