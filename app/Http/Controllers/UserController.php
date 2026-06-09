<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function adminIndex()
    {
        return view('admin.users.index');
    }
}
