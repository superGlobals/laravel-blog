<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function index()
    {
        return view('back.pages.home');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('author.login');
    }
}
