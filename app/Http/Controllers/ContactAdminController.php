<?php

namespace App\Http\Controllers;

use Mail;
use App\Email_template;
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
    	]);

    	$contactus=new Contact_us();
    	$contactus->name=$request->name;
    	$contactus->email=$request->email;
    	$contactus->contact_no=$request->contact_no;
    	$contactus->message=$request->message;
    	$contactus->created_by=$request->name;
    	$contactus->modify_by=$request->name;
    	$contactus->save();
    	if($contactus)
    	{   
            $subject="";
            $content="";
            $ipAddress=$this->getRealIpAddr();
            $template=Email_template::where('title','=','contactToAdmin')->get();
            foreach($template as $email)
            {
                $subject=$email->subject;
                $content=$email->content;
            }
            $content=str_replace("{customerName}",$request->name,$content);
            $content=str_replace("{customerEmail}",$request->email,$content);
            $content=str_replace("{customerContact}",$request->contact_no,$content);
            $content=str_replace("{customerMessage}",$request->message,$content);
            $content=str_replace("{ip}",$ipAddress,$content);
            Mail::send([],[], function($message) use ($content,$subject,$request)
            {
                $message->to('eshopersnoreply@gmail.com')->subject($subject)->setBody($content, 'text/html');
            });          

    		Session::flash('alert-success', 'Query posted successfully!');
            return redirect('eshopers/contactUs');
    	}
    	else
    	{
    		Session::flash('alert-danger', 'Some problem is there');
            return redirect('eshopers/contactUs');
    	}

    }

    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
