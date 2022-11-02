<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'tours';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    protected $casts = [
        'photos' => 'array'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
    public function setPhotosAttribute($value)
    {
        if (is_null($values)) return $values;
        $attribute_name = "photos";
        $disk = "public";
        $destination_path = "/";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }

    public function getPhotosAttribute($values)
    {
        
        $response = [];
        $values = json_decode($values);
        foreach($values as $value ){
            $response[] = '/storage/' .  $value;
        } 
    
        
        return json_encode($response);
    }
    
    
}
