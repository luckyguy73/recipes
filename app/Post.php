<?php

namespace App;

use App\Tag;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'title', 'ingredients', 'directions', 'slug', 'user_id'
    ];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function scopeFilter($query, $filters)
    {
        if($month = $filters['month']) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }
        if($year = $filters['year']) {
            $query->whereYear('created_at', $year);
        }
    }
    public static function archives()
    {
        return static::selectRaw('monthname(created_at) month, year(created_at) year, count(*) published, month(created_at) sort')
            ->groupBy('year', 'month', 'sort')
            ->orderBy('year', 'desc')
            ->orderBy('sort', 'desc')
            ->get()
            ->toArray();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
