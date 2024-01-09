<?php

namespace App\Http\Controllers\Users;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Moneycard;
use App\Moneycard_details;
class UserOrdersController extends UsersBaseController
{
    public function myOrders()
    {
        $userId = Auth::user()->id;
        $myOrders = Order::where('user_id', $userId)->latest()->get();
        return view('public.users.orders', compact('myOrders'));
    }
    public function order_details($id)
    {
        $order = Order::findOrFail($id);
        $order_details = OrderDetail::where('order_id', $id)->get();

        return view('public.users.order-details', compact('order_details', 'order'));
    }
    
       public function addmoney(Request $request)
    {
        $check=Moneycard::where('card_id',$request->card_id)->first();
         $user_id=Auth::user()->id;
  if($check){
      $cardcheck=Moneycard_details::where('card_id',$request->card_id)->where('user_id',$user_id)->first();
      if($cardcheck){
          return redirect()->back()
            ->with('alert_message', 'Already Used this Money Card');
      }else{
      
       $moneycard_details = new Moneycard_details;
       $moneycard_details->money_id=$check->id;
       $moneycard_details->card_id=$check->card_id;
       $moneycard_details->user_id=$user_id;
        $moneycard_details->save();
      $user=User::find($user_id);
      $user->user_wallet_money +=$check->amount;
      $user->save();
      return redirect()->back()
      ->with('success_message', 'Add Money successfully');
      }
  }else{
            return redirect()->back()
            ->with('alert_message', 'Money Card Id Not  valid');
       }
  }
}
