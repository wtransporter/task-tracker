<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, RecordsActivity;

    protected $guarded = [];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['project'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'started_at',
        'due_date',
        'finished_at'
    ];

    public static function boot()
    {
        parent::boot();

        static::updating(function($task) {
            $task->trackChange(null, ['description' => $task->note]);
        });
    }

    public function trackChange($userId = null, array $data)
    {
        unset($this->note);

        $userId = $userId ?: Auth()->id();

        $data = array_merge($this->getDiff(), $data);

        $this->adjustments()->attach($userId, $data);
    }

    public function getDiff()
    {
        $changed = $this->getDirty();

        if(empty($changed)) {
            return [];
        };
        
        $before = json_encode(array_intersect_key($this->fresh()->toArray(), $changed));
        $after = json_encode($changed);

        return compact('before', 'after');
    }

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

    public function adjustments()
    {
        return $this->belongsToMany(User::class, 'comments')
            ->withTimestamps()
            ->withPivot(['description', 'before', 'after']);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function scopeFilter($query, array $filters)
    {
        return 
            $query->when($filters['active'], function ($query) {
                    return $query->whereNull('finished_at');
                })
                ->when($filters['search'], function ($query, $search) {
                    return $query->where('title', 'LIKE', '%'.$search.'%');
                })
                ->when($filters['sortField'], function ($query, $search) {
                    return $query->orderBy($search, $this->sort ? 'asc' : 'desc');
                })
                ->when($filters['tasktypes'], function($query, $search) {
                    return $query->where('tasktype_id', $search);
                });
    }
}
