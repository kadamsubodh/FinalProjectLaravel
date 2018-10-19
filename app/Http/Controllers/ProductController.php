<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
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
            $products = Product::latest()->paginate($perPage);
        } else {
            $products = Product::latest()->paginate($perPage);
        }

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.products.create');
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
            'name'=>'required|alphaNum',
            'sku'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'price'=>'required|regex:/^\d*(\.\d{2})?$/',
            'special_price'=>'required|regex:/^\d*(\.\d{2})?$/',
            'special_price_from'=>'required|date',
            'special_price_to'=>'required|date',
            'status'=>'required',
            'quantity'=>'required|Integer',
            'meta_title'=>'required',
            'meta_description'=>'required',
            'meta_keywords'=>'required',
            'is_featured'=>'required',
        ]);
        $product= new Product();
        $product->name=$request->name;
        $product->sku=$request->sku;
        $product->short_description=$request->short_description;
        $product->long_description=$request->long_description;
        $product->price=$request->price;
        $product->special_price=$request->special_price;
        $product->special_price_from=$request->special_price_from;
        $product->special_price_to=$request->special_price_to;
        $product->status=$request->status;
        $product->quantity=$request->quantity;
        $product->meta_title=$request->meta_title;
        $product->meta_description=$request->meta_description;
        $product->meta_keywords=$request->meta_keywords;
        $product->is_featured=$request->is_featured;
        $product->created_by=Auth::user()->id;
        $product->modify_by=Auth::user()->id;
        $v=$product->save();
        if($v)
        {
            Session::flash('alert-success', 'Product added!');
                        return redirect('admin/products');
        }
        // Product::create($requestData);

        // return redirect('admin/products')->with('flash_message', 'Product added!');
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
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
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
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product'));
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
            'name'=>'required|alphaNum',
            'sku'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'price'=>'required|regex:/^\d*(\.\d{2})?$/',
            'special_price'=>'required|regex:/^\d*(\.\d{2})?$/',
            'special_price_from'=>'required|date',
            'special_price_to'=>'required|date',
            'status'=>'required',
            'quantity'=>'required|Integer',
            'meta_title'=>'required',
            'meta_description'=>'required',
            'meta_keywords'=>'required',
            'is_featured'=>'required',
        ]);        
        $product = Product::findOrFail($id);
        $product->name=$request->name;
        $product->sku=$request->sku;
        $product->short_description=$request->short_description;
        $product->long_description=$request->long_description;
        $product->price=$request->price;
        $product->special_price=$request->special_price;
        $product->special_price_from=$request->special_price_from;
        $product->special_price_to=$request->special_price_to;
        $product->status=$request->status;
        $product->quantity=$request->quantity;
        $product->meta_title=$request->meta_title;
        $product->meta_description=$request->meta_description;
        $product->meta_keywords=$request->meta_keywords;
        $product->is_featured=$request->is_featured;
        $product->modify_by=Auth::user()->id;
        $v=$product->save();
        if($v)
        {
            Session::flash('alert-success', 'Product Updated!');
            return redirect('admin/products');
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
        Product::destroy($id);

        return redirect('admin/products')->with('flash_message', 'Product deleted!');
    }
}
