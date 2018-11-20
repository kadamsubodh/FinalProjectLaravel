<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Contact_us;

class contactAdminController extends Controller
{
    public function contactAdmin(Request $request)
    {
    	$validate=$request->validate([
    		"name"=>"required",
    		"email"=>"required|email",
    		"contact_no"=>"required",    		
    		"message"=>"required|max:1200",
    		"note_admin"=>"required"
    	]);

    	$contactus=new Contact_us();
    	$contactus->name=$request->name;
    	$contactus->email=$request->email;
    	$contactus->contact_no=$request->contact_no;
    	$contactus->message=$request->message;
    	$contactus->note_admin=$request->note_admin;
    	$contactus->created_by=$request->name;
    	$contactus->modify_by=$request->name;
    	$contactus->save();
    	if($contactus)
    	{
    		Session::flash('alert-success', 'Query posted successfully!');
            return redirect('eshopers/contactUs');
    	}
    	else
    	{
    		Session::flash('alert-danger', 'Some problem is there');
            return redirect('eshopers/contactUs');
    	}

    }
}
