<?php
namespace App\Http\Controllers\front;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Email_template;

class customerLoginController extends Controller
{
     public function customerSignUp(Request $request)
     {
        $validate=$request->validate([
            'firstname'=>'required',
            'lastname' =>'required',
            'email'=>'required|email',
            'password'=>'required|alphaNum|max:12',
            'confirm_password'=> 'required|same:password',            
        ]);
        $userObj=new User();
        $userObj->firstname=$request->firstname;
        $userObj->lastname=$request->lastname;
        $userObj->email=$request->email;
        $userObj->password=bcrypt($request->password);
        $userObj->status=1;
        $userObj->registration_method='n';
        $userObj->created_date=date("Y-m-d H:i:s");            
        $userObj->role_id=5;
        $userObj->save();
        if($userObj)
        {
            Auth::loginUsingId($userObj->id);
            return redirect('/eshopers/home');
        }
        else
        {
          return redirect('/eshopers/login');  
        }

     }

     /**
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        $method=Route::current()->parameter('method');
        return Socialite::driver($method)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $method=Route::current()->parameter('method');
        $user = Socialite::with($method)->user();
        $userDetails=User::where('email','=',$user->email)->first();
        if($userDetails)
        {   
            Auth::loginUsingId($userDetails->id);
            if(Auth::user()->role_id == '5')
            {            
            return redirect('/eshopers/home');
            }
            else
            {
                return redirect('/index');
            }
        }
        else 
        {
            $userObj=new User();
            $name=explode(" ",$user->name);
            $userObj->firstname=$name[0];
            $userObj->lastname=$name[1];
            $userObj->email=$user->email;
            $len=8;
            $string = "";
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for($i=0;$i<$len;$i++)
            {
                $string.=substr($chars,rand(0,strlen($chars)),1);
            }
            $userObj->password=bcrypt($string);
            $userObj->status=1;

            if($method=='facebook')
            {
                $userObj->fb_token=$user->token;
                $userObj->registration_method='f';
            }
            else if($method=='google')
            {
                $userObj->google_token=$user->token;
                $userObj->registration_method='g';

            }
            else if($method=='twiter')
            {
                $userObj->twitter_token=$user->google_id;
                $userObj->registration_method='t';
            }
            $userObj->created_date=date("Y-m-d H:i:s");            
            $userObj->role_id=5;
            $userObj->save();
            if($userObj)
            {
                Auth::loginUsingId($userObj->id);
                return redirect('/eshopers/home');
            }
            else
            {
                return redirect('/eshopers/login');
            }
        }       
    }

    public function customerSignIn(Request $request)
    {
        $validate=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            if(Auth::user()->role_id==5)
            {
                return redirect('/eshopers/home');
            }            
        }
        else
        {
             Session::flash('alert-danger', 'Invalid Credential');
            return redirect('/eshopers/login');
        }
    }

    public function customerLogout()
    {
        Auth::logout();
        return redirect('/eshopers/home');
    }

    public function sendPasswordByEmail(Request $request)
    {
        $validate=$request->validate([
            'email'=>'required|email',
        ]);
        $email=$request->email;
        if (User::where('email', '=', $email)->exists())
        {
            $subject='';
            $content='';
            $template=Email_template::where('title','=','Reset Password')->get();
            foreach($template as $email)
            {
                $subject=$email->subject;
                $content=$email->content;
            }
            $len=8;
            $string = "";
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
            for($i=0;$i<$len;$i++)
            {
                $string.=substr($chars,rand(0,strlen($chars)),1);
            }            
            $password=bcrypt($string);
            $user=User::where('email', '=', $request->email);
            $user->password=$password;      
            $content=str_replace("##username##",$request->email,$content);
            $content=str_replace("##password##",$string,$content);


            Mail::send([],[], function($message) use ($content,$subject,$request)
            {
                $message->to($request->email)->subject($subject)->setBody($content, 'text/html');
            });
            // if(count(Mail::failures()) > 0) {
            //     return false;
            // } else {
            //     return true;
            // }
            Session::flash('alert-success', 'Password is reset! Check your email & login with new password');
            return redirect('/eshopers/login');
        }
        else{
            Session::flash('alert-danger', 'Not registered email!!');
            return redirect('admin/forgetpassword');
        }
    }
}


