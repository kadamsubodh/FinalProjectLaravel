<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
 // Role::where('name','order_manager')->first()->givePermissionTo('Add','Edit');
          // $role=auth()->user()->givePermissionTo('Add');
        $keyword = $request->get('search');
        $perPage = 25;
        if (!empty($keyword)) {
            $users = User::latest()->paginate($perPage);
        } 
        else {
            $users = User::latest()->paginate($perPage);
        }
      // $user= DB::table('users')->where('id', DB::raw("(select max(`id`) from users)"))->get();
      //       foreach($user as $us)
      //       {
      //            $role=$us->role_id;
      //            $id=$us->id;
      //            $permissions= DB::table('role_has_permissions')->where(function ($query) use ($role,$id){
      //               $query->where('role_id','=', $role)->pluck('permission_id');
      //               // $query->where('id','=', $id);
      //               })->get();
      //            $modelRole= DB::insert('insert into model_has_roles(role_id,model_type,model_id) values(?,?,?)',[$role,'App\User',$id]);
      //               foreach ($permissions as $per) {
      //               $permission= $per->permission_id;

      //               $modelPermissions= DB::insert('insert into model_has_permissions(permission_id,model_type,model_id) values(?,?,?)',[$permission,'App\User',$id]);
      //                   # code...
      //               }
      //               if($modelPermissions && $modelRole )
      //               {
                       
      //               }
                    
      //       }
            // return $permissions;
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'password'=>'required|alphaNum|min:8|max:12',
            'confirm_password'=>'required|same:password',
            'status'=>'required',
            'role'=>'required'

        ]);
        if(User::where('email','=',$request->email)->where('role_id','=',$request->role)->count()>0)
        {
          Session::flash('alert-danger', 'Email id already exist!');
          return redirect('admin/users'); 
        }
        else
        {
     
          $user=new User();
          $user->firstname=$request->firstname;
          $user->lastname=$request->lastname;
          $user->email=$request->email;
          $user->password=bcrypt($request->password);
          $user->status=$request->status;
          $user->role_id=$request->role;
          $user->created_date = date("Y-m-d H:i:s");
          $v=$user->save();
          if($v)
          {
              $user1= DB::table('users')->where('id', DB::raw("(select max(`id`) from users)"))->get();
              foreach($user1 as $us)
              {
                  $role=$us->role_id;
                  $id=$us->id;
                  $permissions= DB::table('role_has_permissions')->where(function ($query) use ($role,$id){
                      $query->where('role_id','=', $role)->pluck('permission_id');
                      // $query->where('id','=', $id);
                      })->get();
                  $modelRole= DB::insert('insert into model_has_roles(role_id,model_type,model_id) values(?,?,?)',[$role,'App\User',$id]);
                      
                      foreach ($permissions as $per) {
                      $permission= $per->permission_id;

                      $modelPermissions= DB::insert('insert into model_has_permissions(permission_id,model_type,model_id) values(?,?,?)',[$permission,'App\User',$id]);                        
                      }           
              }
              if($modelPermissions && $modelRole )
              {
                  Session::flash('alert-success', 'User added!');
                  return redirect('admin/users');
              }            
          }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
      $validate=$request->validate([
          'firstname'=>'required',
          'lastname'=>'required',
          'email'=>'required|email',
          'status'=>'required',
          'role'=>'required'
      ]);      
      $user = User::findOrFail($id);
      $user->firstname=$request->firstname;
      $user->lastname=$request->lastname;
      $user->email=$request->email;
      $user->status=$request->status;
      $user->role_id=$request->role;
      $user->created_date = date("Y-m-d H:i:s");
      $user->save();
      $modelPermissions=true;
      if($user)
      {
          $role=$request->role;
          $permissions= DB::table('role_has_permissions')->where(function ($query) use ($role,$id){
                  $query->where('role_id','=', $role)->pluck('permission_id');
                  // $query->where('id','=', $id);
                  })->get();
          $modelRole= DB::update('update model_has_roles set role_id=? where model_id=?',[$role,$id]);
          $deletePermission=DB::delete('delete from model_has_permissions where model_id=?',[$id]);
          if($deletePermission)
          {

              foreach ($permissions as $per) 
              {

              $permission= $per->permission_id;

              DB::insert('insert into model_has_permissions(permission_id,model_type,model_id) values(?,?,?)',[$permission,'App\User',$id]);
              }       
          }                 
     
              Session::flash('alert-success', 'User updated!');

              return redirect('admin/users');
 
      }
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('alert-success', 'User deleted!');
        return redirect('admin/users');
    }

    public function updateMyInfo(Request $request)
    {
        $validate=$request->validate([
        "firstname"=>"required",
        "lastname"=>"required",
        "email"=>"required|email",
        ]);
        $firstname='';
        $lastname='';
        $email='';
        foreach(User::where("id",'=',Auth::user()->id)->get() as $user)
        {
            $firstname=$user->firstname;
            $lastname=$user->lastname;
            $email=$user->email;
        }
        if($email != $request->email)
        {
            $isEmailExist=User::where('email','=',$request->email)->get();
            if(count($isEmailExist)>0)
            {
                Session::flash('alert-danger', 'This email id is already registered!! Use another email Id');
                return redirect()->back();

            }
        }

       $oldEmail=Auth::user()->email;       
       if($firstname!=$request->firstname)
       {
            $user=Auth::user()->firstname.Auth::user()->id;
            $newUser=$request->firstname.Auth::user()->id;            
            if(isset($_COOKIE[$user]))
            {
                $cookiedata=stripcslashes($_COOKIE[$user]);
                $product_ids= json_decode($cookiedata,true);
                setcookie($user,null,time()-3600);
                setcookie($newUser,json_encode($product_ids,true),time()+60*60*24*90);
            }                     
        } 
        $user=User::findOrFail(Auth::user()->id);
        $user->firstname=$request->firstname;
        $user->lastname=$request->lastname;
        $user->email=$request->email;
        $user->save();            
        if($user->email!= $oldEmail)
        {
            Session::flash('alert-danger', 'Email ID changed! please sign in again');
            Auth::logout();
            return redirect('/eshopers/login');
        }
        else
        {
            return redirect("/eshopers/myProfile");
        }
    } 
    
}
