<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Header extends Model
{
    /**
     * Avoid timestamps attributes.
     */
    public $timestamps= false;

    
    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get the department */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
