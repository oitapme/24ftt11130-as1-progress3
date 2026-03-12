<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * Posts that belong to this category.
     */
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }
}
