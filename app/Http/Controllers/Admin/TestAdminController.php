<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class TestAdminController extends Controller
{
    public function index(): View|Factory|Application
    {
        return view('admin.tests.index');
    }
}
