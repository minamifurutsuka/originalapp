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
        
        //グループとユーザーを紐づける
        $selected_user[]=Auth::id();
        $group->users()->attach($selected_user);
        
        return redirect('group/create');
    }
    
    //編集する
    public function edit(Request $request)
    {
        // Group Modelからデータを取得する
        $group = Group::find($request->id);
        if (empty($group)) {
            abort(404);
        }
        return view('group.edit', compact('group'));
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
        //$cond_titleに値を代入する→$requestの中のcond_titleの値を$cond_titleに代入する
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $group = Group::where('title', $cond_title)->with('users')->get();
        } else {
            // それ以外はすべてのレビューを取得する
            $group = Group::all();
        }
        
        //Group の一覧に複数タグをリレーションさせるためには、with を使う
        $groups = Group::with('users')->get();
        
        //dd($posts);
        return view('groups', ['groups' => $groups, 'cond_title' => $cond_title]);
    }
}
