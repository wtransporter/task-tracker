<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, RecordsActivity;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function completedTasks()
    {
        return $this->hasMany(Task::class)->whereNotNull('finished_at');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_member')->withTimestamps();
    }

    public function invite($users)
    {
        if (is_null($users)) {
            return $this->members()->detach();
        }

        $users = User::whereIn('id', $users)->pluck('id')->toArray();

        return $this->members()->sync($users);
    }
}
