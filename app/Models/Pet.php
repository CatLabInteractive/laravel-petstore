<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pet
 * @package App\Models
 */
class Pet extends Model
{
    const STATUS_AVAILABLE = 'available';
    const STATUS_ENDING = 'ending';
    const STATUS_SOLD = 'sold';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}