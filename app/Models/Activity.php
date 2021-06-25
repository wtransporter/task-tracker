<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function feed($take = 50)
    {
        return static::latest()
            ->with(['subject', 'user'])
            ->take($take)
            ->get()
            ->groupBy(function($activity) {
                return $activity->created_at->format('d.m.Y');
            });
    }
}
