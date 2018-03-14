<?php namespace App;

use App\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Model extends EloquentModel
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        static::deleting(function($table) {
            if( auth() && auth()->check() ){
                $table->deleted_by = auth()->user()->id;
                $table->save();
            }
        });

        static::saving(function($table) {
            if( auth() && auth()->check() ){
                $table->created_by = auth()->user()->id;
                $table->updated_by = auth()->user()->id;
            }
        });
    }

    public static function validateAndNewInstance(Model $model, array $data = [])
    {
        self::validateDataForNewInstance($model, $data);

        return $model->newInstance($data);
    }

    public static function validateDataForNewInstance(Model $model, array $data = [])
    {
        if( empty($data) ){
            throw new ValidationException('No data found to create the instance');
        }

        foreach ($model->mandatoryFields as $field){
            if( ! array_has($data, $field) ){
                throw new ValidationException('The field "' . $field . '" is mandatory to create the instance');
            }
        }
    }
}