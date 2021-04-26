<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function advert()
    {
        return $this->belongsToMany('App\Models\Advert', 'advert_categories', 'advert_id', 'category_id');
    }

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'advert_id',
    ];
}
