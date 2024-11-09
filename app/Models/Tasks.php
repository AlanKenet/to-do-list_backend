<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'finished',
        'finished_at'
    ];

    protected static function booted() {
        static::updating(function ($task) {
            if( $task->isDirty('finished') ){
                $task->finished_at = $task->finished ? now() : null;
            }
        });
    }

    public function toArray() {
        $attributes = parent::toArray();
        $formatted = [];

        foreach ($attributes as $key => $value) {
            $camelCaseKey = Str::camel($key); 
            $formatted[$camelCaseKey] = $value;
        }

        return $formatted;
    }

    public function getFinishedAttribute($value) {
        return (bool) $value;
    }
}
