<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactRequest;
use App\Services\CaptchaService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactsController extends Controller
{
    public function index(): View|Factory|Application
    {
        return view('pages.contacts');
    }

    /**
     * @throws GuzzleException
     */
    public function store(StoreContactRequest $request, CaptchaService $captchaService): RedirectResponse
    {
        if(!$captchaService->verifyRequest($request->all())){
            return redirect()->back()->withErrors(['You did not pass the robot check'])->withInput();
        }
        ContactRequest::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Your message has been sent!');
    }
}
