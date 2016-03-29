<?php

namespace App\Models;

use File;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image extends Model
{
    public $timestamps = false;
    protected $appends = ['image'];
    protected $hidden  = ['path'];

    public static $dir = 'uploads';

    public function imageable()
    {
        return $this->morphTo();
    }

    //BEGIN new Image
    public function withPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function publish()
    {
        $this->save();
        return $this;
    }
    //END NEW Image

    //MOVE FILE
    public static function fromForm(UploadedFile $file)
    {
        $storeFile  = new static;
        $secret     = substr(md5(uniqid(rand(), true)), 16);
        $originName = $file->getClientOriginalName();
        $name       = $secret . '___' . $originName;

        $file->move($storeFile->makeDir(), $name);
        $storeFile->name = $storeFile->getDir() . '/' . $name;

        return $storeFile;
    }

    protected function getDir()
    {
        $image = new static;
        return $image::$dir;
    }

    public static function setDir($dir = 'uploads')
    {
        $image       = new static;
        $image::$dir = $dir;
        return $image;
    }

    protected function makeDir()
    {
        $image = new static;
        return public_path() . '/' . $image::$dir . '/';
    }

    public function getImageAttribute()
    {
        return asset($this->path);
    }

    public static function deleteImage($file)
    {
        $file = public_path() . '/' . $file;
        if (File::exists($file)) {
            return File::delete($file);
        }
        return false;
    }
}
