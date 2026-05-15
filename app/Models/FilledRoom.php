<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class FilledRoom extends Model
{
    
    /**
     * Avoid timestamps attributes.
     */
    public $timestamps= false;
    
    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get the AcademicPeriod */
    public function academicPeriod()
    {
        return $this->belongsTo(AcademicPeriod::class);
    }
}
