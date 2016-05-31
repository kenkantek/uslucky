<?php

namespace App\Traits;

use App\Models\Image;

trait ImageTrait
{
    public function newImage(Image $image = null)
    {
        if (!$image instanceof Image) {
            $image = new Image;
            $image->imageable()->associate($this);
        }
        return $image;
    }
}
