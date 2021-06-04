<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::created(function($task) {
            $task->update([
                'code' => $task->project_id . $task->id
            ]);
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tasktype()
    {
        return $this->belongsTo(Tasktype::class);
    }
}
