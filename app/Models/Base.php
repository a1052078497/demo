<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Base extends Model
{
	/**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        $className = class_basename(static::class);
        // 自动挂载观察者
        $observeClass = "App\\Observers\\{$className}Observer";
        if (class_exists($observeClass)) {
            static::observe($observeClass);
        }
        // 自动挂载作用域
        $scopeClass = "App\\Scopes\\{$className}Scope";
        if (class_exists($scopeClass)) {
            static::addGlobalScope(new $scopeClass);
        }
    }

    /**
     * Create a new model instance for a related model.
     *
     * @param  string  $class
     * @return mixed
     */
    protected function newRelatedInstance($class)
    {
        return tap(new $class, function ($instance) {
            $instance->from_relationship = true;
            if (! $instance->getConnectionName()) {
                $instance->setConnection($this->connection);
            }
        });
    }
    
	/**
     * 按需进行条件筛选
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  bool   $bool
     * @param  array  $parameters
     * @return void
     */
    public function scopeWhenWhere(Builder $query, bool $bool, ...$parameters)
    {
        if ($bool) {
            if (isset($parameters[1]) && $parameters[1] === 'scope') {
                $query->{$parameters[0]}(...array_slice($parameters, 2));
            } else {
                $query->where(...$parameters);
            }
        }
    }
}