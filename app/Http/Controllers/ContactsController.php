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
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ContactsController extends Controller
{
    public function index(): View|Factory|Application
    {
        return view('pages.contacts', [
            'SEOData' => new SEOData(
                title: 'Contacts',
                description: ''
            ),
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function store(StoreContactRequest $request, CaptchaService $captchaService): RedirectResponse
    {
        if (! $captchaService->verifyRequest($request->all())) {
            return redirect()->back()->withErrors(['You did not pass the robot check'])->withInput();
        }
        $data = $request->all();
        $data['captcha_score'] = $captchaService->getScore();
        ContactRequest::create($data);

        return redirect()->route('contacts.index')->with('success', 'Your message has been sent!');
    }

    public function cookiePolicy()
    {
        return \view('pages.cookie-policy', [
            'SEOData' => new SEOData(
                title: 'Cookie policy', description: 'Cookie policy'
            ),
        ]);
    }

    public function privacyPolicy()
    {
        return \view('pages.privacy-policy', [
            'SEOData' => new SEOData(
                title: 'Privacy policy', description: 'Privacy policy'
            ),
        ]);
    }

    public function terms()
    {
        return \view('pages.terms', [
            'SEOData' => new SEOData(
                title: 'Terms & conditions', description: 'Terms and conditions'
            ),
        ]);
    }
}
