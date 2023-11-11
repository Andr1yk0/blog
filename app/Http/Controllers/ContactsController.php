<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactRequest;
use App\Services\CaptchaService;

class ContactsController extends Controller
{
    public function index()
    {
        return view('pages.contacts');
    }

    public function store(StoreContactRequest $request, CaptchaService $captchaService)
    {
        if(!$captchaService->verifyRequest($request->all())){
            return redirect()->back()->withErrors(['You did not pass the robot check'])->withInput();
        }
        ContactRequest::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Your message has been sent!');
    }
}
