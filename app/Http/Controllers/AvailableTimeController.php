<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use App\Models\UserDates;
use App\Models\Counseling;
use Illuminate\Http\Request;
use App\Models\AvailableTime;
use Illuminate\Support\Facades\Auth;

class AvailableTimeController extends Controller
{
    public function book(Request $request)
    {
        $book['available_id']= $request->id;
        $avl = AvailableTime::find($book['available_id']);
        $avl->available = 1;
        $avl->save();
        $book['user_id'] = Auth::guard('user-api')->user()->id;
        $book1 = UserDates::create($book);
        $user =new User;
       return response()->json(['book'=>$avl]);
    }
    
}
