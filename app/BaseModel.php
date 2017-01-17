<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     *
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function($model){
            foreach ($model->attributes as $key => $value) {
                if (!empty($model->nullableFields) && in_array($key, $model->nullableFields)) {
                    $model->$key = ($value === '') ? null : $value;
                }
            }
        });
    }

}