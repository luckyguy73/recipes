<?php

namespace App;

use App\User;

trait Likeable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function scopeLikedBy($query, User $user)
    {
        return $query->whereHas('likes', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()
            ->where('user_id', $user->id)
            ->exists();
    }

    public function like()
    {
        $this->likes()->save(
            new Like(['user_id' => auth()->id()])
        );
    }
}