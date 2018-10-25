<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BannerController extends Controller
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
            $banners = Banner::latest()->paginate($perPage);
        } else {
            $banners = Banner::latest()->paginate($perPage);
        }
        return view('admin.banners.index', compact('banners'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.banners.create');
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
        'banner_name'   =>'required|alphaNum|min:3',
        'banner_image'  =>'mimes:jpeg,jpg,png,gif|required',
        'status'        =>'required'
        ]);
        $banner= new Banner();
        $banner->banner_name=$request->banner_name;
        $banner_path=$request->banner_image->getClientOriginalName();
        $banner->banner_path=$banner_path;
        $request->banner_image->storeAs('public/uploads',$banner_path );
        $banner->status=$request->status;
        $banner->save();
       if($banner)
       {
        Session::flash('alert-success', 'Banner added!');
        return redirect('admin/banners');
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
        $banner = Banner::findOrFail($id);

        return view('admin.banners.show', compact('banner'));
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
        $banner = Banner::findOrFail($id);

        return view('admin.banners.edit', compact('banner'));
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
        'banner_name'   =>'required|alphaNum|min:3',
        'banner_image'  =>'mimes:jpeg,jpg,png,gif',
        'status'        =>'required'
       ]);
        $banner = Banner::findOrFail($id);
        $banner_path=$banner->banner_path;
        if($request->hasFile('banner_image'))
        {
            $banner_path= $request->banner_image->getClientOriginalName();
            $request->banner_image->storeAs('public/uploads',$banner_path);
        }
        $banner->banner_path=$banner_path;
        $banner->banner_name=$request->banner_name;
        $banner->status=$request->status;
        $banner->save();;
        if($banner)
        {
            Session::flash('alert-success', 'Banner updated!');
            return redirect('admin/banners');
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
        Banner::destroy($id);
        return redirect('admin/banners')->with('flash_message', 'Banner deleted!');
    }
}
