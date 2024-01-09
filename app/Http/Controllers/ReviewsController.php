<?php

namespace App\Http\Controllers;

use App\Book;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function store(Book $book , Request $request)
    {
      
        $rules = [
            'body'          => 'required'
        ];
        $message = [
            'body.required' => "Comment body can't be empty"
        ];
        $this->validate($request, $rules, $message);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['book_id'] = $book->id;

        $review = Review::create($input);

        return redirect()->back()->with('success_message', 'Your review added');
    }
    public function review(Request $request)
    {
        
        $id=Auth::user()->id;
     $check=Review::where('user_id',$id)->where('book_id',$request->book_id)->first();
     if($check){
         $rating=Review::find($check->id);
         $rating->rating=$request->rating;
         $rating->save();
          return redirect()->back()->with('success_message', 'Your review Updated');
     }else{
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['book_id'] = $request->book_id;
        $input['rating'] = $request->rating;

        $review = Review::create($input);
         return redirect()->back()->with('success_message', 'Your review added');
}
       
    }

}
