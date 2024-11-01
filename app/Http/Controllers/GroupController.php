<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Auth;

class GroupController extends Controller
{
    //
    public function add()
    {
        return view('group.create',['following_users' =>Auth::user()->following]);
    }
    
    public function create(Request $request)
    {
        // Validationを行う
        $this->validate($request, Group::$rules);
        
        $group = new Group;
        $form = $request->all();
        $selected_user = $form['selected_user'];
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        unset($form['selected_user']);
        
        // データベースに保存する
        $group->fill($form);
        $group->save();
        //グループとユーザーを紐づける
        $selected_user[]=Auth::id();
        $group->users()->attach($selected_user);
        
        return redirect('group/create');
    }
    
    //編集する
    public function edit()
    {
        // Group Modelからデータを取得する
        $group = Group::find($request->id);
        if (empty($group)) {
            abort(404);
        }
        return view('group.edit');
    }
    
    //update action→編集画面から送信されたフォームデータを処理する
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Group::$rules);
        // Group Modelからデータを取得する
        $group = Group::find($request->id);
        // 送信されてきたフォームデータを格納する
        $group_form = $request->all();
        unset($group_form['remove']);
        unset($group_form['_token']);

        // 該当するデータを上書きして保存する
        $group->fill($group_form)->save();
        
        // Plan Modelを保存するタイミングで、同時に History Modelにも編集履歴を追加する.
        $history = new History();
        $history->group_id = $group->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
        return redirect('group/edit');
    }
    
    public function delete()
    {
        return redirect('group/create');
    }
    
    //一覧表示
    public function index()
    {
        //$cond_titleに値を代入する→$requestの中のcond_titleの値を$cond_titleに代入する
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $group = Group::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのレビューを取得する
            $group = Group::all();
        }
        $group = Group::all();
        
        //Group の一覧に複数タグをリレーションさせるためには、with を使う
        $group = Group::with('users')->get();
        //dd($posts);
        return view('groups');
    }
}
