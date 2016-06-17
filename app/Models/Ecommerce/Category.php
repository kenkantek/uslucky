<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'ecommerce_categories';

    protected $fillable = ['name', 'position'];

    public function scopeIgnoreId($query, $id = null)
    {
        return $id ? $query->where('id', '<>', $id) : $query;
    }

    public function scopeIgnoreParent($query, $id = null)
    {
        return $id ? $query->where('parent_id', '<>', $id) : $query;
    }

    //NEW CATEGORY
    public function withName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function withParentId($parent_id)
    {
        $this->parent_id = $parent_id;
        return $this;
    }
    public function withDisplay($display)
    {
        $this->display = $display;
        return $this;
    }
    public function withPosition($position)
    {
        $this->position = $position;
        return $this;
    }
    public function publish()
    {
        $this->save();
        return $this;
    }
    //END NEW CATEGORY

    // BEGIN RELATIONSHIP
    public function childrens()
    {
        return $this->hasMany(static::class, 'parent_id')
            ->where('parent_id', '<>', 0);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'ecommerce_category_product');
    }
    // END RELATIONSHIP
}
