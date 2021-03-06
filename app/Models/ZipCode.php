<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

    public function advert()
    {
        return $this->belongsToMany('App\Models\Advert', 'zip_code_id');
    }

    protected $table = 'zip_codes';
    protected $fillable = [
        'id',
        'postcode',
        'woonplaats',
        'alternatieve_schrijfwijzen',
        'gemeente',
        'provincie',
        'netnummer',
        'latitude',
        'longitude',
        'soort',
    ];
}
