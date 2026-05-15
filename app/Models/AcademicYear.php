<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;


#[Guarded(['id', 'created_at', 'updated_at'])]
class AcademicYear extends Model
{

   /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get the school */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get the academicYear */
    public function academicPeriods()
    {
        return $this->hasMany(AcademicPeriod::class);
    }

}
