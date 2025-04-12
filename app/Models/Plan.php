<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'date' => 'required',
        'plane' => 'required',
        'hotel' => 'required',
        'restaurant' => 'required',
        'spot' => 'required',
    );
    
    // history Modelとplan Modelの関連付けを行う
    public function histories()
    {
        return $this->hasMany('App\Models\History');
    }
    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
