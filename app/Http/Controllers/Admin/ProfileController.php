<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //add関数
    public function add ()
    {
        return view('admin.profile.create');
    }
    //create関数
    public function create()
    {
        return redirect('admin/profile/create');
    }
    //edit関数
    public function edit()
    {
        return view('admin.profile.edit');
    }
    //update関数
    public function update()
    {
        return redirect('admin/profile/edit');
    }
}
