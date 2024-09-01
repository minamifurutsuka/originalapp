<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    
    public static $rules = array(
        //required=必須の項目
        'place' => 'required',
        //integer=数値　１〜５までの数字しか入力できない
        'evaluation' => 'required|integer|min:1|max:5',
        'content' => 'required',
    );
}
