<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;


#[Guarded(['id'])]
class Department extends Model
{
    /**
     * Avoid timestamps attributes.
     */
    public $timestamps= false;

    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get collection of users */
    public function users()
    {
        return $this->morphMany(User::class, 'useable');
    }

    /* Get collection of headers */
    public function headers()
    {
        return $this->hasMany(Header::class);
    }
    
    /* Get collection of schools */
    public function schools()
    {
        return $this->hasMany(School::class);
    }

    /* Get the Location */
    public function location()
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    /* Get collection of managers*/
    public function managers()
    {
        return $this->morphMany(Manager::class, 'manageable');
    }
}
