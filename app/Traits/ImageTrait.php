<?php

namespace App\Traits;

use App\Models\Image;

trait ImageTrait
{
    public function newImage()
    {
        $image = new Image;
        $image->imageable()->associate($this);
        return $image;
    }
}
