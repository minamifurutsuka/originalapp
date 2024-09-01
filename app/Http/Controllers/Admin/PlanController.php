<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    //add関数 admin/profileディレクトリ配下のcreate.blade.php というファイルを呼び出す
    public function add ()
    {
        return view('admin.plan.create');
    }
    //create関数
    public function create()
    {
        return redirect('admin/plan/create');
    }
    //edit関数
    public function edit()
    {
        return view('admin.plan.edit');
    }
    //update関数
    public function update()
    {
        return redirect('admin/plan/edit');
    }
}
