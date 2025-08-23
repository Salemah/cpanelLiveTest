<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'days' => 'array',
        'social' => 'array',
    ];
    public function User()
    {
        return $this->belongsTo('App\Models\User', 'added_by', 'id');
    }
    public function holidays()
    {
        return $this->hasMany(Holiday::class, 'team_id');
    }
}
