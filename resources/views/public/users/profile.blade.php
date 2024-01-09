@extends('layouts.user-master')

@section('content')
    <div class="container">
        <h4 class="my-4 p-3 bg-light">Profile</h4>
@include('layouts.includes.flash-message')
        <div class="row">
            <div class="col-lg-6">
                    <div class="card card-body my-3 d-flex flex-row">
                        <div class="user-avatar mr-3">
                            <img src="{{Auth::user()->image? Auth::user()->image_url:Auth::user()->default_img}}" width="100" alt="">
                        </div>

                        <div class="user-info">
                            <h5 class="my-3">{{Auth::user()->name}}</h5>
                            <p><i class="fas fa-envelope mr-2"></i> {{Auth::user()->email}}</p>
                            <p><i class="fab fa-gg-circle mr-2"></i>Wallet Money: {{Auth::user()->user_wallet_money}} tk</p>
                            <p><i class="fas fa-clock mr-2"></i> {{Auth::user()->created_at? Auth::user()->created_at->diffForHumans(): ''}} </p>

                        </div>
                    </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-body my-3">
                    <h6>Activities</h6>
                    <p><a href="{{route('user.orders')}}" class="mr-2"><i class="fas fa-shopping-basket mr-1"></i> Orders</a> {{Auth::user()->orders? Auth::user()->orders->count(): 'No order yet'}}</p>
                    <p><a href="{{route('user.reviews')}}" class="mr-2"><i class="fas fa-comments mr-1"></i> Reviews</a> {{Auth::user()->reviews? Auth::user()->reviews->count(): 'No review yet'}}</p>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Add Money
</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Money</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/user/add/money" method="POST">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <label>Input Card Money Code</label>
          <input class="form-control" name="card_id" type="text" placeholder="#xxxx" required>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">SUBMIT</button>
      </div>
       </form>
    </div>
  </div>
</div>
@endsection
