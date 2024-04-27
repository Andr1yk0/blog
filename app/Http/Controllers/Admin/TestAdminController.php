<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TestAdminController extends Controller
{
    public function index(): View|Factory|Application
    {
        return view('admin.tests.index');
    }
}
