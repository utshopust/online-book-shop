@extends('layouts.master')

@section('content')
@include('layouts.includes.flash-message')
    <div class="container">
        <div class="payment-area">
            <h4 class="my-4 bg-dark p-3 text-white">Make your payment</h4>

            <div class="cart-summary my-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Order summary</h4>
                    </div>
                    <div class="card-body">
                        <p>Total products = {{Cart::content()->count()}}</p>
                        <p>Product Cost = &#2547;{{Cart::total()}}</p>
                        <p>Shipping cost = &#2547;0.00</p>
                        <p><strong>Total cost = &#2547;{{Cart::total()}}</strong></p>
                    </div>
                </div>
            </div>
            @php
            $check=Cart::total();
            @endphp

            <div class="bg-light p-3 my-4">
                 <button class="btn btn-success btn-sm"><strong>Wallet Money:{{Auth::user()->user_wallet_money}} tk</strong></button><br>
                 @if($check <= Auth::user()->user_wallet_money)
                <form action="{{route('cart.checkout')}}" method="post">
                    @csrf
                    <input type="hidden" name="cart_total" value="{{Cart::total()}}">
                    <button type="submit" class="btn btn-info btn-sm"><strong>Payment</strong></button>
                    <!--<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"-->
                    <!--        data-key="pk_test_7xVvmxzKaoeFzuBZZ18WdwKy00bmfx80CA"-->
                    <!--        data-amount=""-->
                    <!--        data-name="Bookshop"-->
                    <!--        data-description="Bookshop payment"-->
                    <!--        data-locale="auto">-->
                    <!--</script>-->
                </form>
                @else
                <span style="color:red">Your Wallet Ammount not sufficient</span>
                @endif
            </div>
            <!--<div class="bg-light p-3 my-4">-->
               
            <!--    <button class="btn btn-success btn-sm"><strong>Wallet Money: {{Auth::user()->user_wallet_money}} tk</strong></button>-->
            <!--</div>-->
        </div>
    </div>
@endsection
