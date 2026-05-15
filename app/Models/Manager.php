<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
#[Guarded(['id'])]
class Manager extends Model
{
    /**
     * Avoid timestamps attributes.
     */
    public $timestamps= false;
    

    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    
    /* Get the Location */
    public function location()
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    /* Get the locatable Model */
    public function manageable()
    {
        return $this->morphTo();
    }

}
