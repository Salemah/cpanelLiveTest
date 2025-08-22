<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LawCategory extends Model
{
    use HasFactory,SoftDeletes;
    public function LegalArea()
    {
        return $this->hasMany(LegalArea::class, 'law_category_id');
    }
}
