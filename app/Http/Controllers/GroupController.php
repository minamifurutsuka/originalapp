<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\History;
use Auth;
use Carbon\Carbon;

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
        
        // 選択されたユーザーが存在するかチェック
        $selected_user = $form['selected_user'] ?? [];
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        unset($form['selected_user']);
        
        // データベースに保存する
        $group->fill($form);
        $group->save();
        
        // ユーザーをグループに追加
        $selected_users = $request->input('selected_users', []); // 'selected_user' が空の場合は空配列
        $selected_users[] = Auth::id(); // 自分も追加
        $group->users()->sync($selected_users);
        
        return view('user.plan.create', ['group_id' => $group->id]);
    }
    
    //編集する
    public function edit($id)
        {
            // 対象のグループを取得
            $group = Group::with('users')->find($id);
            if (empty($group)) {
                abort(404);
            }
        
            // フォローしているユーザーを取得
            $following_users = Auth::user()->following;
        
            return view('group.edit', [
                'group' => $group,
                'following_users' => $following_users
            ]);
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
        
        // メンバーの更新
        $selected_users = $request->input('selected_users', []);
        $selected_users[] = Auth::id();
        $group->users()->sync($selected_users); // メンバーを同期
    
        return redirect()->route('groups')->with('success', 'グループが更新されました。');
    }
        
    //グループを削除する
    public function delete(Request $request)
    {
        //$request を引数に追加し、$request->id を使用して対象のグループを取得
        $group = Group::find($request->id);
        if ($group) {
            $group->delete();
        }
        return redirect('group/create');
    }
    
    //一覧表示
    public function index(Request $request)
    {
        // 検索条件を取得
        $cond_title = $request->cond_title;
    
        // 検索条件がある場合は条件に基づいて取得、ない場合はすべてのグループを取得
        if (!empty($cond_title)) {
            // 部分一致検索を行う
            $groups = Group::where('title', 'LIKE', "%$cond_title%")->with('users')->get();
        } else {
            // 検索条件がない場合はすべてのグループを取得
            $groups = Group::with('users')->get();
        }
    
        // ビューに groups 変数と検索条件を渡して表示
        return view('group.index', ['groups' => $groups, 'cond_title' => $cond_title]);
    }
    
    
}
