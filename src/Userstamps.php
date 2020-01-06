<?php

namespace Munettt\Userstamps;

trait Userstamps
{
    /**
     * Boot the userstamps trait for a model.
     *
     * @return void
     */
    public static function bootUserstamps()
    {
        static::registerEvents();
    }

    public function createdUser()
    {
        return $this->belongsTo($this->getUserClass(), 'created_by');
    }

    public function updatedUser()
    {
        return $this->belongsTo($this->getUserClass(), 'updated_by');
    }

    /**
     * Listen to model events
     *
     * @return void
     */
    public static function registerEvents()
    {
        //timestamps
        static::creating(function($model)
        {
            $model->created_by = auth()->id();
        });

        static::updating(function($model)
        {
            $model->updated_by = auth()->id();
        });

        static::deleting(function($model)
        {
           if ( method_exists($this, 'runSoftDelete') ) {
                $model->deleted_by = auth()->id();
           }
        });
    }

    /**
     * Get the class being used to provide a User.
     *
     * @return string
     */
    protected function getUserClass()
    {
        if (get_class(auth()) === 'Illuminate\Auth\Guard') {
            return auth()->getProvider()->getModel();
        }

        return auth()->guard()->getProvider()->getModel();
    }
}
