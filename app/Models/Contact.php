<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    
    public static $rules = array(
        'contact_title_id' => 'required',
        'content' => 'required',
    );
    
    //
    public function contact_title()
    {
        return $this->belongsTo('App\Models\ContactTitle');
    }
    
}
