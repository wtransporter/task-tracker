<?php

namespace App\Traits;

use App\Models\Activity;

trait RecordsActivity
{
    public static function bootRecordsActivity()
    {
        foreach (static::getEvents() as $event) {
            static::$event(function($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    public static function getEvents()
    {
        return ['created'];
    }

    public function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' =>auth()->id(),
            'type' => $this->getActivityType($event)
        ]);
    }

    public function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());

        return "{$event}_{$type}";
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}