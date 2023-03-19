<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\CountryPart;

class Country extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'countries';
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
    public function sections(){
        return $this->hasMany(CountryPart::class, 'countries_id');
    }
    



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

    public function setFlagAttribute($value)
    {
        $attribute_name = "flag";
        $disk = "public";
        $destination_path = "/";
        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path, $fileName = null);

    
    }

    public function getFlagAttribute($value)
    {
        return '/storage/' .  $value;
    }    


    public function getIdAtxxxxxxxxxxtribute($value)
    {
        return $this->id;
    }    
    
}
