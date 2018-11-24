<?php

namespace App\Http\Controllers;

use Mail;
use App\Email_template;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contact_us;
use Illuminate\Http\Request;

class ContactUsController extends Controller
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
            $contactus = Contact_us::latest()->paginate($perPage);
        } else {
            $contactus = Contact_us::latest()->paginate($perPage);
        }

        return view('admin.contact-us.index', compact('contactus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.contact-us.create');
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
        
        $requestData = $request->all();
        
        Contact_us::create($requestData);

        return redirect('admin/contactUs')->with('flash_message', 'Contact_us added!');
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
        $contactus = Contact_us::findOrFail($id);

        return view('admin.contact-us.show', compact('contactus'));
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
        $contactus = Contact_us::findOrFail($id);

        return view('admin.contact-us.edit', compact('contactus'));
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
        
        $contactus = Contact_us::findOrFail($id);
        $contactus->update($requestData);

        return redirect('admin/contactUs')->with('flash_message', 'Contact_us updated!');
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
        Contact_us::destroy($id);

        return redirect('admin/contactUs')->with('flash_message', 'Contact_us deleted!');
    }

    public function replyToCustomer(Request $request)
    {
        $validate=$request->validate([           
            "adminComment"=>"required",
        ]);
        $emailId=$request->customerEmail;       
        $contactus=Contact_us::findOrFail($request->id);
        $contactus->note_admin=$request->adminComment;
        $contactus->save();
        if($contactus)
        {
            $subject="";
            $content="";
            $ipAddress=$this->getRealIpAddr();
            $template=Email_template::where('title','=','adminComment')->get();
            foreach($template as $email)
            {
                $subject=$email->subject;
                $content=$email->content;
            }
            $content=str_replace("{customerName}",$contactus->name,$content);
            $content=str_replace("{customerEmail}",$contactus->email,$content);
            $content=str_replace("{customerContact}",$contactus->contact_no,$content);
            $content=str_replace("{customerMessage}",$contactus->message,$content);
            $content=str_replace("{adminComment}",$request->adminComment,$content);
            $content=str_replace("{ip}",$ipAddress,$content);
            Mail::send([],[], function($message) use ($content,$subject,$request,$emailId)
            {
                $message->to($emailId)->subject($subject)->setBody($content, 'text/html');
            });
            return redirect('admin/contactUs');
        }
    }
    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
