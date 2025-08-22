<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory,SoftDeletes;
    public function User()
    {
        return $this->belongsTo('App\Models\User', 'added_by', 'id');
    }
    public function FaqCategory()
    {
        return $this->belongsTo('App\Models\FaqCategory', 'faq_category', 'id');
    }
}
