<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reputation extends Model
{
    use HasFactory,SoftDeletes;
    public function User()
    {
        return $this->belongsTo('App\Models\User', 'added_by', 'id');
    }
    public function LegalArea()
    {
        return $this->belongsTo('App\Models\LegalArea', 'legal_area_id', 'id');
    }
}
