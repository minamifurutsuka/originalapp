<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Plan;
use Carbon\Carbon; //carbonの使用を宣言する（carbon→現在時刻を取得するhistorymodelで使用）
use App\Models\History; //history Modelの使用を宣言する

class PlanController extends Controller
{
    //
    public function add()
    {
        return view('user.plan.create');
    }
    
     // 
    public function create(Request $request)
    {
        // Validationを行う
        $this->validate($request, Plan::$rules);
        
        $plan = new Plan;
        $form = $request->all();
        
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
         // ログインユーザーIDをセット
        $plan->user_id = Auth::id();
        
        // データベースに保存する
        $plan->fill($form);
        $plan->save();
        
        // plan/createにリダイレクトする
        return redirect('user/plan/create');
    }
    
    public function index(Request $request)
    {
        // 検索条件のタイトルを取得
        $cond_title = $request->cond_title;
        
        // 検索条件がある場合は検索結果を取得
        if (!empty($cond_title)) {
            // ログインユーザーのプランの中でタイトルが一致するものを検索
            $plans = Plan::where('title', 'like', '%' . $cond_title . '%')
                         ->where('user_id', Auth::id()) // ログイン中のユーザーに限定する
                         ->get();
        } else {
            // それ以外はログインユーザーのすべてのプランを取得
            $plans = Plan::where('user_id', Auth::id())->get();
        }
        
        // ビューにプランリストと検索条件を渡す
        return view('user.plan.index', [
            'plans' => $plans, // 検索結果もしくは全プラン
            'cond_title' => $cond_title // 検索条件
        ]);
    }
    
    //編集する
    public function edit(Request $request)
    {
        // Plan Modelからデータを取得する
        $plan = Plan::find($request->id);
        if (empty($plan)) {
            abort(404);
        }
        return view('user.plan.edit', ['plan_form' => $plan]);
    }

    //update action→編集画面から送信されたフォームデータを処理する
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Plan::$rules);
        // Plan Modelからデータを取得する
        $plan = Plan::find($request->id);
        // 送信されてきたフォームデータを格納する
        $plan_form = $request->all();
        unset($plan_form['remove']);
        unset($plan_form['_token']);

        // 該当するデータを上書きして保存する
        $plan->fill($plan_form)->save();
        
        // Plan Modelを保存するタイミングで、同時に History Modelにも編集履歴を追加する.
        $history = new History();
        $history->plan_id = $plan->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('user.plans');
    }
    
    //計画を削除する
    public function delete(Request $request)
    {
        // 該当するPlan Modelを取得
        $plan = Plan::find($request->id);

        // 削除する
        $plan->delete();

        return redirect('user/plans');
    }
}
