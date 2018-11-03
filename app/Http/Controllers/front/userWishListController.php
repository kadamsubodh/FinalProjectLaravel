<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Route;
use Cookie;
use Auth;
use App\User_wish_list;
use DB;
use Illuminate\Support\Facades\Session;

class userWishListController extends Controller
{
    public function addProductToWishlist(Request $request)
    {
        $productId=Route::current()->parameter('productId');
        if(DB::table('user_wish_lists')->where('product_id','=',$productId)->where('user_id','=',Auth::user()->id)->exists())
        {
            Session::flash('alert-danger', 'This product is already in your wishlist!!');
            return redirect('/eshopers/home');
        }
        else{
            $wishLists=new User_wish_list();
            $wishLists->product_id=$productId;
            $wishLists->user_id=Auth::user()->id;
            $wishLists->save();
            if($wishLists)
            {
                Session::flash('alert-success', 'This product is added in your wishlist!!');
                return redirect('/eshopers/home');
            }
        }
    }
   
}
