<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slot extends Model
{
    use HasFactory,SoftDeletes;
    public function Team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id', 'id');
    }
}
