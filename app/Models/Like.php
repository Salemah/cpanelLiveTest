<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = ['article_id', 'user_id', 'like'];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function post()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
