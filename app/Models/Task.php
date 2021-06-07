<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tasktype()
    {
        return $this->belongsTo(Tasktype::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
