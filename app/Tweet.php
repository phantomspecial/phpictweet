<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'text' => 'required',
        'image' => 'required'
    );

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
