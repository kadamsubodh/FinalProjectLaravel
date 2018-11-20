<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Email_template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class EmailTemplateController extends Controller
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
            $email_templates = Email_template::latest()->paginate($perPage);
        } else {
            $email_templates = Email_template::latest()->paginate($perPage);
        }

        return view('admin.email_templates.index', compact('email_templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.email_templates.create');
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
            'title'=>'required',
            'subject'=>"required|max:250",
            'content'=>'required|max:1000'
        ]);
        $emailTemplate = new Email_template();
        $emailTemplate->title=$request->title;
        $emailTemplate->subject=$request->subject;
        $emailTemplate->content=$request->content;
        $emailTemplate->created_by=Auth::user()->id;
        $emailTemplate->modify_by=Auth::user()->id;
        $emailTemplate->save(); 
        if($emailTemplate)
        {
            Session::flash('alert-success', 'Product added!');
            return redirect('admin/email_templates');
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
        $email_template = Email_template::findOrFail($id);

        return view('admin.email_templates.show', compact('email_template'));
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
        $email_template = Email_template::findOrFail($id);

        return view('admin.email_templates.edit', compact('email_template'));
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
        
       $validate=$rerquest->validate([
            'title'=>'required',
            'subject'=>"required|max:250",
            'content'=>'required|max:1000'
        ]);
        $emailTemplate=Email_template::findOrFail($id);
        $emailTemplate->title=$request->title;
        $emailTemplate->subject=$request->subject;
        $emailTemplate->content=$request->content;
        $emailTemplate->save(); 
        if($emailTemplate)
        {
            Session::flash('alert-success', 'Product added!');
            return redirect('admin/email_templates');
        }
       

        return redirect('admin/email_templates')->with('flash_message', 'Email_template updated!');
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
        Email_template::destroy($id);

        return redirect('admin/email_templates')->with('flash_message', 'Email_template deleted!');
    }
}
