<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Product;
use App\Product_image;
use App\Product_attribute_value;
use App\Product_attribute_assoc;
use Illuminate\Http\Request;
use App\Product_category;
use DB;
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
        // $formData=$request->formData;
        $attributeLength=count($request->Attribute_name);
        $validate=$request->validate([
            'name'=>'required|alphaNum',
            'category'=>'required',
            'sku'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'price'=>'required|regex:/^\d*(\.\d{2})?$/',
            'special_price'=>'required|regex:/^\d*(\.\d{2})?$/',
            'special_price_from'=>'required|date',
            'special_price_to'=>'required|date|after_or_equal:special_price_from',
            'status'=>'required',
            'quantity'=>'required|Integer',
            'meta_title'=>'required',
            'meta_description'=>'required',
            'meta_keywords'=>'required',
            'is_featured'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png|max:10000',
            // 'Attribute_name'=>'array|min:'.$attributeLength,
            // 'Attribute_name.*'=>'required',
            'Attribute_value'=>'array|min:'.$attributeLength,
            'Attribute_value.*'=>'required',
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
        $product->save();
        if($product)
        {
          
            $productCat=new Product_category();
            $productCat->product_id=$product->id;
            $productCat->category_id=$request->category;
            $productCat->save();

            if($request->hasFile('image'))
            {
                $filename=$request->image->getClientOriginalName();
                $request->image->storeAs('public/uploads', $filename);
                $filepath="/storage/uploads/".$filename;
                $image=new Product_image();
                $image->image_name=$filename;
                $image->product_id=$product->id;
                $image->status=$request->image_status;
                $image->created_by=Auth::user()->id;
                $image->modify_by=Auth::user()->id;
                $image->save();
            }           
            // $count=count($request->Attribute_name);
            //  echo $count;
            //   echo '<pre>';
            // print_r($request->Attribute_name);
            // exit();
            foreach($request->Attribute_name as $key => $value) {
                $attributeValue=new Product_attribute_value();
                $attributeValue->product_attribute_id=$value;
                $attributeValue->attribute_value=$request->Attribute_value[$key];
                $attributeValue->created_by=Auth::user()->id;
                $attributeValue->modify_by=Auth::user()->id;
                $attributeValue->save();
                if($attributeValue) {
                    $productAttributeValueAssoc=new Product_attribute_assoc();
                    $productAttributeValueAssoc->product_id=$product->id;
                    $productAttributeValueAssoc->product_attribute_id=$request->Attribute_name[$key];
                    $productAttributeValueAssoc->product_attribute_value_id=$attr->id;
                    $productAttributeValueAssoc->save();
                    
                }
            }
            if($productAttributeValueAssoc)
            {
                Session::flash('alert-success', 'Product added!');
                return redirect('admin/products');
            }
        }
    }

            // for($i=0;$i<$count;$i++)
            // {
            //     $attr=new Product_attribute_value();
            //     $attr->product_attribute_id=$request->Attribute_name[$i];
            //     $attr->attribute_value=$request->Attribute_value[$i];
            //     $attr->created_by=Auth::user()->id;
            //     $attr->modify_by=Auth::user()->id;
            //     $save=$attr->save();
            //     if($save)
            //     {
            //         $attributeValue=DB::table('product_attribute_values')->where('id', DB::raw("(select max(`id`) from product_attribute_values)"))->get();
            //         foreach($attributeValue as $att)
            //         {
            //             $attributeValueId=$att->id;
            //         }
            //         $assoc=new Product_attribute_assoc();
            //         $assoc->product_id=$productId;
            //         $assoc->product_attribute_id=$request->Attribute_name[$i];
            //         $assoc->product_attribute_value_id=$attributeValueId;
            //         $save=$assoc->save();
            //         if($save)
            //         {
            //             Session::flash('alert-success', 'Product added!');
            //             return redirect('admin/products');
            //         }
                   
            //     }
            // }
            
               
  

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
        $attributeLength=count($request->Attribute_name);
        $validate=$request->validate([
            'name'=>'required|alphaNum',
            'category'=>'required',
            'sku'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'price'=>'required|regex:/^\d*(\.\d{2})?$/',
            'special_price'=>'required|regex:/^\d*(\.\d{2})?$/',
            'special_price_from'=>'required|date',
            'special_price_to'=>'required|date|after_or_equal:special_price_from',
            'status'=>'required',
            'quantity'=>'required|Integer',
            'meta_title'=>'required',
            'meta_description'=>'required',
            'meta_keywords'=>'required',
            'is_featured'=>'required',
            'image'=>'mimes:jpeg,jpg,png|max:10000',
            'Attribute_value'=>'array|min:'.$attributeLength,
            'Attribute_value.*'=>'required',
        ]);
        $product= Product::findOrFail($id);
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
        $product->save();
        if($product)
        {
          
            $productCat=DB::table('product_categories')->where('product_id', $id)->update(['category_id'=>$request->category]);;

            $productImage=DB::table('product_images')->where('product_id', $id)->get();
            foreach($productImage as $productImageName)
            {
                $filename=$productImageName->image_name;
            }
            if($request->hasFile('image'))
            {
                $filename=$request->image->getClientOriginalName();
                $request->image->storeAs('public/uploads', $filename);
                $filepath="/storage/uploads/".$filename;
            }
               
            $updateProductImage=DB::table('product_images')->where('product_id', $id)->update(
                ['image_name'=>$filename,'status'=>$request->image_status,'modify_by'=>Auth::user()->id]);
            // foreach($productImage as $productImageName)
            // ->image_name=$filename;
            // $productImage->status=$request->image_status;
            // $productImage->modify_by=Auth::user()->id;
            // $productImage->save();         
            
            $attributeValueAssoc=DB::table('product_attribute_assocs')->where('product_id', $id)->get();
            foreach($attributeValueAssoc as $attributeValue)
                {
                    $deleteAttributeValue=DB::delete('delete from product_attribute_values where id=?',[$attributeValue->product_attribute_value_id]);
                }
            if($deleteAttributeValue)
            {
                foreach($request->Attribute_name as $key => $value) {
                    $attributeValue=new Product_attribute_value();
                    $attributeValue->product_attribute_id=$value;
                    $attributeValue->attribute_value=$request->Attribute_value[$key];
                    $attributeValue->created_by=Auth::user()->id;
                    $attributeValue->modify_by=Auth::user()->id;
                    $attributeValue->save();
                    if($attributeValue) {
                        $productAttributeValueAssoc=new Product_attribute_assoc();
                        $productAttributeValueAssoc->product_id=$product->id;
                        $productAttributeValueAssoc->product_attribute_id=
                            $request->Attribute_name[$key];
                        $productAttributeValueAssoc->product_attribute_value_id=$attr->id;
                        $productAttributeValueAssoc->save();    
                    }
                }
                if($assoc) {
                    Session::flash('alert-success', 'Product Updated!');
                    return redirect('admin/products');
                }
            }
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
        $attributeValueAssoc=DB::table('product_attribute_assocs')->where('product_id', $id)->get();
        foreach($attributeValueAssoc as $attributeValue)
            {
                $deleteAttributeValue=DB::delete('delete from product_attribute_values where id=?',[$attributeValue->product_attribute_value_id]);
            }
        Product::destroy($id);
        return redirect('admin/products')->with('flash_message', 'Product deleted!');
    }
}
