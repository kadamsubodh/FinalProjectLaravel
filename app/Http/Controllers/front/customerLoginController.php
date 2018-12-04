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
use Hash;
use DB;

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
            DB::insert('insert into model_has_roles(role_id,model_type,model_id) values(?,?,?)',[$userObj->role_id,'App\User',$user_id] );
            $permissions=DB::table('role_has_permissions')->where('role_id','=',5)->get();
            foreach($permissions as $permission)
            {
                DB::insert('insert into model_has_permissions(permission_id,model_type,model_id) values(?,?,?)',[$permission->permission_id,'App\User',$userObj->id]);
            }
            $subject="";
            $content="";
            $template=Email_template::where('title','=','userSignUpNotificationToUser')->get();
            foreach($template as $email)
            {
                $subject=$email->subject;
                $content=$email->content;
            }
            $content=str_replace("{email}",$request->email,$content);
            $content=str_replace("{password}",$request->password,$content);
            Mail::send([],[], function($message) use ($content,$subject,$request)
            {
                $message->to($request->email)->subject($subject)->setBody($content, 'text/html');
            });
            $template2=Email_template::where('title','=','userSignUpNotificationToAdmin')->get();
            foreach($template2 as $email)
            {
                $subject=$email->subject;
                $content=$email->content;
            }
            $content=str_replace("{email}",$request->email,$content);
            $content=str_replace("{password}",$request->password,$content);

            Mail::send([],[], function($message) use ($content,$subject,$request)
            {
                $message->to('eshopersnoreply@gmail.com')->subject($subject)->setBody($content, 'text/html');
            });


            Auth::loginUsingId($userObj->id);
            if(isset($_COOKIE['cartItems']))
            {
                $cookieDataBeforeLogin=stripcslashes($_COOKIE['cartItems']);
                $productsInCartBeforeLogin=json_decode($cookieDataBeforeLogin,true);   
                $user=Auth::user()->firstname.Auth::user()->id;
                    // $product_id=Route::current()->parameter('product_id');
                if(isset($_COOKIE[$user]))
                {
                    $cookiedata=stripcslashes($_COOKIE[$user]);
                    $product_ids= json_decode($cookiedata,true);
                    $id=Route::current()->parameter('product_id');
                    foreach($productsInCartBeforeLogin as $key=>$value)
                    {
                       if(array_key_exists($key,$product_ids))
                        {
                            if($product_ids[$key]+$productsInCartBeforeLogin[$key] > 5)
                            {
                                $product_ids[$key]=5;
                                //quanitiy limited to 5 per product
                            }
                            else
                            {
                                $product_ids[$key]=$product_ids[$key]+$productsInCartBeforeLogin[$key];
                            }
                        }
                        else
                        {
                            $product_ids[$key]=$value;
                        } 
                    }
                    setcookie($user, json_encode($product_ids,true),time()+60*60*24*365,'/');
                    setcookie('cartItems',null,time()-3600,'/');
                    return redirect('/eshopers/home');                     
                }
                else
                {   
                    $product_ids=[];
                    foreach($productsInCartBeforeLogin as $key=>$value)
                    {
                        $product_ids[$key]=$value;                          
                    }
                    setcookie($user, json_encode($product_ids,true),time()+60*60*24*365,'/');
                    setcookie('cartItems',null,time()-3600,'/');
                    return redirect('/eshopers/home');                                
                }
            }
            return redirect('/eshopers/home');
        }
        else
        {
          return redirect('/eshopers/login');  
        }
     }

     /**
     * Redirect the user to the social authentication page.
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
                if(isset($_COOKIE['cartItems']))
                {
                    $cookieDataBeforeLogin=stripcslashes($_COOKIE['cartItems']);
                    $productsInCartBeforeLogin=json_decode($cookieDataBeforeLogin,true);   
                    $user=Auth::user()->firstname.Auth::user()->id;
                        // $product_id=Route::current()->parameter('product_id');
                    if(isset($_COOKIE[$user]))
                    {
                        $cookiedata=stripcslashes($_COOKIE[$user]);
                        $product_ids= json_decode($cookiedata,true);
                        $id=Route::current()->parameter('product_id');
                        foreach($productsInCartBeforeLogin as $key=>$value)
                        {
                           if(array_key_exists($key,$product_ids))
                            {
                                if($product_ids[$key]+$productsInCartBeforeLogin[$key] > 3)
                                {
                                    $product_ids[$key]=3;
                                    Session::flash('alert-danger', 'Quanitiy limited to 3 per product'); //quanitiy limited to 3 per product
                                }
                                else
                                {
                                    $product_ids[$key]=$product_ids[$key]+$productsInCartBeforeLogin[$key];
                                }
                            }
                            else
                            {
                                $product_ids[$key]=$value;
                            } 
                        }
                        setcookie($user, json_encode($product_ids,true),time()+60*60*24*365,'/');
                        setcookie('cartItems',null,time()-3600,'/');
                        return redirect('/eshopers/home');                     
                    }
                    else
                    {   
                        $product_ids=[];
                        foreach($productsInCartBeforeLogin as $key=>$value)
                        {
                            $product_ids[$key]=$value;                          
                        }
                        setcookie($user, json_encode($product_ids,true),time()+60*60*24*365,'/');
                        setcookie('cartItems',null,time()-3600,'/');
                        return redirect('/eshopers/home');                                
                    }
                }          
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
                DB::insert('insert into model_has_roles(role_id,model_type,model_id) values(?,?,?)',[$userObj->role_id,'App\User',$userObj->id] );
                $permissions=DB::table('role_has_permissions')->where('role_id','=',5)->get();
                foreach($permissions as $permission)
                {
                  DB::insert('insert into model_has_permissions(permission_id,model_type,model_id) values(?,?,?)',[$permission->permission_id,'App\User',$userObj->id]);
                }
                Auth::loginUsingId($userObj->id);
                if(isset($_COOKIE['cartItems']))
                {
                    $cookieDataBeforeLogin=stripcslashes($_COOKIE['cartItems']);
                    $productsInCartBeforeLogin=json_decode($cookieDataBeforeLogin,true);   
                    $user=Auth::user()->firstname.Auth::user()->id;
                        // $product_id=Route::current()->parameter('product_id');
                    if(isset($_COOKIE[$user]))
                    {
                        $cookiedata=stripcslashes($_COOKIE[$user]);
                        $product_ids= json_decode($cookiedata,true);
                        $id=Route::current()->parameter('product_id');
                        foreach($productsInCartBeforeLogin as $key=>$value)
                        {
                           if(array_key_exists($key,$product_ids))
                            {
                                if($product_ids[$key]+$productsInCartBeforeLogin[$key] > 3)
                                {
                                    $product_ids[$key]=3;
                                    Session::flash('alert-danger', 'Quanitiy limited to 3 per product'); //quanitiy limited to 3 per product
                                }
                                else
                                {
                                    $product_ids[$key]=$product_ids[$key]+$productsInCartBeforeLogin[$key];
                                }
                            }
                            else
                            {
                                $product_ids[$key]=$value;
                            } 
                        }
                        setcookie($user, json_encode($product_ids,true),time()+60*60*24*365,'/');
                        setcookie('cartItems',null,time()-3600,'/');
                        return redirect('/eshopers/home');                     
                    }
                    else
                    {   
                        $product_ids=[];
                        foreach($productsInCartBeforeLogin as $key=>$value)
                        {
                            $product_ids[$key]=$value;                          
                        }
                        setcookie($user, json_encode($product_ids,true),time()+60*60*24*365,'/');
                        setcookie('cartItems',null,time()-3600,'/');
                        return redirect('/eshopers/home');                                
                    }
                }
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
        $pageReferer=$_SERVER['HTTP_REFERER'];        
        $validate=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            if(Auth::user()->role_id==5 && Auth::user()->status=='1')
            {
                if(isset($_COOKIE['cartItems']))
                {
                    $cookieDataBeforeLogin=stripcslashes($_COOKIE['cartItems']);
                        $productsInCartBeforeLogin=json_decode($cookieDataBeforeLogin,true);
                    $user=Auth::user()->firstname.Auth::user()->id;                       
                    if(isset($_COOKIE[$user]))
                    {                        
                        $cookiedata=stripcslashes($_COOKIE[$user]);
                        $product_ids= json_decode($cookiedata,true);
                        $id=Route::current()->parameter('product_id');
                        foreach($productsInCartBeforeLogin as $key=>$value)
                        {
                           if(array_key_exists($key,$product_ids))
                            {
                                if($product_ids[$key]+$productsInCartBeforeLogin[$key] > 5)
                                {
                                    $product_ids[$key]=5;
                                    Session::flash('alert-danger', 'Quanitiy limited to 5 per product');
                                }
                                else
                                {
                                    $product_ids[$key]=$product_ids[$key]+$productsInCartBeforeLogin[$key];
                                }
                            }
                            else
                            {
                                $product_ids[$key]=$value;
                            } 
                        }
                        setcookie($user, json_encode($product_ids,true),time()+60*60*24*365,'/');
                        setcookie('cartItems',null,time()-3600,'/');
                        if($pageReferer=='http://localhost:8000/eshopers/checkout')
                        {
                            return redirect('/eshopers/checkout');
                        }
                        else
                        {
                            return redirect('/eshopers/home');
                        }                    
                    }
                    else
                    {   
                        $product_ids=[];
                        foreach($productsInCartBeforeLogin as $key=>$value)
                        {
                            $product_ids[$key]=$value;                          
                        }
                    setcookie($user, json_encode($product_ids,true),time()+60*60*24*365,'/');
                        setcookie('cartItems',null,time()-3600,'/');
                        return redirect('/eshopers/home');                                
                    }
                }
                else
                {
                    return redirect('/eshopers/home');
                }
            }
            Session::flash('alert-danger', 'Access denied for this user!');
            return redirect('/eshopers/login');
        }
        else
        {
             Session::flash('alert-danger', 'Invalid Credential');
            return redirect('/eshopers/login');
        }
    }

    public function customerLogout()
    {
        setcookie('checkOutData',null,time()-3600);
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
            $user=User::where('email', '=', $request->email)->first();
            $user->password=$password;
            $user->save();    
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

    public function changePassword(Request $request)
    {
        $validate=$request->validate([
            "current_password"=>"required",
            "new_password"=>"required|alphaNum|min:6|max:12",
            "confirm_password"=>"required|alphaNum|min:6|max:12|same:new_password"
        ]);
       
        if(Hash::check($request->current_password,Auth::user()->password))
        {
            $user=User::find(Auth::user()->id);
            $user->password=bcrypt($request->new_password);
            $user->save();
            Auth::logout();
            Session::flash('alert-danger', 'Password changed!! Please Login with new Password');
            return redirect('/eshopers/home');
        }
        else
        {
            Session::flash('alert-danger', 'Current Password is Inccorect!!');
            return redirect()->back();
        }
    }
}


