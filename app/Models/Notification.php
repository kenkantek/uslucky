<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $appends = ['url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notificationable()
    {
        return $this->morphTo();
    }

    // NEW NOTIFICATION
    public function withSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }
    public function withBody($body)
    {
        $this->body = $body;
        return $this;
    }
    public function withObjectType($object)
    {
        $this->notificationable()->associate($object);
        return $this;
    }
    public function withIsRead()
    {
        $this->is_read = true;
        return $this;
    }
    public function publish()
    {
        $this->save();
        return $this;
    }
    // END NEW NOTIFICATION

    public function updateIsRead()
    {
        $this->is_read = true;
        return $this->publish();
    }

    public function getCreatedAtAttribute($date)
    {
        Carbon::setLocale('zh');
        return Carbon::parse($date)->diffForHumans();
    }

    public function getUrlAttribute()
    {
        $object = $this->notificationable()->first();
        if ($object instanceof Order) {
            return $object->url;
        }
        return 'javascript:;';
    }
}
