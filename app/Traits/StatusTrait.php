<?php

namespace App\Traits;

use App\Models\Status;

trait StatusTrait
{
    public function updateOrNewStatus($status = null)
    {
        if (!$status instanceof Status) {
            $status = new Status;
            $status->statusable()->associate($this);
        }
        return $status;
    }
}
