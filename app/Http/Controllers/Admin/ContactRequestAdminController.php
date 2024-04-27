<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ContactRequestAdminController extends Controller
{
    public function index()
    {
        $query = ContactRequest::query();
        $contactRequests = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name', 'email', 'created_at'])
            ->defaultSort('-id')
            ->paginate(10)
            ->appends(request()->query());

        return view('admin.contact-requests.index', compact('contactRequests'));
    }

    public function destroy(ContactRequest $contactRequest): RedirectResponse
    {
        $contactRequest->delete();

        return redirect()
            ->route('admin.contact-requests.index')
            ->with('success', 'Contact request has been deleted!');
    }
}
