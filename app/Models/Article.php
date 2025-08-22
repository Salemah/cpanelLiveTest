<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory,SoftDeletes;
    public function User()
    {
        return $this->belongsTo('App\Models\User', 'added_by', 'id');
    }
    public function UpdatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
    public function LegalArea()
    {
        return $this->belongsTo('App\Models\LegalArea', 'legal_area_id', 'id');
    }
    public function Tag()
    {
        return $this->belongsTo('App\Models\Tag', 'tag_id', 'id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class)->where('like', true);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dislikes()
    {
        return $this->hasMany(Like::class)->where('like', false);
    }
}
