<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'advert_categories', 'advert_id', 'category_id');
    }

    public function zipCode()
    {
        return $this->belongsTo('App\Models\ZipCode', 'zip_code_id');
    }

    protected $table = 'adverts';
    protected $fillable = [
        'title',
        'date',
        'zip_code',
        'author',
        'advert_description',
        'premium_advert',
        'image',
        'user_id',
    ];
}
