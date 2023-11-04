<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactRequest;

class ContactsController extends Controller
{
    public function index()
    {
        return view('pages.contacts');
    }

    public function store(StoreContactRequest $request)
    {
        ContactRequest::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Your message has been sent!');
    }
}
