<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
                $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $useraddress = UserAddress::where('user_id','=',Auth::user()->id)->latest()->paginate($perPage);
        } else {
            $useraddress = UserAddress::where('user_id','=',Auth::user()->id)->latest()->paginate($perPage);
        }

        return view('frontend.user-address.index', compact('useraddress'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('frontend.user-address.create');
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
        'address_1'=>'required|max:200',
        'address_2'=>'required|max:200',
        'city'=>'required',
        'state'=>'required',
        'country'=>'required',
        'zipcode'=>'required|numeric|regex:/\b\d{6}\b/'
        ]);       
        
        $user_Address=new UserAddress();
        $user_Address->user_id=Auth::user()->id;
        $user_Address->address_1=$request->address_1;
        $user_Address->address_2=$request->address_2;
        $user_Address->city=$request->city;
        $user_Address->state=$request->state;
        $user_Address->country=$request->country;
        $user_Address->zipcode=$request->zipcode;
        $user_Address->save();
        if($user_Address)
        {
            Session::flash('alert-success', 'New address is saved!');
            return redirect('eshopers/userAddress');
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
        $useraddress = UserAddress::findOrFail($id);

        return view('frontend.user-address.show', compact('useraddress'));
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
        $useraddress = UserAddress::findOrFail($id);

        return view('frontend.user-address.edit', compact('useraddress'));
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
        'address_1'=>'required|max:200',
        'address_2'=>'required|max:200',
        'city'=>'required',
        'state'=>'required',
        'country'=>'required',
        'zipcode'=>'required|numeric|regex:/\b\d{6}\b/'
        ]);       
        
        $user_Address= UserAddress::findOrFail($id);
        $user_Address->user_id=Auth::user()->id;
        $user_Address->address_1=$request->address_1;
        $user_Address->address_2=$request->address_2;
        $user_Address->city=$request->city;
        $user_Address->state=$request->state;
        $user_Address->country=$request->country;
        $user_Address->zipcode=$request->zipcode;
        $user_Address->save();
        if($user_Address)
        {
            Session::flash('alert-success', 'New address is saved!');
            return redirect('eshopers/userAddress');
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
        UserAddress::destroy($id);

        return redirect('eshopers/userAddress')->with('flash_message', 'UserAddress deleted!');
    }
}
