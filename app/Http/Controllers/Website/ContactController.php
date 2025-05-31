<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\ContactUs;

class ContactController extends Controller
{
    public function index()
    {
        return view('website.pages.contact.index');
    }

    public function store(ContactRequest $request)
    {
       $data = $request->validated();
       ContactUs::create($data);
       return redirect()->back()->with(['success' => __('website/contact.your_message_send_successfully')]);
    }
}
