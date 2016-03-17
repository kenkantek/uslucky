<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'message', 'reply_content',
    ];

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return route('backend::admin.contact.detail', $this->id);
    }
}
