<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['status'];

    public $timestamps = false;

    public function statusable()
    {
        return $this->morphTo();
    }

    public function withStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function regarding($object)
    {
        if (is_object($object)) {
            $this->statusable_id   = $object->id;
            $this->statusable_type = get_class($object);
        }
        return $this;
    }
}
