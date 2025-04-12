<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactTitle;
use App\Models\Contact;
use Auth;

class ContactController extends Controller
{
    //
    public function add()
    {
        //ContactTitleから引っ張ってくるため
        $contact_titles = ContactTitle::all();
        return view('contact.create', compact('contact_titles'));
    }
   
   //お問い合わせの作成
    public function create(Request $request)
    {
        // Validationを行う
        $this->validate($request, Contact::$rules);
        
        $contact = new Contact;
        $form = $request->all();
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        $contact->user_id = Auth::id();
        
        // データベースに保存する
        $contact->fill($form);
        $contact->save();
        
        // contact/createにリダイレクトする
        return redirect('contact/create');
    }
    
    //一覧表示
    public function index(Request $request)
    {
        //ログインしているユーザーのcontactプロパティを参照する
        $contacts = Auth::user()->contacts;
        return view('contact.index', compact('contacts'));
    }
    
    //全容を表示する
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact.show', compact('contact'));
    }
}
