<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'hours' => 'array'
    ];


    public function employee()
    {
        return $this->belongsTo(Team::class);
    }
}
