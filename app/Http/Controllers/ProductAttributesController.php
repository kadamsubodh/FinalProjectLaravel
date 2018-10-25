<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Product_attribute;
use Illuminate\Http\Request;
use Auth;
class ProductAttributesController extends Controller
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
            $productsattributes = Product_attribute::latest()->paginate($perPage);
        } else {
            $productsattributes = Product_attribute::latest()->paginate($perPage);
        }

        return view('admin.productsattributes.index', compact('productsattributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.productsattributes.create');
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
        $validate = $request->validate([
                'name'=>'required',
        ]);
        $attribute=new Product_attribute();
        $attribute->name=$request->name;
        $attribute->created_by=Auth::user()->id;
        $attribute->modify_by=Auth::user()->id;
        $attribute->save();
        if($attribute)
        {
            Session::flash('alert-success', 'Attribute added!');
            return redirect('admin/productsattributes');
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
        $productsattribute = Product_attribute::findOrFail($id);
        return view('admin.productsattributes.show', compact('productsattribute'));
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
        $productsattribute = Product_attribute::findOrFail($id);
        return view('admin.productsattributes.edit', compact('productsattribute'));
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
        $validate = $request->validate([
                'name'=>'required',
        ]);
        $attribute = Product_attribute::findOrFail($id);
        $attribute->name=$request->name;
        $attribute->modify_by=Auth::user()->id;
        $attribute->save();
        if($attribute)
        {
            Session::flash('alert-success', 'Attribute Updated!');
            return redirect('admin/productsattributes');
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
        Product_attribute::destroy($id);
        return redirect('admin/productsattributes')->with('flash_message', 'Product_attribute deleted!');
    }
}
