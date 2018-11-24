<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use Illuminate\Support\Facades\Session;
class loginController extends Controller
{
    public function showLogin()
    {
    	return view('admin.layout.login');
    }

    public function doLogin(Request $request)
    {
    	// $email=$request->email;
    	// $password=$request->password;
    	// $rules=array(
    		
    	// );
    	$validate=$request->validate([
    		'email'=>'required|email',
    		'password'=>'required|alphaNum|max:12'
    	]);  
      
    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
    		{
                if(Auth::user()->role_id!='5' && Auth::user()->status=='1')
                {
    			return redirect('/index');
                }
                else
                {
                    Session::flash('alert-danger', 'Sorry! Access Denied');
                    return redirect('/');
                }

    		}
    	else
    		{
                Session::flash('alert-danger', 'Invalid credentials');
                return redirect('/');
    		}
    }
    public function doLogOut()
    {
    	Auth::logout();
    	return redirect('/');
    }
}

   