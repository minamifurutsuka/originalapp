<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * リレーション（1対多）
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    //リレーションの設定
    public function contacts() // 複数形
    {
        return $this->hasMany('App\Models\Contact');
    }
    
    //多対多のリレーション
    public function groups()
    {
        //belongsToMany→laravelで１対多を表すメソッド
        return $this->belongsToMany('App\Models\Group', 'group_users');
    }
    
    //自分がフォローしているユーザー
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows','following', 'followed');
    }

    //自分のことをフォローしているユーザー
    public function followed()
    {
        return $this->belongsToMany(User::class, 'follows','followed','following');
    }
    
    // 特定のユーザーにフォローされているか確認
    public function isFollowedBy(User $user)
    {
        return $this->followed()->where('following', $user->id)->exists();
    }
    
    //ユーザーのレビュー
    public function reviews() // 複数形
    {
        return $this->hasMany('App\Models\Review');
    }
    
    public function likes()
    {
        return $this->belongsToMany('App\Models\Review', 'likes','user_id','review_id');
    }
    
    //ユーザーが「いいね」したレビューを取得するリレーション
    public function likedReviews()
    {
        return $this->belongsToMany('App\Models\Review', 'likes', 'user_id', 'review_id');
    }
}
