<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designs extends Model
{
    use HasFactory;

    protected $fillable = [
        'designId','designName','splitPercent'
    ];

    public function promotions()
    {
        return $this->belongsTo(Promotions::class);
    }
}
