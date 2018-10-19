<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
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
            $categories = Category::latest()->paginate($perPage);
        } else {
            $categories = Category::latest()->paginate($perPage);
        }

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
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
                'name'=>'required',
                'parent_category'=>'required'

        ]);
        $cat= new Category();
        $cat->name=$request->name;
        $cat->parent_id=$request->parent_category;
        $cat->created_by=Auth::user()->id;
        $cat->modify_by=Auth::user()->id;
        $v=$cat->save();
        if($v)
        {
            Session::flash('alert-success', 'Category added!');
            return redirect('admin/categories');
        }

        // $requestData = $request->all();
        
        // Category::create($requestData);

        // return redirect('admin/categories')->with('flash_message', 'Category added!');
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
        $category = Category::findOrFail($id);

        return view('admin.categories.show', compact('category'));
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
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
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
                'name'=>'required',
                'parent_category'=>'required'

        ]);
       
        $cat = Category::findOrFail($id);
        $cat->name=$request->name;
        $cat->parent_id=$request->parent_category;
        $cat->modify_by=Auth::user()->id;
        $v=$cat->save();
        if($v)
        {
            Session::flash('alert-success', 'Category updated!');
            return redirect('admin/categories');
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
        Category::destroy($id);

        return redirect('admin/categories')->with('flash_message', 'Category deleted!');
    }

   static function getCategoryTree($id)
    {  
        
        $parent_id;
        $categories1=array();
        $category= DB::table('categories')->where(function ($query) use ($id){
                    $query->where('id','=', $id);
                    // $query->where('id','=', $id);
                    })->get();
        foreach($category as $cate)
        {  
                $name= $cate->name;
                array_push($categories1,$name);
                $parent_id=$cate->parent_id;
        }
        while($parent_id!=0)
        {
            $category1=DB::table('categories')->where(function ($query) use ($parent_id){
                    $query->where('id','=', $parent_id);
                    // $query->where('id','=', $id);
                    })->get();
               foreach($category1 as $cate1)
                {  
                        $name= $cate1->name;
                        array_unshift($categories1,$name);
                        $parent_id=$cate1->parent_id;
                }
        }
        print_r($categories1);
        exit();
    //     return view('admin.categories.index', compact('categories1'));
   
        // return view('admin.categories.demo', compact('categories'));
       
    }
}