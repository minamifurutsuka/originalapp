<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//多対多のリレーション
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Group extends Model
{
    use HasFactory;
    
    // validation
    protected $guarded = array('id');

    public static $rules = array(
        //nameは必須
        'name' => 'required',
    );
    
    //多対多のリレーション
    public function users()
    {
        //belongsToMany→laravelで１対多を表すメソッド
        return $this->belongsToMany('App\Models\User', 'group_users');
    }
    
    public function plan()
    {
        return $this->hasOne(Plan::class);
    }
}
