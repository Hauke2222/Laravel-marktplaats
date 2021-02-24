<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    public function advert()
    {
        return $this->belongsTo('App\Models\Advert');
    }

    protected $table = 'bids';
    protected $fillable = [
        'bid_amount',
        'advert_id',
        'user_id',
    ];
}
