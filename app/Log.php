<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'page', 'old', 'new', 'discription', 'user_id'
    ];
}
