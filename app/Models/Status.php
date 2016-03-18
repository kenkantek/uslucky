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

    //BEGIN new Status
    public function withStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function publish()
    {
        $this->save();
        return $this;
    }
    //END NEW Status
}
