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
        'rating' => 'required|integer|min:1|max:5',
        'content' => 'required',
    );
    
    public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'likes','review_id','user_id');
    }
    
    public function is_liked(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
