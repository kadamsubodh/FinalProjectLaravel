<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Configuration_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class configurationController extends Controller
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
            $configurations = Configuration_table::latest()->paginate($perPage);
        } else {
            $configurations = Configuration_table::latest()->paginate($perPage);
        }

        return view('configurations.index', compact('configurations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('configurations.create');
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
           'conf_key'=>'required',
           'conf_value'=>'required',
           'status'=>'required' 
       ]);
       $conf=new Configuration_table();
       $conf->conf_key=$request->conf_key;
        $conf->conf_value=$request->conf_value;
        $conf->status=$request->status;
        $conf->created_by=Auth::user()->id;
        $conf->modify_by=Auth::user()->id;
        $v=$conf->save();
        if($v)
        {
            Session::flash('alert-success', 'Configuration added!');
        return redirect('admin/configurations');
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
        $configuration = Configuration_table::findOrFail($id);

        return view('configurations.show', compact('configuration'));
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
        $configuration = Configuration_table::findOrFail($id);

        return view('configurations.edit', compact('configuration'));
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
           'conf_key'=>'required',
           'conf_value'=>'required',
           'status'=>'required' 
       ]);
        $conf = Configuration_table::findOrFail($id);
        $conf->conf_key=$request->conf_key;
        $conf->conf_value=$request->conf_value;
        $conf->status=$request->status;
        $conf->modify_by=Auth::user()->id;
        $v=$conf->save();
        if($v)
        {
            Session::flash('alert-success', 'Configuration updated!');

        return redirect('admin/configurations');
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
        Configuration_table::destroy($id);
        Session::flash('alert-success', 'Configuration Deleted!');

        return redirect('admin/configurations');
    }
}
