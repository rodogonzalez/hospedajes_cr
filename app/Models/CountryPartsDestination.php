<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\CountryPart;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CountryPartsDestination extends Model
{
    use CrudTrait, HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'country_parts_destinations';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

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
    public function country_section_options(){

        return $this->belongsTo(CountryPart::class, 'country_parts_id');
    }

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
        $attribute_name = "photos";
        $disk = "public";
        $destination_path = "/";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }

    public function getPhotosAttribute($values)
    {
        if (is_null($values)) return $values;
        $response = [];
        $values = json_decode($values);
        foreach($values as $value ){
            $response[] = '/storage/' .  $value;
        } 
    
        
        return json_encode($response);
    }
    
}
