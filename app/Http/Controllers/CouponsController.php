<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
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
            $coupons = Coupon::latest()->paginate($perPage);
        } else {
            $coupons = Coupon::latest()->paginate($perPage);
        }

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.coupons.create');
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
        'code'=>'required|alphaNum|min:4|max:8',
        'percent_off'=>'required|regex:/^\d*(\.\d{2})?$/',
        'number_of_uses'=>'required|regex:/^\d*(\.\d{2})?$/',
       ]);
       $code=$request->code;
       $percent_off=$request->percent_off;
       $number_of_uses=$request->number_of_uses;
       $created_by=Auth::user()->id;
       $modify_by=Auth::user()->id;
       $addCoupon=DB::select('call addNewCoupon(?,?,?,?,?)',array($code,$percent_off,$number_of_uses, $created_by,$modify_by));
       return redirect('admin/coupons')->with('flash_message', 'Coupon added!');
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
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupons.show', compact('coupon'));
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
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupons.edit', compact('coupon'));
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
        
        $requestData = $request->all();
        
        $coupon = Coupon::findOrFail($id);
        $coupon->update($requestData);

        return redirect('admin/coupons')->with('flash_message', 'Coupon updated!');
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
        Coupon::destroy($id);

        return redirect('admin/coupons')->with('flash_message', 'Coupon deleted!');
    }

    public function isExist(Request $request)
    {
        $code=$request->code;
        $check=DB::select('exec checkCode(?)',array($code));
        if($check)
        {
            return true;
        }

    }
}
