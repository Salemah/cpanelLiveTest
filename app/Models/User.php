<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function hasLiked($postId)
    {
        return $this->likes()->where('article_id', $postId)->where('like', true)->exists();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function hasDisliked($postId)
    {
        return $this->likes()->where('article_id', $postId)->where('like', false)->exists();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function toggleLikeDislike($postId, $like)
    {
        // Check if the like/dislike already exists
        $existingLike = $this->likes()->where('article_id', $postId)->first();

        if ($existingLike) {
            if ($existingLike->like == $like) {
                $existingLike->delete();

                return [
                    'hasLiked' => false,
                    'hasDisliked' => false
                ];
            } else {
                $existingLike->update(['like' => $like]);
            }
        } else {
            $this->likes()->create([
                'article_id' => $postId,
                'like' => $like,
            ]);
        }

        return [
            'hasLiked' => $this->hasLiked($postId),
            'hasDisliked' => $this->hasDisliked($postId)
        ];
    }
}
