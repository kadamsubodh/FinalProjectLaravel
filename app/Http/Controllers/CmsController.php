<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Cms;
use Auth;
use Illuminate\Http\Request;

class CmsController extends Controller
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
            $cms = Cms::latest()->paginate($perPage);
        } else {
            $cms = Cms::latest()->paginate($perPage);
        }

        return view('admin.cms.index', compact('cms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.cms.create');
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
            "title"=>"required",
            "content"=>"required",
            "meta_title"=>"required",
            "meta_description"=>"required",
            "meta_keywords"=>"required",
        ]);

        $cms=new Cms();
        $cms->title=$request->title;
        $cms->content=$request->content;
        $cms->meta_title=$request->meta_title;
        $cms->meta_description=$request->meta_description;
        $cms->meta_keywords=$request->meta_keywords;
        $cms->created_by=Auth::user()->id;
        $cms->modify_by=Auth::user()->id;
        $cms->save();
        if($cms)
        {
            Session::flash('alert-success', "page created successfully!!");
            return redirect('/admin/cms');
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
        $cm = Cms::findOrFail($id);

        return view('admin.cms.show', compact('cm'));
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
        $cm = Cms::findOrFail($id);

        return view('admin.cms.edit', compact('cm'));
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
        
        $validate=$request->validate([
            "title"=>"required",
            "content"=>"required",
            "meta_title"=>"required",
            "meta_description"=>"required",
            "meta_keywords"=>"required",
        ]);

        $cms=Cms::findOrFail($id);
        $cms->title=$request->title;
        $cms->content=$request->content;
        $cms->meta_title=$request->meta_title;
        $cms->meta_description=$request->meta_description;
        $cms->meta_keywords=$request->meta_keywords;
        $cms->created_by=Auth::user()->id;
        $cms->modify_by=Auth::user()->id;
        $cms->save();
        if($cms)
        {
            Session::flash('alert-success', "page updated successfully!!");
            return redirect('/admin/cms');
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
        Cms::destroy($id);

        return redirect('admin/cms')->with('flash_message', 'Cms deleted!');
    }
    public function cms(Request $request)
    {
        $cms=Route::current()->parameter('cms');
        $cms=Cms::where('title','=',$cms)->get();
        return view('frontend.aboutEshopers',compact('cms'));
    }
}
