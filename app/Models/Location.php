<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Location extends Model
{
    /**
     * Avoid timestamps attributes.
     */
    public $timestamps= false;
    
    
    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get the locatable Model */
    public function locatable()
    {
        return $this->morphTo();
    }

}
