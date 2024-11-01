<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//ネームスペースとクラス名を繋げて書く
use App\Models\ContactTitle;

class ContactTitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() //runメソッド→Seederを実行した時に処理されるメソッド
    {
        //
        ContactTitle::create([
        'id' => 1,
        //migrationファイルに合わせる
        'title' => 'ユーザー登録に関して',
       ]);

       ContactTitle::create([
        'id' => 2,
        'title' => '予定に関して',
       ]);
       
       ContactTitle::create([
        'id' => 3,
        'title' => '口コミに関して',
       ]);
       
       ContactTitle::create([
        'id' => 4,
        'title' => '退会方法に関して',
       ]);
    }
}
